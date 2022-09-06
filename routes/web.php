<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteAuthController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('google', [SocialiteAuthController::class, 'googleRedirect'])->name('auth/google');
Route::get('/callback', [SocialiteAuthController::class, 'loginWithGoogle']);
Route::get('personaldetail', [ProfileController::class, 'PersonalDetail'])->name('personaldetail');
Route::post('savepersonaldetail', [ProfileController::class, 'savePersonalDetail'])->name('savepersonaldetail');
Route::get('/userlist', [App\Http\Controllers\HomeController::class, 'userList']);
