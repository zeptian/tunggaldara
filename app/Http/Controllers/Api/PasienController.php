<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    //
    public $status = false;
    public $message = 'failed';
    public $data = [];
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $user = auth('api')->user();
        if ($user->level == 'puskesmas') {
            $kode = $user->kpusk;
            $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
            foreach ($kels as $k => $v) {
                $kels[] = $v->kode;
            }
        }
        $pasien = Pasien::join('kasus', 'kasus.idp', '=', 'pasien.id')->whereBetween('tgl_lp', [$start, $end])->whereIn('kdesa', $kels)->get();
        if ($pasien) {
            $this->status = true;
            $this->message = 'ok';
            return response()->json([
                'status'    => $this->status,
                'message'   => $this->message,
                'data'      => $pasien,
            ]);
        }
    }

    public function belumPe(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        $user = auth('api')->user();
        if ($user->level == 'puskesmas') {
            $kode = $user->kpusk;
            $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
            foreach ($kels as $k => $v) {
                $kels[] = $v->kode;
            }
        }
        $pasien = Pasien::join('kasus', 'kasus.idp', '=', 'pasien.id')->join('pe', 'pe.idk', '=', 'kasus.idk', 'left outer')->whereBetween('tgl_lp', [$start, $end])->whereIn('kdesa', $kels)->get();
        if ($pasien) {
            $this->status = true;
            $this->message = 'ok';
            return response()->json([
                'status'    => $this->status,
                'message'   => $this->message,
                'data'      => $pasien,
            ]);
        }
    }
}