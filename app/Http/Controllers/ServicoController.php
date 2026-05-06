<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServicoRequest;
use App\Http\Requests\UpdateServicoRequest;
use App\Models\Servico;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->cannot('viewAny', Servico::class)) {
            abort(404);
        }

        $servicos = Servico::all();

        return view('servicos.servicos', ['servicos' => $servicos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (auth()->user()->cannot('create', Servico::class)) {
            abort(404);
        }

        return view('servicos.servicos-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServicoRequest $request)
    {

        if (auth()->user()->cannot('create', Servico::class)) {
            abort(404);
        }
        // dd($request);
        $servico = Servico::create([
            'pedido_id' => $request->pedido_id,
            'oferta_id' => $request->oferta_id,
            'status' => 'Pendente',
            'confirmacao' => now(),
            'realizacao' => now(),
            'finalizacao' => now(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        if (Auth::user()->cannot('view', $servico)) {
            abort(404);
        }

        return view('servicos.servicos-show', ['servico' => $servico]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServicoRequest $request, Servico $servico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        //
    }

    public function finalizarServico(Servico $servico)
    {

        $servico->update([
            'finalizacao' => now(),
            'status' => 'Concluido',
        ]);

        return redirect()->route('servicos.relatorios.create', $servico);
    }
}
