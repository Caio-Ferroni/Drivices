<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessionalRequest;
use App\Http\Requests\UpdateProfessionalRequest;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->cannot('viewAny', Professional::class)) {
            abort(404);
        }

        $professionals = Professional::all();

        return view('professionals.professionals', ['professionals' => $professionals]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->cannot('create', Professional::class)) {
            abort(404);
        }

        return view('professionals.professionals-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessionalRequest $request)
    {
        if (auth()->user()->cannot('create', Professional::class)) {
            abort(404);
        }

        $userId = auth()->id();

        // Procura inclusive nos deletados
        $professional = Professional::withTrashed()->where('user_id', $userId)->first();

        if ($professional) {
            if ($professional->trashed()) {
                $professional->restore(); // Tira do "lixo"
                $professional->update($request->all()); // Atualiza com os novos dados

                return redirect()->route('professionals.show', $professional)->with('success', 'Seu perfil profissional foi reativado!');
            }

            return redirect()->back()->with('error', 'Você já possui um perfil profissional ativo.');
        }

        // Se não existir nada, cria do zero normalmente
        Professional::create($request->all() + ['user_id' => $userId]);

        return redirect()->route('professionals.index')->with('success', 'Perfil profissional adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Professional $professional)
    {
        if (Auth::user()->cannot('view', $professional)) {
            abort(404);
        }

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
        if ($request->user()->cannot('update', $professional)) {
            abort(403);
        }

        $data = array_filter($request->toArray());

        $professional->update($data);

        return redirect()->route('professionals.show', $professional->id)->with('success', 'Perfil profissional atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professional $professional)
    {
        if (Auth::user()->can('delete', $professional)) {
            $professional->delete();

            return redirect()->back()->with('success', 'Perfil profissional removido com sucesso!');
        } else {
            return redirect()->back();
        }
    }
}
