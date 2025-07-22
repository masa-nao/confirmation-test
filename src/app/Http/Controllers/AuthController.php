<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $form = $request->only(['name', 'email']);
        $form['password'] = Hash::make($request->password);

        $user = User::create($form);

        Auth::login($user);

        return redirect()->route('admin.show');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $form = $request->only(['email', 'password']);

        if (Auth::attempt($form)) {
            $request->session()->regenerate();

            return redirect()->route('admin.show');
        }

        return back()->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.show');
    }
}
