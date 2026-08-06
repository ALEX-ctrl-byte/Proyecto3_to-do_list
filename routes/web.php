<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

// Redirigir la raíz a las tareas
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Rutas de Tareas
Route::resource('tasks', TaskController::class);
Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');

// Rutas de Categorías y Etiquetas
Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
Route::resource('tags', TagController::class)->only(['index', 'store', 'destroy']);