@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Detalle de Operación</h1>
        <div class="flex gap-4">
            <a href="{{ route('operaciones.edit', $operacion) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                Editar
            </a>
            <a href="{{ route('operaciones.index') }}" class="text-gray-400 hover:text-white">← Volver</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Card izquierda --}}
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 space-y-4">

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Par</span>
                <span class="font-bold text-white">{{ $operacion->par->nombre }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Cuenta</span>
                <span class="text-white">{{ $operacion->cuenta->nombre }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Dirección</span>
                <span class="px-3 py-1 rounded text-sm font-bold
                    {{ $operacion->direccion === 'long' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                    {{ strtoupper($operacion->direccion) }}
                </span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Tamaño posición</span>
                <span class="text-white">{{ $operacion->tamano_posicion ?? '-' }}</span>
            </div>

        </div>

        {{-- Card derecha --}}
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6 space-y-4">

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Fecha entrada</span>
                <span class="text-white">{{ $operacion->fecha_entrada }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Fecha salida</span>
                <span class="text-white">{{ $operacion->fecha_salida ?? 'Abierta' }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Precio entrada</span>
                <span class="text-white">{{ $operacion->precio_entrada }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Precio salida</span>
                <span class="text-white">{{ $operacion->precio_salida ?? '-' }}</span>
            </div>

            <div class="flex items-center justify-between">
                <span class="text-gray-400 text-sm">Resultado</span>
                @if($operacion->resultado_dinero !== null)
                    <span class="font-bold {{ $operacion->resultado_dinero >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
                        {{ $operacion->resultado_dinero >= 0 ? '+' : '' }}{{ $operacion->resultado_dinero }}$
                        @if($operacion->resultado_porcentaje)
                            ({{ $operacion->resultado_porcentaje }}%)
                        @endif
                    </span>
                @else
                    <span class="text-gray-500">Sin resultado</span>
                @endif
            </div>

        </div>

    </div>
    
    {{-- Imagen --}}
@if($operacion->imagen)
<div class="mt-6 bg-gray-900 rounded-xl border border-gray-800 p-6">
    <h2 class="text-gray-400 text-sm mb-3">Captura</h2>
    <img src="{{ asset('storage/' . $operacion->imagen) }}" alt="Captura de la operación"
         class="rounded-lg max-w-full border border-gray-800">
</div>
@endif

    {{-- Comentario --}}
    @if($operacion->comentario)
    <div class="mt-6 bg-gray-900 rounded-xl border border-gray-800 p-6">
        <h2 class="text-gray-400 text-sm mb-2">Comentario</h2>
        <p class="text-white">{{ $operacion->comentario }}</p>
    </div>
    @endif

    {{-- Etiquetas --}}
    @if($operacion->etiquetas->count())
    <div class="mt-6 bg-gray-900 rounded-xl border border-gray-800 p-6">
        <h2 class="text-gray-400 text-sm mb-3">Etiquetas</h2>
        <div class="flex flex-wrap gap-2">
            @foreach($operacion->etiquetas as $etiqueta)
                <span class="px-3 py-1 rounded-full text-sm text-white"
                      style="background-color: {{ $etiqueta->color }}40; border: 1px solid {{ $etiqueta->color }}">
                    {{ $etiqueta->nombre }}
                </span>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Borrar --}}
    <div class="mt-8">
        <form method="POST" action="{{ route('operaciones.destroy', $operacion) }}"
              onsubmit="return confirm('¿Seguro que quieres borrar esta operación?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="bg-red-500/20 hover:bg-red-500/40 text-red-400 px-4 py-2 rounded-lg text-sm">
                Borrar operación
            </button>
        </form>
    </div>

@endsection