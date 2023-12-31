<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;

use App\Models\Blog;
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
Route::get('/reset/{email}/{token}', [UserController::class, 'reset_password'])->name('reset');
Route::post('/resetPassword',[UserController::class,'resetPassword'])->name('resetPassword');

Route::post('/registerUser', [UserController::class, 'registerUser'])->name('registerUser');
Route::post('/loginPost', [UserController::class, 'loginPost'])->name('loginPost');
Route::post('/forget',[UserController::class,'forget_password'])->name('forget');
Route::group(['middleware' => ['Logincheck']], function () {
    Route::get('/', [UserController::class, 'index'])->name('login');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/update_profile',[UserController::class,'update_profile'])->name('update_profile');
    Route::post('/update_profile_data',[UserController::class,'update_profile_data'])->name('update_profile_data');
    // Manage User Blog create update and delete and display by user role
Route::get('/create_blog',[BlogController::class,'create_blog'])->name('create_blog');
Route::post('/savePost',[BlogController::class,'savePost'])->name('savePost');
Route::get('/postListByUser',[BlogController::class,'postListByUser'])->name('postListByUser');
Route::get('/get_post_list',[BlogController::class,'get_post_list'])->name('get_post_list');
});
Route::get('/get_all_post_front',[BlogController::class,'get_all_post_front'])->name('get_all_post_front');
Route::get('/viewDetails/{id}',[BlogController::class,'viewDetails'])->name('viewDetails');
// manage comment section for user 

Route::post('/addComment',[CommentsController::class,'addComment'])->name('addComment');

