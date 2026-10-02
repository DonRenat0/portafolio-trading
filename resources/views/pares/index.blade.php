@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold">Pares</h1>
        <a href="{{ route('pares.create') }}"
           class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg">
            + Nuevo Par
        </a>
    </div>

    <div class="bg-gray-900 rounded-xl border border-gray-800">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-800 text-gray-400 text-sm">
                    <th class="text-left px-6 py-4">Nombre</th>
                    <th class="text-left px-6 py-4">Tipo</th>
                    <th class="text-left px-6 py-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pares as $par)
                <tr class="border-b border-gray-800 hover:bg-gray-800">
                    <td class="px-6 py-4 font-semibold">{{ $par->nombre }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-bold bg-blue-500/20 text-blue-400">
                            {{ $par->tipo }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex gap-4">
                        <a href="{{ route('pares.edit', $par) }}"
                           class="text-yellow-400 hover:text-yellow-300">Editar</a>
                        <form method="POST" action="{{ route('pares.destroy', $par) }}"
                              onsubmit="return confirm('¿Borrar este par?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">Borrar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">No hay pares todavía</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection