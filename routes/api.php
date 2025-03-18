<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('auth:sanctum')->group(function () {
    Broadcast::routes();

    Route::controller(DocumentController::class)->group(function () {
        Route::get('/documents', 'index'); // Get all documents
        Route::post('/documents', 'store'); // Create a document
        Route::get('/documents/{document}', 'get'); // Get a specific document
        Route::put('/documents/{document}', 'update'); // Update a document
        Route::get('/documents/{document}/history', 'history'); // Get document history
    });

    Route::controller(CollaboratorController::class)->group(function () {
        Route::post('/documents/{document}/collaborators', 'add'); // Add collaborator
        Route::delete('/documents/{document}/collaborators', 'remove'); // Remove collaborator
        Route::get('/documents/{document}/active', 'active'); // Get active collaborators
    });
});
