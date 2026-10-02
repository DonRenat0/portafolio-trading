@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Editar Operación</h1>
        <a href="{{ route('operaciones.show', $operacion) }}" class="text-gray-400 hover:text-white">← Volver</a>
    </div>

<form method="POST" action="{{ route('operaciones.update', $operacion) }}" enctype="multipart/form-data">        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Par --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Par</label>
                <select name="id_par" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    @foreach($pares as $par)
                        <option value="{{ $par->id }}" {{ $operacion->id_par == $par->id ? 'selected' : '' }}>
                            {{ $par->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Cuenta --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Cuenta</label>
                <select name="id_cuenta" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    @foreach($cuentas as $cuenta)
                        <option value="{{ $cuenta->id }}" {{ $operacion->id_cuenta == $cuenta->id ? 'selected' : '' }}>
                            {{ $cuenta->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Dirección --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Dirección</label>
                <select name="direccion" class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
                    <option value="long" {{ $operacion->direccion === 'long' ? 'selected' : '' }}>LONG</option>
                    <option value="short" {{ $operacion->direccion === 'short' ? 'selected' : '' }}>SHORT</option>
                </select>
            </div>

            {{-- Tamaño posición --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Tamaño posición</label>
                <input type="number" step="0.01" name="tamano_posicion"
                    value="{{ $operacion->tamano_posicion }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
            </div>

            {{-- Fecha entrada --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Fecha entrada</label>
                <input type="datetime-local" name="fecha_entrada"
                    value="{{ \Carbon\Carbon::parse($operacion->fecha_entrada)->format('Y-m-d\TH:i') }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
            </div>

            {{-- Fecha salida --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Fecha salida <span class="text-gray-500">(opcional)</span></label>
                <input type="datetime-local" name="fecha_salida"
                    value="{{ $operacion->fecha_salida ? \Carbon\Carbon::parse($operacion->fecha_salida)->format('Y-m-d\TH:i') : '' }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
            </div>

            {{-- Precio entrada --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Precio entrada</label>
                <input type="number" step="0.00001" name="precio_entrada"
                    value="{{ $operacion->precio_entrada }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
            </div>

            {{-- Precio salida --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Precio salida <span class="text-gray-500">(opcional)</span></label>
                <input type="number" step="0.00001" name="precio_salida"
                    value="{{ $operacion->precio_salida }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
            </div>

            {{-- Resultado dinero --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Resultado ($)</label>
                <input type="number" step="0.01" name="resultado_dinero"
                    value="{{ $operacion->resultado_dinero }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
            </div>

            {{-- Resultado porcentaje --}}
            <div>
                <label class="block text-sm text-gray-400 mb-2">Resultado (%)</label>
                <input type="number" step="0.0001" name="resultado_porcentaje"
                    value="{{ $operacion->resultado_porcentaje }}"
                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">
            </div>

        </div>

        {{-- Imagen --}}
<div class="mt-6">
    <label class="block text-sm text-gray-400 mb-2">Captura de pantalla <span class="text-gray-500">(opcional)</span></label>
    @if($operacion->imagen)
        <div class="mb-3">
            <img src="{{ asset('storage/' . $operacion->imagen) }}" alt="Captura actual"
                 class="rounded-lg max-w-xs border border-gray-800">
            <p class="text-gray-500 text-xs mt-1">Imagen actual. Sube una nueva para reemplazarla.</p>
        </div>
    @endif
    <input type="file" name="imagen" accept="image/*"
        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white file:bg-emerald-500 file:text-white file:border-0 file:rounded file:px-3 file:py-1 file:mr-3">
    @error('imagen') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
</div>

        {{-- Comentario --}}
        <div class="mt-6">
            <label class="block text-sm text-gray-400 mb-2">Comentario</label>
            <textarea name="comentario" rows="3"
                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white">{{ $operacion->comentario }}</textarea>
        </div>

        {{-- Etiquetas --}}
        @if($etiquetas->count())
        <div class="mt-6">
            <label class="block text-sm text-gray-400 mb-2">Etiquetas</label>
            <div class="flex flex-wrap gap-3">
                @foreach($etiquetas as $etiqueta)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="etiquetas[]" value="{{ $etiqueta->id }}"
                            {{ $operacion->etiquetas->contains($etiqueta->id) ? 'checked' : '' }}
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
                Guardar Cambios
            </button>
        </div>

    </form>
@endsection