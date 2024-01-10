<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }

        return redirect("/")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard.dashboard');
        }

        return redirect("/")->withSuccess('Opps! You do not have access');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
