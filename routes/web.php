<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;

// Статические страницы
Route::get('/', function () {
    return view('about');
});

Route::get('/about', [PageController::class, 'about'])->name('about');

// CRUD-маршруты для статей (заменяет 7 отдельных маршрутов)
Route::resource('articles', ArticleController::class);