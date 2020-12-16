<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public $status = false;
    public $message = 'failed';
    public $data = [];
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $user = $request->input('username');
        $pass = $request->input('password');
        $au = User::where([['login', $user], ['pass', $pass]])->first();
        // dd($au);
        if ($au) {
            $token = auth('api')->login($au);
            $this->status = true;
            $this->message = 'ok';
            $this->data = ['lokasi' => $au->lokasi, 'kode' => $au->kpusk, 'nama' => $au->nama, 'level' => $au->level, 'access_token' => $token, 'token_type' => 'bearer', 'expires_in' => 3600];
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ]);
    }
    public function logout()
    {
        auth('api')->logout();
        return response()->json([
            'status'    => true,
            'message'   => 'Berhasil Logout',
            'data'      => $this->data,
        ]);
    }
    public function me()
    {
        return response()->json([
            'status'    => true,
            'message'   => 'ok',
            'data'      => auth('api')->user(),
        ]);
    }
}