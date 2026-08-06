@extends('layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Lista de Tareas</h1>
    <a href="{{ route('tasks.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">+ Nueva Tarea</a>
</div>

<div class="grid grid-cols-1 gap-4">
    @forelse($tasks as $task)
        <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200 flex justify-between items-start">
            <div class="space-y-2">
                <div class="flex items-center space-x-3">
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-xl">
                            {!! $task->is_completed ? '✅' : '⭕' !!}
                        </button>
                    </form>
                    <h2 class="text-xl font-semibold {{ $task->is_completed ? 'line-through text-gray-400' : '' }}">
                        {{ $task->title }}
                    </h2>
                </div>

                @if($task->description)
                    <p class="text-gray-600 text-sm ml-8">{{ $task->description }}</p>
                @endif

                <div class="flex items-center space-x-2 ml-8 pt-1 text-xs">
                    @if($task->category)
                        <span class="bg-blue-100 text-blue-800 font-medium px-2.5 py-0.5 rounded">
                            📁 {{ $task->category->name }}
                        </span>
                    @endif

                    @foreach($task->tags as $tag)
                        <span class="bg-gray-200 text-gray-700 px-2 py-0.5 rounded-full">
                            🏷️ {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="flex space-x-2">
                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Editar</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar esta tarea?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Eliminar</button>
                </form>
            </div>
        </div>
    @empty
        <div class="bg-white p-8 text-center text-gray-500 rounded-lg shadow-sm">
            No hay tareas registradas. ¡Crea una para comenzar!
        </div>
    @endforelse
</div>
@endsection