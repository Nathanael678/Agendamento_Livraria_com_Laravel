<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

class RecursoController extends Controller
{
    public function index()
    {
        $recursos = Recurso::all();
        return view('admin.recursos.index', compact('recursos'));
    }

    public function create()
    {
        return view('admin.recursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string',
        ]);

        Recurso::create([
            'nome'       => $request->nome,
            'descricao'  => $request->descricao,
            'tipo'       => $request->tipo,
            'disponivel' => $request->has('disponivel'),
        ]);

        return redirect()->route('admin.recursos.index')
            ->with('success', 'Recurso cadastrado com sucesso!');
    }

    public function edit(Recurso $recurso)
    {
        return view('admin.recursos.edit', compact('recurso'));
    }

    public function update(Request $request, Recurso $recurso)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string',
        ]);

        $recurso->update([
            'nome'       => $request->nome,
            'descricao'  => $request->descricao,
            'tipo'       => $request->tipo,
            'disponivel' => $request->has('disponivel'),
        ]);

        return redirect()->route('admin.recursos.index')
            ->with('success', 'Recurso atualizado com sucesso!');
    }

    public function destroy(Recurso $recurso)
    {
        $recurso->delete();
        return back()->with('success', 'Recurso removido!');
    }
}
