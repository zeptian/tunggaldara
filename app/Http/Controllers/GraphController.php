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
        $data = [["name" => "DBD", "data" => $dbd], ["name" => "DD", "data" => $dd]];
        return response()->json(["status" => true, "data" => $data]);
    }
}
