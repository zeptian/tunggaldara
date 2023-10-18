<?php

namespace App\Http\Controllers;

use App\Kasus;
use App\KasusRinci;
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

    public function kecepatanLapor(Request $request)
    {
        $rekap = null;
        if ($request->start != '' && $request->end != '') {
            $start = date('Y-m-d', strtotime($request->start));
            $end = date('Y-m-d', strtotime($request->end));
            $rekap = KasusRinci::selectRaw("rs, count(rs) as jml, SUM(DATEDIFF(tgl_lp,tegak)) as selisih,
            SUM(IF(DATEDIFF(tgl_lp,tegak) <=1,1,0))  as hr1,
            SUM(IF(DATEDIFF(tgl_lp,tegak) <=2 AND DATEDIFF(tgl_lp,tegak)  > 1,1,0))  as hr2,
            SUM(IF(DATEDIFF(tgl_lp,tegak) <=7 AND DATEDIFF(tgl_lp,tegak)  > 2,1,0))  as hr3,
            SUM(IF(DATEDIFF(tgl_lp,tegak) <=14 AND DATEDIFF(tgl_lp,tegak) > 7,1,0))  as hr8,
            SUM(IF(DATEDIFF(tgl_lp,tegak)  >= 15,1,0))  as hr15")
                ->where("tgl_lp", ">=", $start)->where("tgl_lp", "<=", $end)
                ->groupBy('rs')->orderBy('rs')->get();
        }
        // dd($rekap->toSql());

        return view('kasus.rekap_kecepatan', ['rekap' => $rekap, 'request' => $request]);
    }
}
