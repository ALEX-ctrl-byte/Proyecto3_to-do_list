@extends('layout')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Editar Categoría</h2>
    
    <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium mb-1">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
        </div>

        <div class="flex items-center space-x-3">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700">Actualizar</button>
           <a href="{{ route('categories.index') }}" class="w-full text-center bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300">Cancelar</a>
    </form>
</div>
@endsection