@extends('layout')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Editar Tarea</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Título *</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Descripción</label>
            <textarea name="description" rows="3" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Categoría</label>
            <select name="category_id" class="w-full border-gray-300 border p-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                <option value="">-- Sin categoría --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Etiquetas</label>
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                    <label class="inline-flex items-center bg-gray-100 px-3 py-1 rounded-full cursor-pointer hover:bg-gray-200">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $task->tags->contains($tag->id) ? 'checked' : '' }} class="mr-2">
                        <span class="text-sm">{{ $tag->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex items-center pt-2">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_completed" value="1" {{ $task->is_completed ? 'checked' : '' }} class="mr-2 h-4 w-4">
                <span class="text-sm font-medium">Marcar como completada</span>
            </label>
        </div>

        <div class="flex justify-end space-x-2 pt-4">
            <a href="{{ route('tasks.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Actualizar Tarea</button>
        </div>
    </form>
</div>
@endsection