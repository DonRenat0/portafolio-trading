<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Trading</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-950 text-white min-h-screen">

    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
<a href="{{ route('dashboard') }}" class="text-xl font-bold text-emerald-400">📈 Portfolio Trading</a>           
       <div class="flex gap-6">
    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white">Dashboard</a>
    <a href="{{ route('operaciones.index') }}" class="text-gray-300 hover:text-white">Operaciones</a>
    <a href="{{ route('cuentas.index') }}" class="text-gray-300 hover:text-white">Cuentas</a>
    <a href="{{ route('pares.index') }}" class="text-gray-300 hover:text-white">Pares</a>
    <a href="{{ route('etiquetas.index') }}" class="text-gray-300 hover:text-white">Etiquetas</a>
</div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        @yield('content')
        @if(session('success'))
    <div class="mb-6 bg-emerald-500/20 border border-emerald-500/50 text-emerald-400 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-6 bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg">
        {{ session('error') }}
    </div>
@endif
    </main>

</body>
</html>