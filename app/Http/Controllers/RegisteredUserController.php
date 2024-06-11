<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
  
    public function create()
    {
        return view('auth.register');
    }
    
    public function store(UserRequest $request)
    {
        $user = User::create($request->all());

        Auth::login($user);

        return redirect('/home');
       
    }
}
