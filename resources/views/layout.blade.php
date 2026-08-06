<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans min-h-screen">

    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('tasks.index') }}" class="text-xl font-bold tracking-wide">📋 Gestor de Tareas</a>
            <div class="space-x-4">
                <a href="{{ route('tasks.index') }}" class="hover:underline">Tareas</a>
                <a href="{{ route('categories.index') }}" class="hover:underline">Categorías</a>
                <a href="{{ route('tags.index') }}" class="hover:underline">Etiquetas</a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>