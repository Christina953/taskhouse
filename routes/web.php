<?php

use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('projects.index');
})->name('projects.index');

Route::get('/workers', [WorkerController::class, 'index'])->name('workers.index');

Route::post('/workers', [WorkerController::class, 'store'])->name('workers.store');

Route::get('/workers/{worker}/edit', [WorkerController::class, 'edit'])->name('workers.edit');

Route::put('/workers/{worker}', [WorkerController::class, 'update'])->name('workers.update');

Route::delete('/workers/{worker}', [WorkerController::class, 'destroy'])->name('workers.destroy');
