<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/register', function () {
//     return view('register');
// });
Route::view('/register', 'register')->name('register'); // GET

Route::post('/register', [UserController::class, 'store'])->name('register.store');
