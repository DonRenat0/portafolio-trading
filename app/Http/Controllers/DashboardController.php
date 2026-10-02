<?php

namespace App\Http\Controllers;

use App\Models\Operacion;
use App\Models\Cuenta;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOperaciones = Operacion::count();
        $operacionesCerradas = Operacion::whereNotNull('resultado_dinero')->count();
        $operacionesGanadoras = Operacion::where('resultado_dinero', '>', 0)->count();
        $operacionesPerdedoras = Operacion::where('resultado_dinero', '<', 0)->count();
        $profitTotal = Operacion::sum('resultado_dinero');
        $winRate = $operacionesCerradas > 0
            ? round(($operacionesGanadoras / $operacionesCerradas) * 100, 2)
            : 0;
        $mejorOperacion = Operacion::with('par')->orderBy('resultado_dinero', 'desc')->first();
        $peorOperacion = Operacion::with('par')->orderBy('resultado_dinero', 'asc')->first();
        $ultimasOperaciones = Operacion::with(['par', 'cuenta'])
            ->orderBy('fecha_entrada', 'desc')
            ->take(5)
            ->get();
        $cuenta = Cuenta::first();

        return view('dashboard', compact(
            'totalOperaciones',
            'operacionesCerradas',
            'operacionesGanadoras',
            'operacionesPerdedoras',
            'profitTotal',
            'winRate',
            'mejorOperacion',
            'peorOperacion',
            'ultimasOperaciones',
            'cuenta'
        ));
    }
}