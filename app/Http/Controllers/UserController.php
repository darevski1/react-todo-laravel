<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        # validate input
        $validated = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);
        # Save 
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);

        $token = $user->createToken('todoapp')->plainTextToken;

        $response = [
            'name' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function login(Request $request){

        $fields = $request->validate([
           'email' => 'required|string',
           'password' => 'required|string'
        ]);
        
        // Check email 
        $user =  User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return \response([
                'message' => 'Bad Credentials'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'name' => $user,
            'token' => $token
        ];

        return response ($response, 201);
    }
}
