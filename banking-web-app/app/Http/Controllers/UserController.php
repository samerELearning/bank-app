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

        return redirect('/dashboard');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
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
                return redirect('/dashboard');
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
        // Ensure the user is not an admin
        if (Auth::user()->role != 'admin') {
            return view('userDashboard');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminDashboard()
    {
        // Ensure the user is an admin
        if (Auth::user()->role == 'admin') {
            return view('adminDashboard');
        } else {
            return redirect('/login');
        }
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

