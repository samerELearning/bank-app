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

//User registration and authentication routes
Route::get('register', 'App\Http\Controllers\UserController@showRegistrationForm')->name('register');
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::get('login', 'App\Http\Controllers\UserController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('logout', 'App\Http\Controllers\UserController@logout')->name('logout');

//User and Admin dashboard routes
Route::get('/user/dashboard', 'App\Http\Controllers\UserController@showUserDashboard')->name('user.dashboard');
Route::get('/admin/dashboard', 'App\Http\Controllers\UserController@showAdminDashboard')->name('admin.dashboard');

//Client operations routes
Route::get('/user/create-bank-account', 'App\Http\Controllers\UserController@showCreateBankAccountForm')->name('create.bank.account');
Route::get('/user/show-bank-accounts', 'App\Http\Controllers\UserController@showBankAccounts')->name('show.bank.accounts');
Route::get('/user/show-transaction-history', 'App\Http\Controllers\UserController@showTransactionHistory')->name('show.transaction.history');
Route::get('/user/withdraw', 'App\Http\Controllers\UserController@showWithdrawForm')->name('show.withdraw.form');
Route::get('/user/deposit', 'App\Http\Controllers\UserController@showDepositForm')->name('show.deposit.form');
Route::get('/user/transfer', 'App\Http\Controllers\UserController@showTransferForm')->name('show.transfer.form');

//Admin operations routes
Route::get('/admin/show-users', 'App\Http\Controllers\UserController@showUsers')->name('show.users');
Route::get('/admin/show-user-accounts', 'App\Http\Controllers\UserController@showUserAccounts')->name('show.user.accounts');
Route::get('/admin/show-requests', 'App\Http\Controllers\UserController@showRequests')->name('show.requests');
Route::get('/admin/withdraw', 'App\Http\Controllers\UserController@showAdminWithdrawForm')->name('show.admin.withdraw.form');
Route::get('/admin/deposit', 'App\Http\Controllers\UserController@showAdminDepositForm')->name('show.admin.deposit.form');
Route::get('/admin/transfer', 'App\Http\Controllers\UserController@showAdminTransferForm')->name('show.admin.transfer.form');