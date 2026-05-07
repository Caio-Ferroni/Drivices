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

    // dd(Auth::user()->can('viewAny', Pedido::class));
        if (Auth::user()->cannot('viewAny', Pedido::class)) {
            abort(404);
        }

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
        if (auth()->user()->cannot('create', Pedido::class)) {
            return redirect()->route('pedidos.index')
                ->with('error', 'Você precisa registrar um endereço antes de solicitar um serviço.');
        }

        return view('pedidos.pedidos-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {
        if (auth()->user()->cannot('create', Pedido::class)) {
            return redirect()->route('pedidos.index')
                ->with('error', 'Você precisa registrar um endereço antes de solicitar um serviço.');
        }

        $endereco = Auth::user()->endereco->id;
        $user = Auth::user()->id;
        $pedido = Pedido::create($request->validated() + [
            'user_id' => $user,
            'endereco_id' => $endereco,
            'status' => 'Pendente',
        ]);

        return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        if (Auth::user()->cannot('view', $pedido)) {
            abort(404);
        }

        return view('pedidos.pedidos-show', ['pedido' => $pedido]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        if (Auth::user()->cannot('update', $pedido)) {
            abort(404);
        }
        
        return view('pedidos.pedidos-edit', ['pedido' => $pedido]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        if (Auth::user()->cannot('update', $pedido)) {
            abort(404);
        }

        $pedido->update($request->validated());

        return redirect()->route('pedidos.show', $pedido->id)->with('success', 'Pedido atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        if (Auth::user()->cannot('delete', $pedido)) {
            abort(404);
        }

        $pedido->delete();

        return redirect()->back()->with('success', 'Pedido removido com sucesso!');
    }
}
