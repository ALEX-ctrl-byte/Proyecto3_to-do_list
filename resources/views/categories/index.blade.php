@extends('layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Nueva Categoría</h2>
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nombre</label>
                <input type="text" name="name" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">Crear Categoría</button>
        </form>
    </div>

    <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Categorías Existentes</h2>
        <ul class="divide-y divide-gray-200">
            @forelse($categories as $category)
                <li class="py-3 flex justify-between items-center">
                    <div>
                        <span class="font-medium">{{ $category->name }}</span>
                        <span class="text-xs text-gray-500 ml-2">({{ $category->tasks_count }} tareas)</span>
                    </div>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Eliminar categoría?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Eliminar</button>
                    </form>
                </li>
            @empty
                <li class="py-3 text-gray-500 text-center">No hay categorías.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection