<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user =Auth::user();
            if ($user->role_id == 1) {
                // Redirect to the dashboard for users with role_id = 1
                Session::put('role', 'admin');
                return redirect()->intended('/dashboard');
            } elseif ($user->role_id == 2) {
                // Redirect to the hello page for users with role_id = 2
                Session::put('id', $user->id);
                Session::put('role', 'user');
                return redirect()->intended('/user/hello');
            } elseif ($user->role_id == 3) {
                // Handle other role IDs as needed
                Session::put('role', 'agent');
                return redirect()->intended('/agent_page');
            } else {
                // Handle other role IDs as needed
                Session::put('role', 'other');
                return redirect()->intended('/');
            }
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid email or password.']);
        }
    }
}
