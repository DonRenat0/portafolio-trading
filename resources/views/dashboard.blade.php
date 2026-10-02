@extends('layouts.app')

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        @if($cuenta)
            <p class="text-gray-400 mt-1">{{ $cuenta->nombre }} · Capital inicial: ${{ number_format($cuenta->capital_inicial, 2) }}</p>
        @endif
    </div>

    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

        <div class="bg-gray-900 rounded-xl border border-gray-800 p-5">
            <p class="text-gray-400 text-sm mb-1">Total operaciones</p>
            <p class="text-3xl font-bold text-white">{{ $totalOperaciones }}</p>
        </div>

        <div class="bg-gray-900 rounded-xl border border-gray-800 p-5">
            <p class="text-gray-400 text-sm mb-1">Win Rate</p>
            <p class="text-3xl font-bold {{ $winRate >= 50 ? 'text-emerald-400' : 'text-red-400' }}">
                {{ $winRate }}%
            </p>
        </div>

        <div class="bg-gray-900 rounded-xl border border-gray-800 p-5">
            <p class="text-gray-400 text-sm mb-1">Profit total</p>
            <p class="text-3xl font-bold {{ $profitTotal >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                {{ $profitTotal >= 0 ? '+' : '' }}${{ number_format($profitTotal, 2) }}
            </p>
        </div>

        <div class="bg-gray-900 rounded-xl border border-gray-800 p-5">
            <p class="text-gray-400 text-sm mb-1">Ganadoras / Perdedoras</p>
            <p class="text-3xl font-bold">
                <span class="text-emerald-400">{{ $operacionesGanadoras }}</span>
                <span class="text-gray-500 text-xl">/</span>
                <span class="text-red-400">{{ $operacionesPerdedoras }}</span>
            </p>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        {{-- Mejor operación --}}
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-5">
            <p class="text-gray-400 text-sm mb-3">Mejor operación</p>
            @if($mejorOperacion && $mejorOperacion->resultado_dinero)
                <div class="flex items-center justify-between">
                    <span class="text-white font-semibold">{{ $mejorOperacion->par->nombre }}</span>
                    <span class="text-emerald-400 font-bold text-xl">
                        +${{ number_format($mejorOperacion->resultado_dinero, 2) }}
                    </span>
                </div>
            @else
                <p class="text-gray-500">Sin datos</p>
            @endif
        </div>

        {{-- Peor operación --}}
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-5">
            <p class="text-gray-400 text-sm mb-3">Peor operación</p>
            @if($peorOperacion && $peorOperacion->resultado_dinero)
                <div class="flex items-center justify-between">
                    <span class="text-white font-semibold">{{ $peorOperacion->par->nombre }}</span>
                    <span class="text-red-400 font-bold text-xl">
                        ${{ number_format($peorOperacion->resultado_dinero, 2) }}
                    </span>
                </div>
            @else
                <p class="text-gray-500">Sin datos</p>
            @endif
        </div>

    </div>

    {{-- Últimas operaciones --}}
    <div class="bg-gray-900 rounded-xl border border-gray-800">
        <div class="px-6 py-4 border-b border-gray-800 flex items-center justify-between">
            <h2 class="font-semibold">Últimas operaciones</h2>
            <a href="{{ route('operaciones.index') }}" class="text-emerald-400 text-sm hover:text-emerald-300">Ver todas →</a>
        </div>
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-800 text-gray-400 text-sm">
                    <th class="text-left px-6 py-3">Par</th>
                    <th class="text-left px-6 py-3">Dirección</th>
                    <th class="text-left px-6 py-3">Fecha</th>
                    <th class="text-left px-6 py-3">Resultado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ultimasOperaciones as $operacion)
                <tr class="border-b border-gray-800 hover:bg-gray-800">
                    <td class="px-6 py-3">{{ $operacion->par->nombre }}</td>
                    <td class="px-6 py-3">
                        <span class="px-2 py-1 rounded text-xs font-bold
                            {{ $operacion->direccion === 'long' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                            {{ strtoupper($operacion->direccion) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-gray-400 text-sm">{{ $operacion->fecha_entrada }}</td>
                    <td class="px-6 py-3">
                        @if($operacion->resultado_dinero !== null)
                            <span class="{{ $operacion->resultado_dinero >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                                {{ $operacion->resultado_dinero >= 0 ? '+' : '' }}${{ number_format($operacion->resultado_dinero, 2) }}
                            </span>
                        @else
                            <span class="text-gray-500">Abierta</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">No hay operaciones todavía</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection