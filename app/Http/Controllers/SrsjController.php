<?php

namespace App\Http\Controllers;

use App\Srsj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SrsjController extends Controller
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
            $srsj = Srsj::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $srsj = $srsj->where('bulan', $request->bulan);
            }
        } else {
            $srsj = Srsj::where('puskesmas', $user->kode)->where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $srsj = $srsj->where('bulan', $request->bulan);
            }
        }
        $srsj = $srsj->get();
        return view('srsj.rekap', ['srsj' => $srsj, 'request' => $request]);
    }

    public function create()
    {
        return view('srsj.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun'             => 'required',
            'bulan'             => 'required',
            'jml_target_lokasi' => 'required|min:0',
            'jml_total_bangunan' => 'required|min:0',
            'jml_jumantik' => 'required|min:0',
            'jml_koord' => 'required|min:0',
            'abj_jumantik'   => 'required',
            'abj_koord' => 'required',
            'abj_nakes' => 'required',
            'jml_dd'    => 'required|min:0',
            'jml_dbd'   => 'required|min:0',
            'jml_dss'   => 'required|min:0',
        ]);

        $user = Auth::user();
        $srsj = new Srsj();
        $srsj->puskesmas            = $user->kode;
        $srsj->tahun                = $request->tahun;
        $srsj->bulan                = $request->bulan;
        $srsj->jml_target_lokasi    = $request->jml_target_lokasi;
        $srsj->jml_total_bangunan   = $request->jml_total_bangunan;
        $srsj->jml_jumantik         = $request->jml_jumantik;
        $srsj->jml_koord            = $request->jml_koord;
        $srsj->abj_jumantik         = $request->abj_jumantik;
        $srsj->abj_koord            = $request->abj_koord;
        $srsj->abj_nakes            = $request->abj_nakes;
        $srsj->jml_dd               = $request->jml_dd;
        $srsj->jml_dbd              = $request->jml_dbd;
        $srsj->jml_dss              = $request->jml_dss;
        $srsj->save();

        return redirect()->route('srsj');
    }

    public function edit($id)
    {
        $srsj = Srsj::find($id);
        return view('srsj.form', ['srsj' => $srsj]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'tahun'             => 'required',
            'bulan'             => 'required',
            'jml_target_lokasi' => 'required|min:0',
            'jml_total_bangunan' => 'required|min:0',
            'jml_jumantik' => 'required|min:0',
            'jml_koord' => 'required|min:0',
            'abj_jumantik'   => 'required',
            'abj_koord' => 'required',
            'abj_nakes' => 'required',
            'jml_dd'    => 'required|min:0',
            'jml_dbd'   => 'required|min:0',
            'jml_dss'   => 'required|min:0',
        ]);

        $user = Auth::user();
        $srsj = Srsj::find($id);
        $srsj->puskesmas            = $user->kode;
        $srsj->tahun                = $request->tahun;
        $srsj->bulan                = $request->bulan;
        $srsj->jml_target_lokasi    = $request->jml_target_lokasi;
        $srsj->jml_total_bangunan   = $request->jml_total_bangunan;
        $srsj->jml_jumantik         = $request->jml_jumantik;
        $srsj->jml_koord            = $request->jml_koord;
        $srsj->abj_jumantik         = $request->abj_jumantik;
        $srsj->abj_koord            = $request->abj_koord;
        $srsj->abj_nakes            = $request->abj_nakes;
        $srsj->jml_dd               = $request->jml_dd;
        $srsj->jml_dbd              = $request->jml_dbd;
        $srsj->jml_dss              = $request->jml_dss;
        $srsj->save();

        return redirect()->route('srsj');
    }

    public function destroy($id)
    {
        $srsj = Srsj::find($id);
        $srsj->delete();

        return response()->json(["status" => true, "message" => "Data berhasil di hapus"]);
    }
}
