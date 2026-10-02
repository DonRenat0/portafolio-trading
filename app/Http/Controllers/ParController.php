<?php

namespace App\Http\Controllers;

use App\Models\Par;
use Illuminate\Http\Request;

class ParController extends Controller
{
    public function index()
    {
        $pares = Par::all();
        return view('pares.index', compact('pares'));
    }

    public function create()
    {
        return view('pares.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:20',
            'tipo'   => 'required|in:forex,cripto,indice,materia_prima',
        ]);

        Par::create($request->only(['nombre', 'tipo']));

        return redirect()->route('pares.index')
                         ->with('success', 'Par creado correctamente');
    }

    public function edit(Par $par)
    {
        return view('pares.edit', compact('par'));
    }

    public function update(Request $request, Par $par)
    {
        $request->validate([
            'nombre' => 'required|max:20',
            'tipo'   => 'required|in:forex,cripto,indice,materia_prima',
        ]);

        $par->update($request->only(['nombre', 'tipo']));

        return redirect()->route('pares.index')
                         ->with('success', 'Par actualizado correctamente');
    }

    public function destroy(Par $par)
        {
            if ($par->operaciones()->exists()) {
                return redirect()->route('pares.index')
                                ->with('error', 'No se puede eliminar este par porque tiene operaciones asociadas');
            }

            $par->delete();
            return redirect()->route('pares.index')
                            ->with('success', 'Par eliminado correctamente');
        }
}