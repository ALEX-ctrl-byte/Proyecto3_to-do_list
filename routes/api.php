<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Laravel actúa solo como proveedor de datos (API REST).
| React consume estos endpoints para el renderizado y experiencia de usuario.
*/

// Gestión de Usuarios (públicas)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con Sanctum (token Bearer)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Gestión de Tareas (solo del usuario autenticado)
    Route::apiResource('tasks', TaskController::class);

    // Gestión de Categorías (globales)
    Route::apiResource('categories', CategoryController::class);

    // Gestión de Etiquetas (globales)
    Route::apiResource('tags', TagController::class);
});
