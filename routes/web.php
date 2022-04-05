<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;

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
    Route::resource('contact', ContactController::class)->except('create', 'store', 'show');
    
    Route::get('reset-password/{id}',   [UserController::class, 'forget'])    ->name('users.forget');
    Route::post('post/search',          [PostController::class, 'search'])    ->name('posts.search');
    Route::post('comments/search/{id}', [CommentController::class, 'search']) ->name('comments.search');
    Route::post('categories/search',    [CategoryController::class, 'search'])->name('categories.search');
    Route::post('users/search',         [UserController::class, 'search'])    ->name('users.search');
    Route::post('contact/search',       [ContactController::class, 'search']) ->name('contact.search');
});

Route::get('/',       [PublicController::class, 'index'])  ->name('public.index');
Route::get('tin-tuc',    [PublicController::class, 'blog'])   ->name('public.blog');
Route::get('lien-he', [PublicController::class, 'contact'])->name('public.contact');
Route::post('search', [PublicController::class, 'search']) ->name('public.search');
Route::post('comment/{id}', [PublicController::class, 'comment']) -> name('public.comment');
Route::get('lien-he', [PublicController::class, 'contact'])->name('public.contact');
Route::post('lien-he', [PublicController::class, 'postContact'])->name('public.postContact');

Route::get('nguoi-dung', [PublicController::class, 'user'])->name('public.user');
Route::post('nguoi-dung', [PublicController::class, 'updateUser'])->name('public.update.user');

Route::get('thay-doi-mat-khau', [PublicController::class, 'changePass'])->name('public.user.pass');
Route::post('thay-doi-mat-khau', [PublicController::class, 'updatePass'])->name('public.update.pass');

Route::get('bookmark', [PublicController::class, 'bookmark'])->name('public.save.bookmark');
Route::get('unbookmark', [PublicController::class, 'unbookmark'])->name('public.unsave.bookmark');
Route::get('bai-viet-da-luu', [PublicController::class, 'getBookmark'])->name('public.getBookmark');

Route::get('{slug}',  [PublicController::class, 'getView'])->name('public.single');
