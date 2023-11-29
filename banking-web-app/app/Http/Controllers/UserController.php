<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        return view('login');
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
                return view('adminDashboard');
            }
        }
        return view('login');
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
                return redirect('/login');
            }
        }
        return view('login');
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

