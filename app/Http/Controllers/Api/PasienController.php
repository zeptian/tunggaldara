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
            $pasien = Pasien::join('kasus', 'kasus.idp', '=', 'pasien.id')
                ->whereBetween('tgl_lp', [$start, $end])
                ->whereIn('kdesa', $kels)
                ->orderBy('tgl_lp', 'asc')
                ->get();

            $this->status = true;
            $this->message = 'ok';
            $this->data = $pasien;
        } else {
            $this->message = 'Anauthorized';
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ]);
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

            $pasien = Pasien::select('kasus.idk', 'nama', 'ortu', 'alamat', 'rtrw', 'kdesa', 'alamat_ktp', 'jkl', 'tgl_lahir', 'no_kontak', 'tgl_lp', 'rs', 'status', 'tgl_pe', 'diag_akhir as jenis', 'kasus.tgl_verifikasi')
                ->join('kasus', 'kasus.idp', '=', 'pasien.id')
                ->join('pe', 'pe.idk', '=', 'kasus.idk', 'left outer')
                ->where('tgl_pe', null)
                ->whereBetween('tgl_lp', [$start, $end])
                ->whereIn('kdesa', $kels)
                ->orderBy('tgl_lp', 'asc')
                ->get();

            $this->status = true;
            $this->message = 'ok';
            $this->data = $pasien;
        } else {
            $this->message = 'Anauthorized';
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ]);
    }
    public function sudahPe(Request $request)
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

            $pasien = Pasien::select('kasus.idk', 'nama', 'ortu', 'alamat', 'rtrw', 'kdesa', 'alamat_ktp', 'jkl', 'tgl_lahir', 'no_kontak', 'tgl_lp', 'rs', 'status', 'tgl_pe', 'diag_akhir as jenis', 'kasus.tgl_verifikasi')
                ->join('kasus', 'kasus.idp', '=', 'pasien.id')
                ->join('pe', 'pe.idk', '=', 'kasus.idk', 'left outer')
                ->where('tgl_pe', '!=', null)
                ->whereBetween('tgl_lp', [$start, $end])
                ->whereIn('kdesa', $kels)
                ->orderBy('tgl_lp', 'asc')
                ->get();

            $this->status = true;
            $this->message = 'ok';
            $this->data = $pasien;
        } else {
            $this->message = 'Anauthorized';
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ]);
    }
}