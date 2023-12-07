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

//Client operation routes
Route::get('/user/create-bank-account', 'App\Http\Controllers\UserController@showCreateBankAccountForm')->name('create.bank.account');
Route::get('/user/show-bank-accounts', 'App\Http\Controllers\UserController@showBankAccounts')->name('show.bank.accounts');
Route::get('/user/show-transaction-history', 'App\Http\Controllers\UserController@showTransactionHistory')->name('show.transaction.history');
Route::get('/user/withdraw', 'App\Http\Controllers\UserController@showWithdrawForm')->name('show.withdraw.form');
Route::get('/user/deposit', 'App\Http\Controllers\UserController@showDepositForm')->name('show.deposit.form');
Route::get('/user/transfer', 'App\Http\Controllers\UserController@showTransferForm')->name('show.transfer.form');

//Admin operation routes
Route::get('/admin/show-users', 'App\Http\Controllers\UserController@showUsers')->name('show.users');
Route::get('/admin/{user}/show-user-accounts', 'App\Http\Controllers\UserController@showUserAccounts')->name('show.user.accounts');
Route::get('/admin/{user}/show-user-transactions', 'App\Http\Controllers\UserController@showUserTransactions')->name('show.user.transactions');
Route::get('/admin/show-requests', 'App\Http\Controllers\UserController@showRequests')->name('show.requests');
Route::get('/admin/withdraw', 'App\Http\Controllers\UserController@showAdminWithdrawForm')->name('show.admin.withdraw.form');
Route::get('/admin/deposit', 'App\Http\Controllers\UserController@showAdminDepositForm')->name('show.admin.deposit.form');
Route::get('/admin/transfer', 'App\Http\Controllers\UserController@showAdminTransferForm')->name('show.admin.transfer.form');
Route::get('/admin/create-bank-account', 'App\Http\Controllers\UserController@showAdminCreateAccountForm')->name('show.admin.create.account.form');

//Account operation routes for Client
Route::post('/user/create-bank-account', 'App\Http\Controllers\AccountController@createUserAccount');
Route::post('/user/withdraw', 'App\Http\Controllers\TransactionController@clientWithdraw');
Route::post('/user/deposit', 'App\Http\Controllers\TransactionController@clientDeposit');
Route::post('/user/transfer', 'App\Http\Controllers\TransactionController@clientTransfer');

//Account operation routes for Admin
Route::post('/admin/withdraw', 'App\Http\Controllers\TransactionController@adminWithdraw');
Route::post('/admin/deposit', 'App\Http\Controllers\TransactionController@adminDeposit');