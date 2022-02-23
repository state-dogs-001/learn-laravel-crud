<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// Users model
use App\Models\User;

class AuthController extends Controller
{
    // Register function
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password'])
        ]);
        $token = $user->createToken('secret')->plainTextToken;
        $response = response()->json([
            'status' => 'ok',
            'message' => 'Register successfully.',
            'user' => $user,
            'token' => $token
        ]);
        return $response;
    }

    // Login function
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);
        $user = User::where('email', $fields['email'])->first();
        if (!$user) {
            // Invalid email
            $response = response()->json([
                'status' => 'error',
                'message' => 'Invalid email, this email not ready exit.'
            ]);
            return $response;
        } else {
            $isPassword = Hash::check($fields['password'], $user->password);
            if (!$isPassword) {
                // Invalid password
                $response = response()->json([
                    'status' => 'error',
                    'message' => 'Invalid password, please check your password again.'
                ]);
                return $response;
            } else {
                // Create token when login successfully.
                $token = $user->createToken('secret')->plainTextToken;
                $response = response()->json([
                    'status' => 'ok',
                    'message' => 'Login successfully.',
                    'user' => $user,
                    'token' => $token
                ]);
                return $response;
            }
        }
    }

    // Logout function
    public function logout()
    {
        // Reach Authentication and find tokens for delet it.
        auth()->user()->tokens()->delete();
        $response = response()->json([
            'status' => 'ok',
            'message' => 'Logout successfully.'
        ]);
        return $response;
    }
}
