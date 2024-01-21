<?php

namespace App\Http\Controllers;

use App\Fogging;
use App\Kasus;
use App\Kelurahan;
use App\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoggingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->kode == "dkk") {
            $request->start = $request->start ?? date('01-m-Y');
            $request->end = $request->end ?? date('d-m-Y');
            $kasus = Fogging::where('tgl_instruksi', '>=', date("Y-m-d", strtotime($request->start)))
                ->where('tgl_instruksi', '<=',  date("Y-m-d", strtotime($request->end)))
                ->get();
        } else {
            $faskes = $user->kode;
            $request->start = $request->start ?? date('01-m-Y');
            $request->end = $request->end ?? date('d-m-Y');
            $kasus = Pasien::with('pasien')
                ->where('rs', $faskes)
                ->where('tgl_lp', '>=', date("Y-m-d", strtotime($request->start)))
                ->where('tgl_lp', '<=',  date("Y-m-d", strtotime($request->end)))
                ->get();
        }
        return view('kasus.rekap', ['kasus' => $kasus, 'request' => $request]);
    }
    public function create($idpe)
    {
        $pasien = Kasus::with("pasien")->where("idpe", $idpe)->first();
        $kelurahan = Kelurahan::get();
        return view("fogging.form", ['kelurahan' => $kelurahan, 'pasien' => $pasien]);
    }
    public function store(Request $request)
    {
    }
    public function show($idpe)
    {
    }
    public function edit(Request $request, $idpe)
    {
    }
    public function update(Request $request, $idpe)
    {
    }
    public function destroy($idpe)
    {
    }
}
