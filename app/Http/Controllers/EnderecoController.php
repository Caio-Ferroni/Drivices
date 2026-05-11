<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnderecoRequest;
use App\Http\Requests\UpdateEnderecoRequest;
use App\Models\Endereco;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->cannot('viewAny', Endereco::class)) {
            abort(404);
        }

        $enderecos = Endereco::all();

        return view('enderecos.enderecos', ['enderecos' => $enderecos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->cannot('create', Endereco::class)) {
            return redirect()->route('users.show', Auth::user()->id)
                ->with('error', 'Você já possui um endereço registrado.');
        }

        return view('enderecos.enderecos-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnderecoRequest $request)
    {
        if (Auth::user()->cannot('create', Endereco::class)) {
            abort(404);
        }

        $user = Auth::user()->id;
        $endereco = Endereco::create($request->validated() + [
            'user_id' => $user,
        ]);
        

        return redirect()->route('enderecos.show', $endereco)->with('success', 'Endereço adicionado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Endereco $endereco)
    {
        if (Auth::user()->cannot('view', $endereco)) {
            abort(404);
        }

        return view('enderecos.enderecos-show', ['endereco' => $endereco]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Endereco $endereco)
    {
        if (Auth::user()->cannot('update', $endereco)) {
            abort(404);
        }
        return view('enderecos.enderecos-edit', ['endereco' => $endereco]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnderecoRequest $request, Endereco $endereco)
    {
        if (Auth::user()->cannot('update', $endereco)) {
            abort(404);
        }

        $endereco->update($request->validated());

        return redirect()->route('enderecos.index')->with('success', 'Endereço atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Endereco $endereco)
    {

        if (Auth::user()->cannot('delete', $endereco)) {
            abort(404);
        }

        $endereco->delete();

        return redirect()->route('enderecos.index')->with('success', 'Endereco removido com sucesso!');
    }
}
