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
        if (Auth::user()->cannot('viewAny', Oferta::class)) {
            abort(404);
        }

        $ofertas = $pedido->ofertas;

        return view('ofertas.ofertas', ['ofertas' => $ofertas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pedido $pedido)
    {

        if (auth()->user()->cannot('create', Oferta::class)) {
            abort(404);
        }

        return view('ofertas.ofertas-create', ['pedido' => $pedido]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfertaRequest $request, Pedido $pedido)
    {

        if (auth()->user()->cannot('create', Oferta::class)) {
            abort(404);
        }
        $professional = Auth::user()->professional->id;
        $oferta = Oferta::create($request->validated() + [
            'professional_id' => $professional,
            'pedido_id' => $pedido->id,
        ]);

        return redirect()->route('ofertas.show', $oferta)->with('success', 'Oferta adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Oferta $oferta)
    {
        if (Auth::user()->cannot('view', $oferta)) {
            abort(404);
        }

        return view('ofertas.ofertas-show', ['oferta' => $oferta]);
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

        if (Auth::user()->cannot('update', $oferta)) {
            abort(404);
        }

        $oferta->update($request->validated());

        return redirect()->route('ofertas.show', $oferta->id)->with('success', 'Oferta atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oferta $oferta)
    {
        if (Auth::user()->cannot('delete', $oferta)) {
            abort(404);
        }

        $oferta->delete();

        return redirect()->back()->with('success', 'Oferta removida com sucesso!');
    }

    public function aceitarOferta(Oferta $oferta)
    {
        if(Auth::user()->cannot('aceitarOferta', Oferta::class)){
            abort(404);
        }
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
