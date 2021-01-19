<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function(){
    return view('login.index');
});

Route::post('/',                       [UserController::class, 'logout'])->name('user.logout');
Route::post('painel',                  [UserController::class, 'login'])->name('login');
Route::delete('user/{item}',           [UserController::class, 'delete'])->name('users.delete');
Route::get('user/{item}',              [UserController::class, 'modal'])->name('users.modal');
Route::get('user',                     [UserController::class, 'index'])->name('users.index');
