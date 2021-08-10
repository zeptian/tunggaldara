<?php

namespace App\Http\Controllers;

use App\Kasus;
use App\Pasien;
use Illuminate\Http\Request;

class KasusController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index(Request $request)
    {
        $faskes = "RSUD K.R.M.T Wongsonegoro";
        $start = $request->start ?? date('Y-m-01');
        $end = $request->end ?? date('Y-m-d');
        $kasus = Kasus::with('pasien')
            ->where('rs', $faskes)
            ->where('tgl_lp', '>=', $start)
            ->where('tgl_lp', '<=', $end)
            ->get();
        return view('kasus.rekap', ['kasus' => $kasus]);
    }
    public function create()
    {
        return view('kasus.form');
    }
}