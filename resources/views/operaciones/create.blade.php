@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Nueva Operación</h1>
        <a href="{{ route('operaciones.index') }}" class="text-gray-400 hover:text-white">← Volver</a>
    </div>

<form method="POST" action="{{ route('operaciones.store') }}" enctype="multipart/form-data">        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Par --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Par</label>
                <select name="id_par" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    @foreach($pares as $par)
                        <option value="{{ $par->id }}">{{ $par->nombre }}</option>
                    @endforeach
                </select>
                @error('id_par') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Cuenta --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Cuenta</label>
                <select name="id_cuenta" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    @foreach($cuentas as $cuenta)
                        <option value="{{ $cuenta->id }}">{{ $cuenta->nombre }}</option>
                    @endforeach
                </select>
                @error('id_cuenta') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Dirección --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Dirección</label>
                <select name="direccion" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    <option value="long">LONG</option>
                    <option value="short">SHORT</option>
                </select>
            </div>

            {{-- Tamaño posición --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Tamaño posición</label>
                <input type="number" step="0.01" name="tamano_posicion"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="0.01">
            </div>

            {{-- Fecha entrada --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Fecha entrada</label>
                <input type="datetime-local" name="fecha_entrada"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                @error('fecha_entrada') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Fecha salida --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Fecha salida <span class="text-gray-500">(opcional)</span></label>
                <input type="datetime-local" name="fecha_salida"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
            </div>

            {{-- Precio entrada --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Precio entrada</label>
                <input type="number" step="0.00001" name="precio_entrada"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="1.08500">
                @error('precio_entrada') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Precio salida --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Precio salida <span class="text-gray-500">(opcional)</span></label>
                <input type="number" step="0.00001" name="precio_salida"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="1.09000">
            </div>

            {{-- Resultado dinero --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Resultado ($) <span class="text-gray-500">(opcional)</span></label>
                <input type="number" step="0.01" name="resultado_dinero"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="-25.50">
            </div>

            {{-- Resultado porcentaje --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Resultado (%) <span class="text-gray-500">(opcional)</span></label>
                <input type="number" step="0.0001" name="resultado_porcentaje"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                    placeholder="-2.55">
            </div>

        </div>
        {{-- Imagen --}}
<div class="mt-6">
    <label class="block text-sm text-gray-400 mb-2">Captura de pantalla <span class="text-gray-500">(opcional)</span></label>
    <input type="file" name="imagen" accept="image/*"
        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white file:bg-emerald-500 file:text-white file:border-0 file:rounded file:px-3 file:py-1 file:mr-3">
    @error('imagen') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

        {{-- Comentario --}}
        <div class="mt-6">
            <label class="block text-sm text-gray-400 mb-2">Comentario <span class="text-gray-500">(opcional)</span></label>
            <textarea name="comentario" rows="3"
                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white"
                placeholder="Notas sobre la operación..."></textarea>
        </div>

        {{-- Etiquetas --}}
        @if($etiquetas->count())
        <div class="mt-6">
            <label class="block text-sm text-gray-400 mb-2">Etiquetas</label>
            <div class="flex flex-wrap gap-3">
                @foreach($etiquetas as $etiqueta)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="etiquetas[]" value="{{ $etiqueta->id }}"
                            class="rounded border-gray-600">
                        <span class="text-sm">{{ $etiqueta->nombre }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Botón --}}
        <div class="mt-8">
            <button type="submit"
                class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold">
                Guardar Operación
            </button>
        </div>

    </form>
@endsection