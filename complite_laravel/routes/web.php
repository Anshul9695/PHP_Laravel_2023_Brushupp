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


Route::get('/register', [UserController::class, 'create'])->name('register');
Route::get('/forget', [UserController::class, 'forget'])->name('forget');
Route::get('/reset', [UserController::class, 'reset_password'])->name('reset');

Route::post('/registerUser', [UserController::class, 'registerUser'])->name('registerUser');
Route::post('/loginPost', [UserController::class, 'loginPost'])->name('loginPost');

Route::group(['middleware' => ['Logincheck']], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});
