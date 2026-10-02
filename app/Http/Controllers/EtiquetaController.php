<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function index()
    {
        $etiquetas = Etiqueta::all();
        return view('etiquetas.index', compact('etiquetas'));
    }

    public function create()
    {
        return view('etiquetas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'color'  => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        Etiqueta::create($request->only(['nombre', 'color']));

        return redirect()->route('etiquetas.index')
                         ->with('success', 'Etiqueta creada correctamente');
    }

    public function edit(Etiqueta $etiqueta)
    {
        return view('etiquetas.edit', compact('etiqueta'));
    }

    public function update(Request $request, Etiqueta $etiqueta)
    {
        $request->validate([
            'nombre' => 'required|max:50',
            'color'  => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $etiqueta->update($request->only(['nombre', 'color']));

        return redirect()->route('etiquetas.index')
                         ->with('success', 'Etiqueta actualizada correctamente');
    }

    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->delete();
        return redirect()->route('etiquetas.index')
                         ->with('success', 'Etiqueta eliminada correctamente');
    }
}