<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function(){
    return view('login.index');
});

Route::post('/admin',                  [UserController::class, 'logout'])->name('users.logout');
Route::post('painel',                  [UserController::class, 'login'])->name('login');

//Rotas usuários
Route::post('users',                    [UserController::class, 'insert'])->name('users.insert');
Route::get('users/inserir',             [UserController::class, 'create'])->name('users.inserir');
Route::get('users/{item}/edit',         [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{item}',              [UserController::class, 'editar'])->name('users.editar');
Route::delete('users/{item}',           [UserController::class, 'delete'])->name('users.delete');
Route::get('users/{item}',              [UserController::class, 'modal'])->name('users.modal');
Route::get('users',                     [UserController::class, 'index'])->name('users.index');


//Rotas painel admin
Route::get('home-admin',                [AdminController::class, 'index'])->name('admin.index');
Route::put('admin/{user}',              [AdminController::class, 'edit'])->name('admin.edit');
