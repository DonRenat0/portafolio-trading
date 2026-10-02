@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Operaciones</h1>
        <a href="{{ route('operaciones.create') }}"
           class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg">
            + Nueva Operación
        </a>
    </div>

    @php
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
    @endphp

    @forelse($agrupadas as $anio => $porMes)
    <div class="mb-6">
        {{-- AÑO --}}
        <button onclick="toggle('anio-{{ $anio }}')"
                class="w-full flex items-center justify-between bg-gray-800 hover:bg-gray-700 rounded-lg px-5 py-3 mb-2">
            <span class="font-bold text-lg">📅 {{ $anio }}</span>
            <span class="text-gray-400 text-sm">{{ $porMes->flatten(1)->flatten()->count() }} operaciones</span>
        </button>

        <div id="anio-{{ $anio }}" class="ml-4 space-y-3">
            @foreach($porMes as $mes => $porSemana)
            <div>
                {{-- MES --}}
                <button onclick="toggle('mes-{{ $anio }}-{{ $mes }}')"
                        class="w-full flex items-center justify-between bg-gray-850 bg-gray-800/60 hover:bg-gray-700 rounded-lg px-5 py-2.5 mb-2">
                   <span class="font-semibold">{{ $meses[$mes] ?? 'Sin mes' }}</span>
                    <span class="text-gray-400 text-sm">{{ $porSemana->flatten()->count() }} operaciones</span>
                </button>

                <div id="mes-{{ $anio }}-{{ $mes }}" class="ml-4 space-y-3">
                    @foreach($porSemana as $semana => $ops)
                    <div>
                        {{-- SEMANA --}}
                        @php
                            $resultadoSemana = $ops->sum('resultado_dinero');
                        @endphp
                        <button onclick="toggle('semana-{{ $anio }}-{{ $mes }}-{{ $semana }}')"
                                class="w-full flex items-center justify-between bg-gray-800/40 hover:bg-gray-700 rounded-lg px-5 py-2 mb-2 border border-gray-800">
                            <span class="text-gray-300 text-sm">Semana {{ $semana }}</span>
                            <span class="flex items-center gap-3 text-sm">
                                <span class="text-gray-500">{{ $ops->count() }} ops</span>
                                @if($resultadoSemana != 0)
                                    <span class="font-semibold {{ $resultadoSemana >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                                        {{ $resultadoSemana >= 0 ? '+' : '' }}${{ number_format($resultadoSemana, 2) }}
                                    </span>
                                @endif
                            </span>
                        </button>

                        <div id="semana-{{ $anio }}-{{ $mes }}-{{ $semana }}" class="bg-gray-900 rounded-xl border border-gray-800 ml-4">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-800 text-gray-400 text-xs">
                                        <th class="text-left px-6 py-3">Par</th>
                                        <th class="text-left px-6 py-3">Dirección</th>
                                        <th class="text-left px-6 py-3">Entrada</th>
                                        <th class="text-left px-6 py-3">Salida</th>
                                        <th class="text-left px-6 py-3">Resultado</th>
                                        <th class="text-left px-6 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ops as $operacion)
                                    <tr class="border-b border-gray-800 hover:bg-gray-800">
                                        <td class="px-6 py-3">{{ $operacion->par->nombre }}</td>
                                        <td class="px-6 py-3">
                                            <span class="px-2 py-1 rounded text-xs font-bold
                                                {{ $operacion->direccion === 'long' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                                                {{ strtoupper($operacion->direccion) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-3">{{ $operacion->precio_entrada }}</td>
                                        <td class="px-6 py-3">{{ $operacion->precio_salida ?? '-' }}</td>
                                        <td class="px-6 py-3">
                                            @if($operacion->resultado_dinero !== null)
                                                <span class="{{ $operacion->resultado_dinero >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                                                    {{ $operacion->resultado_dinero >= 0 ? '+' : '' }}{{ $operacion->resultado_dinero }}$
                                                </span>
                                            @else
                                                <span class="text-gray-500">Abierta</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3">
                                            <a href="{{ route('operaciones.show', $operacion) }}" class="text-blue-400 hover:text-blue-300 mr-3">Ver</a>
                                            <a href="{{ route('operaciones.edit', $operacion) }}" class="text-yellow-400 hover:text-yellow-300">Editar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
        <div class="bg-gray-900 rounded-xl border border-gray-800 px-6 py-12 text-center text-gray-500">
            No hay operaciones todavía
        </div>
    @endforelse

    <script>
        function toggle(id) {
            const el = document.getElementById(id);
            el.classList.toggle('hidden');
        }
    </script>
@endsection