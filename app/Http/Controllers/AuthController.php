<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
//    public function register(Request $request)
//    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:8|confirmed',
//        ]);
//
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
//
//        return response()->json(['message' => 'User registered successfully'], 201);
//    }
//
//    public function login(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|string|email',
//            'password' => 'required|string',
//        ]);
//
//        $credentials = $request->only('email', 'password');
//
//        if (Auth::attempt($credentials)) {
//            $user = Auth::user();
//            $token = $user->createToken($user)->accessToken;
//            return response()->json(['token' => $token], 200);
//        }
//
//        throw ValidationException::withMessages([
//            'email' => ['The provided credentials are incorrect.'],
//        ]);
//    }
//
//    public function logout(Request $request)
//    {
//        $request->user()->token()->revoke();
//        return response()->json(['message' => 'Successfully logged out'], 200);
//    }
//


    // Register a new SuperAdmin
    public function registerSuperAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

//        $user = User::create([
//            'name' => $request->input('name'),
//            'email' => $request->input('email'),
//            'password' => bcrypt($request->input('password')),
//            'role' => 'SuperAdmin', // Set the role as SuperAdmin
//        ]);
        $user = new User();
        $user->username = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 'Customer';
        $user->save();

        return response()->json($user, 201);
    }

    // User login
    public function login(Request $request)
    {
         $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;
            return response()->json(['token' => $token,'status'=>1,'message'=>'Successfully login'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized','status'=>0], 401);
        }
    }
}
