<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnderecoRequest;
use App\Http\Requests\UpdateEnderecoRequest;
use App\Models\Endereco;
use App\Policies\EnderecoPolicy;
use Illuminate\Support\Facades\Auth;

class EnderecoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enderecos = Endereco::all();

        return view('enderecos.enderecos', ['enderecos' => $enderecos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       if(Auth::user()->can('create', Endereco::class)){
        return view('enderecos.enderecos-create');
       } else {
        return redirect()->back();
       }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnderecoRequest $request)
    {
        
         $endereco = Endereco::create([
            'user_id' => $request->user_id,
            'cep' => $request->cep,
            'logradouro' => $request->logradouro,
            'complemento' => $request->complemento ? $request->complemento : null,
            'unidade' => $request->unidade,
            'bairro' => $request->bairro,
            'localidade' => $request->localidade,
            'uf' => $request->uf,
            'regiao' => $request->regiao,
        ]);
        
        $endereco->save(); 

        return redirect()->route('enderecos.index')->with('success', 'Endereço adicionado com sucesso!');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Endereco $endereco)
    {
        if (Auth::user()->can('view', $endereco)) {
            return view('enderecos.enderecos-show', ['endereco' => $endereco]);
        } else{
           abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Endereco $endereco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnderecoRequest $request, Endereco $endereco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Endereco $endereco)
    {
        $endereco->delete();
        return redirect()->route('enderecos.index')->with('success', 'Endereco removido com sucesso!');
    }
}
