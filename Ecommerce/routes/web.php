<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/RegisterAdmin',[AdminController::class,'RegisterAdmin'])->name('RegisterAdmin');
Route::post('/registerpost',[AdminController::class,'registerpost'])->name('registerpost');
Route::get('/admin_login',[AdminController::class,'admin_login'])->name('admin_login');
Route::post('/login_post',[AdminController::class,'login_post'])->name('login_post');

Route::group(['middleware' => ['checkUserLogin']], function () {
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/logout',[AdminController::class,'logout'])->name('logout');

    // manage category 
    Route::get('/add_category',[CategoryController::class,'add_category'])->name('add_category');
    Route::post('/categoryPost',[CategoryController::class,'categoryPost'])->name('categoryPost');
    Route::get('/categoryList',[CategoryController::class,'categoryList'])->name('categoryList');
    Route::get('/CateList',[CategoryController::class,'CateList'])->name('CateList');
    Route::get('/deleteData/{id}',[CategoryController::class,'deleteData'])->name('deleteData');
    Route::get('/editCat/{cat_id}',[CategoryController::class,'editCat'])->name('editCat');
    Route::post('/updateCat',[CategoryController::class,'updateCat'])->name('updateCat');
});