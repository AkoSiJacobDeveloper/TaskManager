<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompletedTaskController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Login');
})->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/about', function() {
        return Inertia::render('About');
    })->name('about');
    Route::get('/contact', function() {
        return Inertia::render('Contact');
    })->name('contact');

    Route::get('/completed', [TaskController::class, 'completed'])->name('completed');
    Route::get('/userdashboard', [DashboardController::class, 'index'])->name('userdashboard');
    Route::get('/pending', [TaskController::class, 'index'])->name('pending');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');  
});

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/register', [AuthController::class, 'showSignupForm'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
