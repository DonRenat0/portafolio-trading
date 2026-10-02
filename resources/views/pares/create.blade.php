@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Nuevo Par</h1>
        <a href="{{ route('pares.index') }}" class="text-gray-400 hover:text-white">← Volver</a>
    </div>

    <form method="POST" action="{{ route('pares.store') }}" class="max-w-lg">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-sm text-gray-400 mb-2">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="EUR/USD">
                @error('nombre') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-2">Tipo</label>
                <select name="tipo" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    <option value="forex">Forex</option>
                    <option value="cripto">Cripto</option>
                    <option value="indice">Índice</option>
                    <option value="materia_prima">Materia Prima</option>
                </select>
                @error('tipo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-8">
            <button type="submit"
                class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold">
                Guardar Par
            </button>
        </div>
    </form>
@endsection