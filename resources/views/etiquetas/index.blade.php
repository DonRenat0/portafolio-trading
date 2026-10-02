@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Etiquetas</h1>
        <a href="{{ route('etiquetas.create') }}"
           class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg">
            + Nueva Etiqueta
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($etiquetas as $etiqueta)
        <div class="bg-gray-900 rounded-xl border border-gray-800 p-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-4 h-4 rounded-full" style="background-color: {{ $etiqueta->color }}"></div>
                <span class="font-semibold">{{ $etiqueta->nombre }}</span>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('etiquetas.edit', $etiqueta) }}"
                   class="text-yellow-400 hover:text-yellow-300 text-sm">Editar</a>
                <form method="POST" action="{{ route('etiquetas.destroy', $etiqueta) }}"
                      onsubmit="return confirm('¿Borrar esta etiqueta?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Borrar</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-gray-500 py-12">No hay etiquetas todavía</div>
        @endforelse
    </div>
@endsection