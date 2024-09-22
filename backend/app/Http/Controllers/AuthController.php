<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:4',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    // Login user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'credentials' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User logged in successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    // Logout user
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'User logged out successfully',
        ], 200);
    }

    // Get user profile
    public function userProfile(Request $request)
    {
        return response()->json([
            'message' => 'User profile retrieved successfully',
            'data' => $request->user(),
        ], 200);
    }

    public function changeProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $path = $user->photo;

        if ($request->hasFile('photo')) {
            $old = public_path('user/' . $path);
            File::delete($old);
            $img = $request->file('photo');
            $path = 'user' . time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('user'), $path);
        }

        $user->update([
            'photo' => $path,
            'name' => $request->name,
            'bio' => $request->bio,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'dob' => $request->dob
        ]);

        return response()->json($user);
    }
}