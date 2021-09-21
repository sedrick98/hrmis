<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        // GET
        if ($request->isMethod('get')) {
            return view('auth.login');
        }

        // POST
        if ($request->isMethod('post')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('admin-dashboard');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function register(Request $request)
    {
        // GET
        if ($request->isMethod('get')) {
            return view('auth.register');
        }

        // POST
        if ($request->isMethod('post')) {
            $form_data = $request->all();
            $user = User::create([
                'username' => $form_data['username'],
                'first_name' => $form_data['first_name'],
                'middle_name' => $form_data['middle_name'],
                'last_name' => $form_data['last_name'],
                'email' => $form_data['email'],
                'password' => Hash::make($form_data['password']),
            ]);

            return redirect()->route('login', []);
        }
    }
}
