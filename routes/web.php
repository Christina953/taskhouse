<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('projects.index');
})->name('projects.index');

Route::get('/workers', function () {
    return view('workers.index');
})->name('workers.index');
