<?php

namespace App\Http\Controllers;

use App\Models\Relatorio;
use App\Models\Servico;
use App\Http\Requests\StoreRelatorioRequest;
use App\Http\Requests\UpdateRelatorioRequest;

class RelatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Servico $servico)
    {
        return view('relatorios.relatorios-create', ['servico' => $servico]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRelatorioRequest $request)
    {
        $relatorio = Relatorio::create([
            'servico_id' => $request->servico_id,
            'status' => $request->status,
            'relatorio' => $request->relatorio,
            'foto' => $request->foto,
        ]);

        return redirect()->route('relatorios.show', $relatorio->id)
        ->with('success', 'Serviço concluído!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Relatorio $relatorio)
    {
        if (Auth::user()->can('view', $relatorio)) {
            return view('relatorios.relatorios-show', ['relatorio' => $relatorio]);
        } else{
           abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relatorio $relatorio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRelatorioRequest $request, Relatorio $relatorio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relatorio $relatorio)
    {
        //
    }
}
