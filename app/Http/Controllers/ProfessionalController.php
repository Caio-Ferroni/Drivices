<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Http\Requests\StoreProfessionalRequest;
use App\Http\Requests\UpdateProfessionalRequest;
use Illuminate\Support\Facades\Auth;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professionals = Professional::all();
        return view('professionals.professionals', ['professionals' => $professionals]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professionals.professionals-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessionalRequest $request)
    {

        $existe = Professional::where('user_id', $request->user_id)->exists();
        if($existe){
            
            return redirect()->route('professionals.index');
        }else{
        $professional = Professional::create([
            'user_id' => $request->user_id,
            'biografia' => $request->biografia,
            'nota' => '5.0',
            'stripe' => '1',

        ]); 

        $professional->save();
        }
        return redirect()->route('professionals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Professional $professional)
    {
        return view('professionals.professionals-show', ['professional' => $professional]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professional $professional)
    {
        return view('professionals.professionals-edit', ['professional' => $professional]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessionalRequest $request, Professional $professional)
    {
        if ($request->user()->cannot('update', $professional)){
            abort(403);
        }
        
        $data = array_filter($request->toArray());

        $professional->update($data);

        return redirect()->route('professionals.show', $professional->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professional $professional)
    {
        if(Auth::user()->can('delete', $professional))
        {
            $professional->delete();
        return redirect()->back()->with('success', 'Perfil profissional removido com sucesso!');
       }
       else{
         return redirect()->back();
       };
    }
}
