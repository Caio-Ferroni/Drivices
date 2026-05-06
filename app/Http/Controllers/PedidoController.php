<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Cupon;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pedidos = Pedido::all();

        return view('pedidos.pedidos', [
            'pedidos' => $pedidos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('create', Pedido::class)) {
            return view('pedidos.pedidos-create');
        } else {
            return redirect()->back();
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {

        $endereco = auth()->user()->endereco->id;
        $cupon = Cupon::where('nome', '=', $request->cupon_id)->first();
        $pedido = Pedido::create([
            'descricao' => $request->descricao,
            'user_id' => $request->id,
            'endereco_id' => $endereco,
            'cupon_id' => $cupon ? $cupon->id : null,
            'orcamento' => $request->orcamento,
            'foto' => $request->foto,
            'emergencia' => $request->emergencia,
            'disponibilidade' => $request->disponibilidade,
            'data_preferida' => $request->data_preferida,
            'status' => 'Pendente',
        ]);

        return redirect()->route('pedidos.index')->with('success', 'Pedido adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        if (Auth::user()->can('view', $pedido)) {
            return view('pedidos.pedidos-show', ['pedido' => $pedido]);
        } else{
           abort(404);
        }
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        return view('pedidos.pedidos-edit', ['pedido' => $pedido]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        if ($request->user()->cannot('update', $pedido)) {
            abort(403);
        }

        $data = array_filter($request->toArray());

        $pedido->update($data);

        return redirect()->route('pedidos.show', $pedido->id)->with('success', 'Pedido atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        if (Auth::user()->can('delete', $pedido)) {
            $pedido->delete();

            return redirect()->back()->with('success', 'Pedido removido com sucesso!');
        } else {
            return redirect()->back();
        }

    }
}
