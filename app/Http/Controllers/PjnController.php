<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use App\Pjn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PjnController extends Controller
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
            $pjn = Pjn::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $pjn = $pjn->where('bulan', $request->bulan);
            }
            if ($request->minggu_ke != "") {
                $pjn = $pjn->where("minggu_ke", $request->minggu_ke);
            }
            if ($request->kdesa != "") {
                $pjn = $pjn->where("kdesa", $request->kdesa);
            }
        } else {
            $desa = Kelurahan::where("kode_p", $user->kode)->get();
            $pjn = Pjn::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $pjn = $pjn->where('bulan', $request->bulan);
            }
            if ($request->minggu_ke != "") {
                $pjn = $pjn->where("minggu_ke", $request->minggu_ke);
            }
            if ($request->kdesa != "") {
                $pjn = $pjn->where("kdesa", $request->kdesa);
            } else {
                $desaIn = Kelurahan::where("kode_p", $user->kode)->pluck('kode')->toArray();
                $pjn = $pjn->whereIn("kdesa", $desaIn);
            }
        }
        $pjn = $pjn->get();
        return view('pjn.rekap', ['pjn' => $pjn, 'desa' => $desa, 'request' => $request]);
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
        return view('pjn.form', ['desa' => $desa]);
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
        ]);
        $user = Auth::user();
        $pjn = new Pjn();
        $pjn->tahun         = $request->tahun;
        $pjn->bulan         = $request->bulan;
        $pjn->minggu_ke     = $request->minggu_ke;
        $pjn->kdesa         = $request->kdesa;
        $pjn->rt            = $request->rt;
        $pjn->rw            = $request->rw;
        $pjn->jml_rumah     = $request->jml_rumah;
        $pjn->jml_positif   = $request->jml_positif;
        $pjn->save();

        return redirect()->route('pjn');
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
        $pjn = Pjn::find($id);
        $user = Auth::user();
        if ($user->kode == "dkk") {
            $desa = Kelurahan::get();
        } else {
            $desa = Kelurahan::where("kode_p", $user->kode)->get();
        }

        return view('pjn.form', ['desa' => $desa, 'pjn' => $pjn]);
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
        ]);
        $user = Auth::user();
        $pjn = Pjn::find($id);
        $pjn->tahun         = $request->tahun;
        $pjn->bulan         = $request->bulan;
        $pjn->minggu_ke     = $request->minggu_ke;
        $pjn->kdesa         = $request->kdesa;
        $pjn->rt            = $request->rt;
        $pjn->rw            = $request->rw;
        $pjn->jml_rumah     = $request->jml_rumah;
        $pjn->jml_positif   = $request->jml_positif;
        $pjn->save();

        return redirect()->route('pjn');
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
        $pjn = Pjn::find($id);
        $pjn->delete();

        return response()->json(["status" => true, "message" => "Data berhasil di hapus"]);
    }
}
