<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Kelurahan;
use Illuminate\Http\Request;

class RefController extends Controller
{
    //
    public $status = false;
    public $message = 'failed';
    public $data = [];
    public $code = 200;
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function kelurahan()
    {
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'puskesmas') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $kels = Kelurahan::where('kode_p', $kode)->get();

            $this->status = true;
            $this->message = 'ok';
            $this->data = $kels;
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ], $this->code);
    }
}
