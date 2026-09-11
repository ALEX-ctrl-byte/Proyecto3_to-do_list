<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Listar únicamente las tareas del usuario autenticado.
     */
    public function index(Request $request)
    {
        $tasks = $request->user()
            ->tasks()
            ->with(['category', 'tags'])
            ->oldest()
            ->paginate(10);

        return response()->json($tasks);
    }

    /**
     * Crear una tarea para el usuario autenticado.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_completed' => 'boolean',
        ]);

        $task = $request->user()->tasks()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'is_completed' => $validated['is_completed'] ?? false,
        ]);

        if (! empty($validated['tags'])) {
            $task->tags()->sync($validated['tags']);
        }

        return response()->json($task->load(['category', 'tags']), 201);
    }

    /**
     * Mostrar una tarea propia. 403 si no pertenece al usuario.
     */
    public function show(Request $request, Task $task)
    {
        $this->authorizeOwnership($request, $task);

        return response()->json($task->load(['category', 'tags']));
    }

    /**
     * Editar una tarea propia.
     */
    public function update(Request $request, Task $task)
    {
        $this->authorizeOwnership($request, $task);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_completed' => 'boolean',
        ]);

        $task->update($validated);

        if (array_key_exists('tags', $validated)) {
            $task->tags()->sync($validated['tags'] ?? []);
        }

        return response()->json($task->load(['category', 'tags']));
    }

    /**
     * Eliminar una tarea propia.
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorizeOwnership($request, $task);

        $task->delete();

        return response()->json(null, 204);
    }

    /**
     * Verifica que la tarea pertenezca al usuario autenticado.
     */
    private function authorizeOwnership(Request $request, Task $task): void
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403, 'No tienes permiso sobre esta tarea.');
        }
    }
}
