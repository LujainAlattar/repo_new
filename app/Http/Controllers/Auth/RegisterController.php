<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class RegisterController extends Controller
{

public function showRegistrationForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Store the user's image if provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->move('/images');
        $imageName = basename($imagePath);
    }

    // Create the user
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => \Illuminate\Support\Facades\Hash::make($request->input('password')),
        'image' => $imageName ?? null,
        'role_id' => 2, // Assuming the default role is 'user'
    ]);

    // Redirect the user after registration
    return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
}

}

