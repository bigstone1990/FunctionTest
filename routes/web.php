<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DraggableTestController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/draggabletest/index', [DraggableTestController::class, 'index'])->name('draggabletest.index');
    Route::get('/draggabletest/index2', [DraggableTestController::class, 'index2'])->name('draggabletest.index2');
    Route::get('/draggabletest/dropzone1', [DraggableTestController::class, 'dropzone1'])->name('draggabletest.dropzone1');
    Route::get('/draggabletest/multi1', [DraggableTestController::class, 'multi1'])->name('draggabletest.multi1');
    Route::get('/draggabletest/multi2', [DraggableTestController::class, 'multi2'])->name('draggabletest.multi2');
    Route::get('/draggabletest/sortablejs1', [DraggableTestController::class, 'sortablejs1'])->name('draggabletest.sortablejs1');
    Route::get('/draggabletest/mix1', [DraggableTestController::class, 'mix1'])->name('draggabletest.mix1');
    Route::get('/draggabletest/draggable1', [DraggableTestController::class, 'draggable1'])->name('draggabletest.draggable1');
    Route::get('/draggabletest/sortable1', [DraggableTestController::class, 'sortable1'])->name('draggabletest.sortable1');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
