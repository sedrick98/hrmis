<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function handleLogin() {
        $user_login = ['username'=>request()->username,
                        'password'=>request()->password
                      ];
        //dd(Hash::make(request()->password));
        // $user = New User;
        // dd($user->getAuthPassword());
        //dd(Auth::attempt($user_login));
        if(Auth::attempt($user_login)) {
            return redirect()->route('dashboard');
            //dd(1);
            //return redirect('login')->with('err_msg', 'Test Password!');
        }
        return redirect('login')->with('err_msg', 'Invalid username/password');
    }

    public function logout() {
        Session::flush();
        Auth::logout(); 
        return redirect('login');
     }
}
