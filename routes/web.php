<?php

use Illuminate\Support\Facades\Route;

Route::get('posts', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('posts/{post}', [\App\Http\Controllers\PostController::class, 'show']);
