<?php

use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\RemoteUrlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('register', [UserController::class, 'store'])->name('users.register');
Route::get('users', [UserController::class, 'index'])->name('users');
Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/', function () {
    for ($i=0; $i < 10; $i++) { 
        echo flashCode(App\System\Helpers\Encrypt::encrypt($i, $i)) . '<br>';
    }
});


Route::controller(DocumentsController::class)->group(function () {
    Route::get('documents/{clientId}', 'index');
    Route::get('documents/{codigo}/{clientId}', 'show');
    Route::post('documents', 'store');
    // Route::delete('documents/{id}', 'destroy');
});

Route::controller(RemoteUrlController::class)->group(function () {
    Route::post('oauth', 'oauth');
    Route::post('store', 'store');
});