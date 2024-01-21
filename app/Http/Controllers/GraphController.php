<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    //
    public function kasusBulanan(Request $request)
    {
        $tahun = $request->tahun == '' ? date('Y') : $request->tahun;
        $dataRaw = DB::table("kasus")->selectRaw("diag_akhir, month(tegak) as bulan, count(*) as jml")
            ->whereYear('tegak', $tahun)->where(function ($query) {
                $query->where('diag_akhir', 'DBD')
                    ->orWhere('diag_akhir', 'DD');
            })->groupBy('diag_akhir', 'bulan')->get();
        $dbd = [];
        $dd = [];
        foreach ($dataRaw as $key => $value) {
            if (trim($value->diag_akhir) == "DBD") {
                $dbd[] = $value->jml;
            }
            if (trim($value->diag_akhir) == "DD") {
                $dd[] = $value->jml;
            }
        }
        $data = [["name" => "DD", "data" => $dd], ["name" => "DBD", "data" => $dbd]];
        return response()->json(["status" => true, "data" => $data]);
    }

    public function kasusBulananPM(Request $request)
    {
        $tahun = $request->tahun == '' ? date('Y') : $request->tahun;
        $dataRaw = DB::table("kasus")->selectRaw("status, month(tegak) as bulan, count(*) as jml")
            ->whereYear('tegak', $tahun)->groupBy('status', 'bulan')->get();
        $p = [];
        $m = [];
        $i = 1;
        foreach ($dataRaw as $key => $value) {
            if (trim($value->status) == "P") {
                $dbd[] = $value->jml;
            }
            if (trim($value->status) == "M") {
                $dd[] = $value->jml;
            }
        }
        $data = [["name" => "Penderita", "data" => $p], ["name" => "Meninggal", "data" => $m]];
        return response()->json(["status" => true, "data" => $data]);
    }
}
