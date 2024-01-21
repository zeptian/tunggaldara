<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use App\Pjb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PjbController extends Controller
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
            $pjb = Pjb::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $pjb = $pjb->where('bulan', $request->bulan);
            }
            if ($request->kdesa != "") {
                $pjb = $pjb->where("kdesa", $request->kdesa);
            }
        } else {
            $desa = Kelurahan::where("kode_p", $user->kode)->get();
            $pjb = Pjb::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $pjb = $pjb->where('bulan', $request->bulan);
            }
            if ($request->kdesa != "") {
                $pjb = $pjb->where("kdesa", $request->kdesa);
            } else {
                $desaIn = Kelurahan::where("kode_p", $user->kode)->pluck('kode')->toArray();
                $pjb = $pjb->whereIn("kdesa", $desaIn);
                // dd($pjb->toSql());
            }
        }
        $pjb = $pjb->get();
        return view('pjb.rekap', ['pjb' => $pjb, 'desa' => $desa, 'request' => $request]);
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
        return view('pjb.form', ['desa' => $desa]);
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
            'kdesa'             => 'required',
            'jml_rumah'         => 'required|min:0',
            'jml_positif'       => 'required|min:0',
        ]);
        $user = Auth::user();
        $pjb = new Pjb();
        $pjb->tahun         = $request->tahun;
        $pjb->bulan         = $request->bulan;
        $pjb->kdesa         = $request->kdesa;
        $pjb->jml_rumah     = $request->jml_rumah;
        $pjb->jml_positif   = $request->jml_positif;
        $pjb->save();

        return redirect()->route('pjb');
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
        $pjb = Pjb::find($id);
        $user = Auth::user();
        if ($user->kode == "dkk") {
            $desa = Kelurahan::get();
        } else {
            $desa = Kelurahan::where("kode_p", $user->kode)->get();
        }

        return view('pjb.form', ['desa' => $desa, 'pjb' => $pjb]);
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
            'kdesa'             => 'required',
            'jml_rumah'         => 'required|min:0',
            'jml_positif'       => 'required|min:0',
        ]);
        $user = Auth::user();
        $pjb = Pjb::find($id);
        $pjb->tahun         = $request->tahun;
        $pjb->bulan         = $request->bulan;
        $pjb->kdesa         = $request->kdesa;
        $pjb->jml_rumah     = $request->jml_rumah;
        $pjb->jml_positif   = $request->jml_positif;
        $pjb->save();

        return redirect()->route('pjb');
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
        $pjb = Pjb::find($id);
        $pjb->delete();

        return response()->json(["status" => true, "message" => "Data berhasil di hapus"]);
    }
}
