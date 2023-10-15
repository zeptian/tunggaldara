<?php

namespace App\Http\Controllers;

use App\Kasus;
use App\Penduduk;
use Illuminate\Http\Request;

class RekapKasusController extends Controller
{
    //
    public function rekapKasus(Request $request)
    {
        $rekap = null;
        $penduduk = null;
        if ($request->kasus != '') {
            if ($request->kasus == 'DD') {
                $rekap = Kasus::rekapKasusDd($request->wilayah, $request->periode)->get();
            } else {
                $rekap = Kasus::rekapKasusDbd($request->wilayah, $request->periode)->get();
            }

            if ($request->wilayah == 'kec') {
                $pendudukRaw = Penduduk::rekapKec($request->periode)->get();
            } else if ($request->wilayah == 'kelurahan') {
                $pendudukRaw = Penduduk::rekapDesa($request->periode)->get();
            } else if ($request->wilayah == 'pus') {
                $pendudukRaw = Penduduk::rekapPusk($request->periode)->get();
            }
            // dd($pendudukRaw->toSql());

            foreach ($pendudukRaw as $value) {
                $penduduk[$value->nama] = $value->penduduk;
            }
        }
        // dd($rekap->toSql());

        return view('kasus.rekap_angka', ['rekap' => $rekap, 'penduduk' => $penduduk, 'request' => $request]);
    }

    public function rekapRs(Request $request)
    {
        $rekap = null;
        if ($request->periode != '') {
            if ($request->kasus == 'DD') {
                $rekap = Kasus::rekapKasusDd('rs', $request->periode)->get();
            } else {
                $rekap = Kasus::rekapKasusDbd('rs', $request->periode)->get();
            }
        }
        // dd($rekap->toSql());

        return view('kasus.rekap_rs', ['rekap' => $rekap, 'request' => $request]);
    }
}
