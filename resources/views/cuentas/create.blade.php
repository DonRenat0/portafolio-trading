@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Nueva Cuenta</h1>
        <a href="{{ route('cuentas.index') }}" class="text-gray-400 hover:text-white">← Volver</a>
    </div>

    <form method="POST" action="{{ route('cuentas.store') }}" class="max-w-lg">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block text-sm text-gray-400 mb-2">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="Cuenta Principal">
                @error('nombre') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-2">Capital inicial ($)</label>
                <input type="number" step="0.01" name="capital_inicial" value="{{ old('capital_inicial') }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="1000.00">
                @error('capital_inicial') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-2">Fecha inicio</label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                @error('fecha_inicio') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm text-gray-400 mb-2">Descripción <span class="text-gray-500">(opcional)</span></label>
                <textarea name="descripcion" rows="3"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="Descripción de la cuenta...">{{ old('descripcion') }}</textarea>
            </div>
        </div>

        <div class="mt-8">
            <button type="submit"
                class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold">
                Guardar Cuenta
            </button>
        </div>
    </form>
@endsection
