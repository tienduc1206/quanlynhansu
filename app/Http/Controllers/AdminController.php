<?php

namespace App\Http\Controllers;


use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;




class AdminController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function checkLogin(Request $request)

    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email không được để trống',
            'password.required' => 'Password không được để trống'
        ]);
        $remember_me = $request->has('remember_me') ? true : false;
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (auth()->attempt($arr, $remember_me)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }
        return redirect()->route('login')->with('error', 'Tài khoản hoặc mật khẩu không chính xác!');
    }

    public function register(Request $request)
    {
        return view('register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //login user here


        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home');
        }
        return redirect('register')->withError('Error');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
