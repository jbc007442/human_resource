<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // ✅ Validation
        $request->validate([
            'role' => 'required|in:jobseeker,company,admin',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|unique:users,phone',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.unique' => 'This email is already registered.',
            'phone.unique' => 'This phone number is already registered.',
        ]);

        // ✅ Create user (inactive by default)
        $user = User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password, // auto hashed via model cast
            'is_active' => false,
        ]);

        // ✅ Login user
        Auth::login($user);

        // ✅ Response
        return response()->json([
            'status' => true,
            'message' => 'Account created successfully! Your account is under review.',
            'redirect' => route('dashboard'),
            'is_active' => $user->is_active, // useful for frontend
        ]);
    }


    // LOGIN FORM SUBMIT
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = auth()->user();

            return response()->json([
                'status' => true,
                'message' => 'Login successful!',
                'redirect' => $user->getRedirectRoute()
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Invalid email or password.'
        ], 401);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout(); // logout user

        $request->session()->invalidate(); // invalidate session
        $request->session()->regenerateToken(); // regenerate CSRF token

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully!',
            'redirect' => route('login') // change if needed
        ]);
    }
}
