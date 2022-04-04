<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;

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

Route::get('ckeditor',         [CkeditorController::class, 'index']);
Route::post('ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');

Route::group(['middleware' => 'checkLogin'], function() {
	Route::get('/dang-nhap',      [BaseController::class, 'login'])           ->name('public.login');
    Route::post('/dang-nhap',     [BaseController::class, 'auth'])            ->name('public.login.post');
    Route::get('/dang-ky',        [BaseController::class, 'registration'])    ->name('public.registration');
    Route::post('/dang-ky',       [BaseController::class, 'registrationPost'])->name('public.registration.post');
    Route::get('/quen-mat-khau',  [BaseController::class, 'forget'])          ->name('public.forget');
    Route::post('/quen-mat-khau', [BaseController::class, 'forgetPost'])      ->name('public.forget.post');
});

Route::get('/dang-xuat', [BaseController::class, 'logout'])->name('public.logout');

Route::group(['middleware' => 'checkAdminLogin', 'prefix' => 'admin'], function() {
	Route::get('/', [BaseController::class, 'dashboard'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
    Route::resource('comments', CommentController::class)->only(['index', 'show', 'destroy']);
    
    Route::get('reset-password/{id}',   [UserController::class, 'forget'])    ->name('users.forget');
    Route::post('post/search',          [PostController::class, 'search'])    ->name('posts.search');
    Route::post('comments/search/{id}', [CommentController::class, 'search']) ->name('comments.search');
    Route::post('categories/search',    [CategoryController::class, 'search'])->name('categories.search');
    Route::post('users/search',         [UserController::class, 'search'])    ->name('users.search');
});

Route::group(['prefix' => '/'], function() {
    Route::get('/',       [PublicController::class, 'index'])  ->name('public.index');
    Route::get('tin-tuc',    [PublicController::class, 'blog'])   ->name('public.blog');
    Route::get('lien-he', [PublicController::class, 'contact'])->name('public.contact');
    Route::post('search', [PublicController::class, 'search']) ->name('public.search');
    Route::post('comment/{id}', [PublicController::class, 'comment']) -> name('public.comment');
    Route::get('{slug}',  [PublicController::class, 'getView'])->name('public.single');
});
