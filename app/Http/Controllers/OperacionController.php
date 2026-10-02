<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacion;
use App\Models\Par;
use App\Models\Cuenta;
use App\Models\Etiqueta;

class OperacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $operaciones = Operacion::with(['par', 'cuenta'])
        ->orderBy('anio', 'desc')
        ->orderBy('mes', 'desc')
        ->orderBy('semana', 'desc')
        ->orderBy('fecha_entrada', 'desc')
        ->get();

    $agrupadas = $operaciones->groupBy('anio')->map(function ($porAnio) {
        return $porAnio->groupBy('mes')->map(function ($porMes) {
            return $porMes->groupBy('semana');
        });
    });

    return view('operaciones.index', compact('agrupadas'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $pares = Par::all();
    $cuentas = Cuenta::all();
    $etiquetas = Etiqueta::all();
    return view('operaciones.create', compact('pares', 'cuentas', 'etiquetas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
   {
        $request->validate([
            'id_par'         => 'required|exists:pares,id',
            'id_cuenta'      => 'required|exists:cuenta,id',
            'direccion'      => 'required|in:long,short',
            'fecha_entrada'  => 'required|date',
            'precio_entrada' => 'required|numeric',
            'imagen'         => 'nullable|image|max:5120',
        ]);

     $datos = $request->only([
    'id_par', 'id_cuenta', 'direccion',
    'fecha_entrada', 'fecha_salida',
    'precio_entrada', 'precio_salida',
    'tamano_posicion', 'resultado_dinero',
    'resultado_porcentaje', 'comentario'
]);

if ($request->hasFile('imagen')) {
    $datos['imagen'] = $request->file('imagen')->store('operaciones', 'public');
}

$operacion = Operacion::create($datos);

        if ($request->has('etiquetas')) {
            $operacion->etiquetas()->sync($request->etiquetas);
        }

        return redirect()->route('operaciones.index')
                        ->with('success', 'Operación creada correctamente');
    }

    /**
     * Display the specified resource.
     */
        public function show(Operacion $operacion)
        {
            $operacion->load(['par', 'cuenta', 'etiquetas']);
            return view('operaciones.show', compact('operacion'));
        }
            /**
     * Show the form for editing the specified resource.
     */
  public function edit(Operacion $operacion)
    {
        $pares = Par::all();
        $cuentas = Cuenta::all();
        $etiquetas = Etiqueta::all();
        return view('operaciones.edit', compact('operacion', 'pares', 'cuentas', 'etiquetas'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Operacion $operacion)
    {
       $request->validate([
            'id_par'         => 'required|exists:pares,id',
            'id_cuenta'      => 'required|exists:cuenta,id',
            'direccion'      => 'required|in:long,short',
            'fecha_entrada'  => 'required|date',
            'precio_entrada' => 'required|numeric',
            'imagen'         => 'nullable|image|max:5120',
        ]);

        $datos = $request->only([
                'id_par', 'id_cuenta', 'direccion',
                'fecha_entrada', 'fecha_salida',
                'precio_entrada', 'precio_salida',
                'tamano_posicion', 'resultado_dinero',
                'resultado_porcentaje', 'comentario'
            ]);

            if ($request->hasFile('imagen')) {
                // Borrar imagen anterior si existe
                if ($operacion->imagen) {
                    \Storage::disk('public')->delete($operacion->imagen);
                }
                $datos['imagen'] = $request->file('imagen')->store('operaciones', 'public');
            }

            $operacion->update($datos);

        if ($request->has('etiquetas')) {
            $operacion->etiquetas()->sync($request->etiquetas);
        } else {
            $operacion->etiquetas()->detach();
        }

        return redirect()->route('operaciones.show', $operacion)
                        ->with('success', 'Operación actualizada correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operacion $operacion)
{
    if ($operacion->imagen) {
        \Storage::disk('public')->delete($operacion->imagen);
    }
    $operacion->etiquetas()->detach();
    $operacion->delete();

    return redirect()->route('operaciones.index')
                     ->with('success', 'Operación eliminada correctamente');
}
}
