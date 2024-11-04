<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/add', [ProjectController::class,'store'])->name('projects.store');
    Route::get('projects/{projectId}/settings', [ProjectController::class,'edit'])->name( 'projects.settings');
    Route::put('projects/{projectId}', [ProjectController::class,'update'])->name('projects.update');
    Route::delete('/projects/{projectId}', [ProjectController::class,'destroy'])->name('projects.delete');
    //tasks
    Route::get('/{projectName}/{projectId}/tasks', [TaskController::class,'index'])->name('tasks.index');
    Route::get('/{projectName}/{projectId}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/{projectName}/{projectId}/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/{projectName}/{projectId}/tasks/{taskId}/edit', [TaskController::class,'edit'])->name('tasks.edit');
    Route::put('/{projectName}/{projectId}/tasks/{taskId}', [TaskController::class,'update'])->name( 'tasks.update');
    Route::delete('/{projectName}/{projectId}/tasks/{taskId}/delete', [TaskController::class,'destroy'])->name('tasks.delete');
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
