@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Nueva Etiqueta</h1>
        <a href="{{ route('etiquetas.index') }}" class="text-gray-400 hover:text-white">← Volver</a>
    </div>

    <form method="POST" action="{{ route('etiquetas.store') }}" class="max-w-lg">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-sm text-gray-400 mb-2">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="Tendencia, Reversión...">
                @error('nombre') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-2">Color</label>
                <div class="flex items-center gap-4">
                    <input type="color" name="color" value="{{ old('color', '#3498db') }}"
                        class="w-12 h-10 rounded cursor-pointer bg-transparent border-0">
                    <span class="text-gray-400 text-sm">Selecciona un color para la etiqueta</span>
                </div>
                @error('color') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8">
            <button type="submit"
                class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold">
                Guardar Etiqueta
            </button>
        </div>
    </form>
@endsection