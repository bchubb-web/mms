<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])
    ->name('posts.index');

Route::get('/{post}', [\App\Http\Controllers\PostController::class, 'show'])
    ->name('posts.show');
