<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[UserController::class,'index'])->name('login_page');
Route::get('/register',[UserController::class,'create'])->name('register');
Route::get('/forget',[UserController::class,'forget'])->name('forget');
Route::get('/reset',[UserController::class,'reset_password'])->name('reset');

Route::post('/registerUser',[UserController::class,'registerUser'])->name('registerUser');