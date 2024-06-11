<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class RegsiterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    
    public function store(UserRequest $request)
    {
        
        $user = User::create($request->all());

        Auth::login($user);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201); // 201 Created

       
    }
}
