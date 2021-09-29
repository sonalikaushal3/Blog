<?php

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
    return view('auth.login');
});

Auth::routes();
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('admin');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user')->middleware('user');
Route::resource('blog', App\Http\Controllers\BlogController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
