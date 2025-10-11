<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
       $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

       if (!Auth::attempt($attributes)) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'email'=>'Your provided credentials do not match.'
        ]);
       }

        request()->session()->regenerate();

        return redirect('/resources');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
