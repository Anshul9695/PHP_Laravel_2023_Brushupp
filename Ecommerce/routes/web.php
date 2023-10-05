<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SizeController;
use App\Models\Brand;
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

    // Manage the Brands 
    Route::get('/add_brand_form',[BrandController::class,'add_brand_form'])->name('add_brand_form');
    Route::post('/add_brand_post',[BrandController::class,'AddBrand'])->name('add_brand_post');
    Route::get('/getBrand',[BrandController::class,'getBrand'])->name('getBrand');
    Route::get('/getBrandData',[BrandController::class,'getBrandData'])->name('getBrandData');
    Route::get('/deleteDatabrand/{brand_id}',[BrandController::class,'deleteDatabrand'])->name('deleteDatabrand');
    Route::get('/editBrand/{brand_id}',[BrandController::class,'editBrand'])->name('editBrand');
    Route::post('/updateBrand',[BrandController::class,'updateBrand'])->name('updateBrand');

    // Product Attributs manager 
    Route::get('/size',[SizeController::class,'SizeIndex'])->name('size');
    Route::post('/sizeAdd',[SizeController::class,'SizeAdd'])->name('sizeAdd');
    Route::get('/sizeList',[SizeController::class,'sizeList'])->name('sizeList');
    Route::get('/sizeListData',[SizeController::class,'sizeListData'])->name('sizeListData');

    // COUNTRY CITY STATE DROP DOWN BY AJAX 
    Route::get('/getCountry',[CountryController::class,'getCountry'])->name('getCountry');
    Route::post('/getCity/{country_id}',[CountryController::class,'getCity'])->name('getCity');
    Route::post('/getState/{city_id}',[CountryController::class,'getState'])->name('getState');
    Route::post('/getVillage/{state_id}',[CountryController::class,'getVillage'])->name('getVillage');
});