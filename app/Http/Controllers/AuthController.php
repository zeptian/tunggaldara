<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login()
    {
        return view('login');
    }
    public function doLogin(Request $request)
    {
        $user = $request->input('username');
        $pass = $request->input('password');
        $au = User::where([['login', $user], ['pass', $pass]])->first();
        // dd($au);
        if ($au) {
            Auth::login($au);
            return redirect(route('menu'))->with('message', 'login berhasil');
        }
        return redirect(route('login'));
    }

    function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
