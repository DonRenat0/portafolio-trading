<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;

class CuentaController extends Controller
{
    public function index()
    {
        $cuentas = Cuenta::all();
        return view('cuentas.index', compact('cuentas'));
    }

    public function create()
    {
        return view('cuentas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'          => 'required|max:50',
            'capital_inicial' => 'required|numeric',
            'fecha_inicio'    => 'required|date',
        ]);

        Cuenta::create($request->only(['nombre', 'capital_inicial', 'fecha_inicio', 'descripcion']));

        return redirect()->route('cuentas.index')
                         ->with('success', 'Cuenta creada correctamente');
    }

    public function edit(Cuenta $cuenta)
    {
        return view('cuentas.edit', compact('cuenta'));
    }

    public function update(Request $request, Cuenta $cuenta)
    {
        $request->validate([
            'nombre'          => 'required|max:50',
            'capital_inicial' => 'required|numeric',
            'fecha_inicio'    => 'required|date',
        ]);

        $cuenta->update($request->only(['nombre', 'capital_inicial', 'fecha_inicio', 'descripcion']));

        return redirect()->route('cuentas.index')
                         ->with('success', 'Cuenta actualizada correctamente');
    }

    public function destroy(Cuenta $cuenta)
    {
        $cuenta->delete();
        return redirect()->route('cuentas.index')
                         ->with('success', 'Cuenta eliminada correctamente');
    }
}