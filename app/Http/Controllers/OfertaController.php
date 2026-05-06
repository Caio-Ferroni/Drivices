<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfertaRequest;
use App\Http\Requests\UpdateOfertaRequest;
use App\Models\Oferta;
use App\Models\Pedido;
use App\Models\Servico;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pedido $pedido)
    {
        $ofertas = $pedido->ofertas;

        return view('ofertas.ofertas', ['ofertas' => $ofertas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pedido $pedido)
    {

        if (auth()->user()->can('create', Oferta::class)) {
            return view('ofertas.ofertas-create', ['pedido' => $pedido]);
        } else {
            return redirect()->back();
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfertaRequest $request, Pedido $pedido)
    {
        $oferta = Oferta::create([
            'custo' => $request->custo,
            'pedido_id' => $pedido->id,
            'professional_id' => $request->professional_id,
        ]);

        return redirect()->route('ofertas.show', $oferta)->with('success', 'Oferta adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Oferta $oferta)
    {
            if (Auth::user()->can('view', $oferta)) {
                return view('ofertas.ofertas-show', ['oferta' => $oferta]);
            } else {
                abort(404);
            }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oferta $oferta)
    {
        return view('ofertas.ofertas-edit', ['oferta' => $oferta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfertaRequest $request, Oferta $oferta)
    {

        $data = array_filter($request->toArray());

        $oferta->update($data);

        return redirect()->route('ofertas.show', $oferta->id)->with('success', 'Oferta atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oferta $oferta)
    {

        if (Auth::user()->can('delete', $oferta)) {
            $oferta->delete();

            return redirect()->back()->with('success', 'Oferta removida com sucesso!');
        } else {
            return redirect()->back();
        }

    }

    public function aceitarOferta(Oferta $oferta)
    {
        // Usamos uma Transaction para garantir que, se um falhar, o outro não aconteça
        DB::transaction(function () use ($oferta) {
            // 1. Atualiza a oferta
            $oferta->update(['status' => 'Aceito']);

            // 2. Cria o serviço automaticamente
            Servico::create([
                'pedido_id' => $oferta->pedido_id,
                'oferta_id' => $oferta->id,
                'status' => 'Em andamento',
                'confirmacao' => now(),
                'realizacao' => now(),
                'finalizacao' => now(),
            ]);

            // 3. (Opcional) Você poderia marcar o Pedido como 'Fechado' aqui também
            $oferta->pedido->update(['status' => 'Em andamento']);
        });

        return redirect()->route('pedidos.show', $oferta->pedido_id)
            ->with('success', 'Oferta aceita e serviço iniciado!');
    }
}
