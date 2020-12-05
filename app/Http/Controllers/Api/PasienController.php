<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $user = auth('api')->user();
        if ($user->level == 'puskesmas') {
            $kode = $user->kpusk;
            $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
            foreach ($kels as $k => $v) {
                $kels[] = $v->kode;
            }
        }
        $pasien = Pasien::join('kasus', 'kasus.idp=pasien.id')->where('kasus.tgl_lp', '2020-12-04')->whereIn('kdesa', $kels)->get();
        dd($pasien);
    }
}