<?php

use Illuminate\Support\Facades\Route;

Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])
    ->name('posts.show');

Route::get('/{slug}', [\App\Http\Controllers\PageController::class, 'show'])
    ->name('pages.show');
