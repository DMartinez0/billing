<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
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


// Route::controller(ProductController::class)->group(function () {
//     Route::get('products', 'index');
//     Route::get('products/{id}', 'show');
//     Route::post('products', 'store');
//     Route::delete('products/{id}', 'destroy');
// });