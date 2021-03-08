<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MoodleController;
use App\Http\Controllers\UserController;
use Illuminate\Cache\Lock;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/admin', function () {
    return view('login.index');
});

Route::post('/admin',                   [UserController::class, 'logout'])->name('users.logout');
Route::post('painel',                   [UserController::class, 'login'])->name('login');

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

//Rotas Links
Route::post('links',                    [LinkController::class, 'insert'])->name('links.insert');
Route::get('links/inserir',             [LinkController::class, 'create'])->name('links.inserir');
Route::get('links/{item}/edit',         [LinkController::class, 'edit'])->name('links.edit');
Route::put('links/{item}',              [LinkController::class, 'editar'])->name('links.editar');
Route::delete('links/{item}',           [LinkController::class, 'delete'])->name('links.delete');
Route::get('links/{item}',              [LinkController::class, 'modal'])->name('links.modal');
Route::get('links',                     [LinkController::class, 'index'])->name('links.index');
Route::post('links/reorder',            [LinkController::class, 'reorder'])->name('links.reorder');

//Rotas Moodle
Route::get('moodle',                                    [MoodleController::class, 'viewReports'])->name('moodle.index');
Route::get('moodle/lock',                               [MoodleController::class, 'lock'])->name('moodle.lock');
Route::get('moodle/unlock',                             [MoodleController::class, 'unlock'])->name('moodle.unlock');
Route::get('moodle/lista-usuarios/ava_sensu',           [MoodleController::class, 'listIgnoreA'])->name('moodle.listA');
Route::get('moodle/lista-usuarios/ead_fas',             [MoodleController::class, 'listIgnoreB'])->name('moodle.listB');
Route::get('moodle/lista-usuarios/ignorados',           [MoodleController::class, 'list'])->name('moodle.ignorados');
Route::delete('moodle/lista-usuarios/deletar/{id}',     [MoodleController::class, 'listDelete'])->name('moodle.delete');
Route::get('moodle/adcionar-ignore/',                   [MoodleController::class, 'addIgnore'])->name('moodle.add');
