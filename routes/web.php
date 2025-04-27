<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DiscussionController;

Route::middleware(['auth'])->group(function () {
    // Chat routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{chatRoom}/messages', [ChatController::class, 'messages'])->name('chat.messages');
    Route::post('/chat/{chatRoom}/messages', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');

    // Discussion routes
    Route::get('/discussion', [DiscussionController::class, 'index'])->name('discussion.index');
    Route::post('/discussion', [DiscussionController::class, 'store'])->name('discussion.store');
});