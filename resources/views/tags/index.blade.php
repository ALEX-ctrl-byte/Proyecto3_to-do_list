@extends('layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Nueva Etiqueta</h2>
        <form action="{{ route('tags.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="name" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">Crear Etiqueta</button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Etiquetas Existentes</h2>
        <ul class="divide-y divide-gray-200">
            @forelse($tags as $tag)
                <li class="py-3 flex justify-between items-center">
                    <div>
                        <span class="font-medium bg-gray-100 px-3 py-1 rounded-full text-sm">🏷️ {{ $tag->name }}</span>
                        <span class="text-xs text-gray-500 ml-2">({{ $tag->tasks_count }} tareas)</span>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('tags.edit', $tag) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium mr-3">Editar</a>
                        <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('¿Eliminar etiqueta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Eliminar</button>
                        </form>
                    </div>
                </li>
            @empty
                <li class="py-3 text-gray-500 text-center">No hay etiquetas.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection