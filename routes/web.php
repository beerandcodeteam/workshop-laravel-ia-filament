<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\ChatSearch;

Route::get('/chat/stream/{message}', function ($message) {
    $chatSearch = new ChatSearch();
    return $chatSearch->streamResponse(urldecode($message));
})->name('chat.stream')->middleware(\App\Http\Middleware\StreamingMiddleware::class);
