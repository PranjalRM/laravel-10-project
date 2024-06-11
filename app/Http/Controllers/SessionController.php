<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Job;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
class SessionController extends Controller
{

    public function createRegistration()
    {
        return view('auth.register');
    }
    
    public function storeRegistration(UserRequest $request)
    {
        $user = User::create($request->all());
        
        Auth::login($user);

        return redirect('/home');
       
    }
    public function create()
    {
        return view('auth.login');
    }
    
    public function store(UserRequest $request)
    {
        $attributees = request()->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($attributees)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry those credentials do not match'
            ]);
        }

        request()->session()->regenerate();
        session()->put([
            'user_id'   => Auth::id(),
        ]);
        return redirect('/home');
    }
 
    public function destroy()
    {
        Auth::logout();
        session()->forget(['user_id']);

        return redirect('/home');
    }

    public function owner()
    {
        return view('auth.login');

        return view('myjobs');
    }

    public function ResetForm(Request $request,$token)
    {
        return view('auth.reset', ['token' =>$token, 'email' =>$request->input('email')]);

    }
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);
        $user = User::whereEmail($request->input('email'))->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        $password = $request->input('password');

        if (!Hash::check($password, $user->password)) {
            $user->password = Hash::make($password);
            $user->save();
        }

        return redirect()->route('login')->with('success', 'Password reset successfully');
    }
}

