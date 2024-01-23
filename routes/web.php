<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginControler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/login', "login")->name('login');
Route::view('/privada', "secret")->name('privada');

Route::post('/inicia-sesion', [LoginControler::class,'login'])->name('inicia-sesion');
Route::get('/logout', [LoginControler::class,'logout'])->name('logout');