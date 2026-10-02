@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Cuentas</h1>
        <a href="{{ route('cuentas.create') }}"
           class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg">
            + Nueva Cuenta
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($cuentas as $cuenta)
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold">{{ $cuenta->nombre }}</h2>
                <div class="flex gap-3">
                    <a href="{{ route('cuentas.edit', $cuenta) }}"
                       class="text-yellow-400 hover:text-yellow-300 text-sm">Editar</a>
                    <form method="POST" action="{{ route('cuentas.destroy', $cuenta) }}"
                          onsubmit="return confirm('¿Borrar esta cuenta?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Borrar</button>
                    </form>
                </div>
            </div>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-400">Capital inicial</span>
                    <span class="text-white">${{ number_format($cuenta->capital_inicial, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Fecha inicio</span>
                    <span class="text-white">{{ $cuenta->fecha_inicio }}</span>
                </div>
                @if($cuenta->descripcion)
                <div class="mt-3 text-gray-400">{{ $cuenta->descripcion }}</div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-2 text-center text-gray-500 py-12">No hay cuentas todavía</div>
        @endforelse
    </div>
@endsection