<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use App\Pjr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PjrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->kode == "dkk") {
            $desa = Kelurahan::get();
            $pjr = Pjr::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $pjr = $pjr->where('bulan', $request->bulan);
            }
            if ($request->minggu_ke != "") {
                $pjr = $pjr->where("minggu_ke", $request->minggu_ke);
            }
            if ($request->kdesa != "") {
                $pjr = $pjr->where("kdesa", $request->kdesa);
            }
        } else {
            $desa = Kelurahan::where("kode_p", $user->kode)->get();
            $pjr = Pjr::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $pjr = $pjr->where('bulan', $request->bulan);
            }
            if ($request->minggu_ke != "") {
                $pjr = $pjr->where("minggu_ke", $request->minggu_ke);
            }
            if ($request->kdesa != "") {
                $pjr = $pjr->where("kdesa", $request->kdesa);
            } else {
                $desaIn = Kelurahan::where("kode_p", $user->kode)->pluck('kode')->toArray();
                $pjr = $pjr->whereIn("kdesa", $desaIn);
            }
        }
        $pjr = $pjr->get();
        return view('pjr.rekap', ['pjr' => $pjr, 'desa' => $desa, 'request' => $request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        if ($user->kode == "dkk") {
            $desa = Kelurahan::get();
        } else {
            $desa = Kelurahan::where("kode_p", $user->kode)->get();
        }
        return view('pjr.form', ['desa' => $desa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'tahun'             => 'required',
            'bulan'             => 'required',
            'minggu_ke'         => 'required|min:0|max:5',
            'kdesa'             => 'required',
            'rt'                => 'required',
            'rw'                => 'required',
            'jml_rumah'         => 'required|min:0',
            'jml_positif'       => 'required|min:0',
            'jml_perangkap'     => 'required|min:0',
            'jml_tikus'         => 'required|min:0',
        ]);
        $user = Auth::user();
        $pjr = new Pjr();
        $pjr->tahun         = $request->tahun;
        $pjr->bulan         = $request->bulan;
        $pjr->minggu_ke     = $request->minggu_ke;
        $pjr->kdesa         = $request->kdesa;
        $pjr->rt            = $request->rt;
        $pjr->rw            = $request->rw;
        $pjr->jml_rumah     = $request->jml_rumah;
        $pjr->jml_positif   = $request->jml_positif;
        $pjr->jml_perangkap = $request->jml_perangkap;
        $pjr->jml_tikus     = $request->jml_tikus;
        $pjr->save();

        return redirect()->route('pjr');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pjr = Pjr::find($id);
        $user = Auth::user();
        if ($user->kode == "dkk") {
            $desa = Kelurahan::get();
        } else {
            $desa = Kelurahan::where("kode_p", $user->kode)->get();
        }

        return view('pjr.form', ['desa' => $desa, 'pjr' => $pjr]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'tahun'             => 'required',
            'bulan'             => 'required',
            'minggu_ke'         => 'required|min:0|max:5',
            'kdesa'             => 'required',
            'rt'                => 'required',
            'rw'                => 'required',
            'jml_rumah'         => 'required|min:0',
            'jml_positif'       => 'required|min:0',
            'jml_perangkap'     => 'required|min:0',
            'jml_tikus'         => 'required|min:0',
        ]);
        $user = Auth::user();
        $pjr = Pjr::find($id);
        $pjr->tahun         = $request->tahun;
        $pjr->bulan         = $request->bulan;
        $pjr->minggu_ke     = $request->minggu_ke;
        $pjr->kdesa         = $request->kdesa;
        $pjr->rt            = $request->rt;
        $pjr->rw            = $request->rw;
        $pjr->jml_rumah     = $request->jml_rumah;
        $pjr->jml_positif   = $request->jml_positif;
        $pjr->jml_perangkap = $request->jml_perangkap;
        $pjr->jml_tikus     = $request->jml_tikus;
        $pjr->save();

        return redirect()->route('pjr');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pjr = Pjr::find($id);
        $pjr->delete();

        return response()->json(["status" => true, "message" => "Data berhasil di hapus"]);
    }
}
