<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    if (Auth::check()) { // if user is logged in
        // Check the user's role and redirect accordingly
        if (Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/user/dashboard');
        }
    }
    return view('login');
});

Route::get('register', 'App\Http\Controllers\UserController@showRegistrationForm')->name('register');
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::get('login', 'App\Http\Controllers\UserController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('logout', 'App\Http\Controllers\UserController@logout')->name('logout');
Route::get('/user/dashboard', 'App\Http\Controllers\UserController@showUserDashboard')->name('user.dashboard');
Route::get('/admin/dashboard', 'App\Http\Controllers\UserController@showAdminDashboard')->name('admin.dashboard');