<?php

use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Сообщества
    Route::resource('communities', CommunityController::class);

    // Посты
    Route::resource('communities.posts', PostController::class);

    // Комментарии
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Голосование
    Route::post('votes', [VoteController::class, 'store'])->name('votes.store');
});

require __DIR__.'/auth.php';