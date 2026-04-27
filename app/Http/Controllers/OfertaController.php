<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Http\Requests\StoreOfertaRequest;
use App\Http\Requests\UpdateOfertaRequest;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

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
        return view('ofertas.ofertas-create', ['pedido' => $pedido]);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Oferta $oferta)
    {
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
        
        
        $data = array_filter($request->toArray());

        $oferta->update($data);

        return redirect()->route('ofertas.show', $oferta->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oferta $oferta)
    {
     
       if(Auth::user()->can('delete', $oferta))
        {
            $oferta->delete();
        return redirect()->back()->with('success', 'Oferta removida com sucesso!');
       }
       else{
         return redirect()->back();
       };
    
}
}