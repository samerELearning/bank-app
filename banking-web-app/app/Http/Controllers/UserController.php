<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) { // if user is logged in
            // Check the user's role and redirect accordingly
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        }
        return view('register');
    }

    /**
     * Handle the registration form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role' => 'user',
            'status' => 'active',
        ]);

        Auth::login($user);

        return redirect('/user/dashboard');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (Auth::check()) { // if user is logged in
            // Check the user's role and redirect accordingly
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Handle the login form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // Get the currently authenticated user
            $user = Auth::user();
    
            // Check the user's role and redirect accordingly
            if ($user->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        }

        return back()->withErrors([
            'loginError' => 'Invalid credentials.',
        ]);
    }


    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserDashboard()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('userDashboard');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Create Bank Account form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateBankAccountForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('create-bank-account');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Bank Accounts list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBankAccounts()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                $accounts = Auth::user()->accounts()->paginate(10);
                return view('bank-accounts', ['accounts' => $accounts]);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Transaction history list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTransactionHistory(Request $request)
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                $query = Transaction::query();

                if ($request->filled('account_number')) {
                    $account_number = $request->input('account_number');
                    $query->where(function ($query) use ($account_number) {
                        $query->whereHas('fromAccount', function ($query) use ($account_number) {
                            $query->where('account_number', $account_number);
                        })->orWhereHas('toAccount', function ($query) use ($account_number) {
                            $query->where('account_number', $account_number);
                        });
                    });
                }
                if ($request->filled('timestamp')) {
                    $query->whereDate('created_at', $request->input('timestamp'));
                }
                if ($request->filled('transaction_type')) {
                    $query->where('transaction_type', $request->input('transaction_type'));
                }

                $transactions = $query->paginate(10);
                return view('transactions', ['transactions' => $transactions]);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Withdraw form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showWithdrawForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('withdraw');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Deposit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDepositForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('deposit');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Transfer form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTransferForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('transfer');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }


    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminDashboard()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is an admin
            if (Auth::user()->role == 'admin') {
                return view('adminDashboard');
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is an admin
            if (Auth::user()->role == 'admin') {
                $users = User::paginate(10);
                return view('users', ['users' => $users]);
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}

