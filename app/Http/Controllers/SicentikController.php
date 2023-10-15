<?php

namespace App\Http\Controllers;

use App\Sicentik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SicentikController extends Controller
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
            $sicentik = Sicentik::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $sicentik = $sicentik->where('bulan', $request->bulan);
            }
        } else {
            $sicentik = Sicentik::where('puskesmas', $user->kode)->where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $sicentik = $sicentik->where('bulan', $request->bulan);
            }
        }
        $sicentik = $sicentik->get();
        return view('sicentik.rekap', ['sicentik' => $sicentik, 'request' => $request]);
    }

    public function create()
    {
        return view('sicentik.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun'             => 'required',
            'bulan'             => 'required',
            'sasaran_sekolah'   => 'required|min:0',
            'real_sekolah'      => 'required|min:0',
            'sekolah_pantau'    => 'required|min:0',
            'sekolah_positif'   => 'required|min:0',
            'sekolah_monev'     => 'required|min:0',
        ]);

        $user = Auth::user();
        $sicentik = new Sicentik();
        $sicentik->tahun = $request->tahun;
        $sicentik->bulan = $request->bulan;
        $sicentik->puskesmas = $user->kode;
        $sicentik->sasaranSekolah = $request->sasaran_sekolah;
        $sicentik->realSekolah = $request->real_sekolah;
        $sicentik->sekolahPantau = $request->sekolah_pantau;
        $sicentik->sekolahPositif = $request->sekolah_positif;
        $sicentik->sekolahMonev = $request->sekolah_monev;
        $sicentik->save();

        return redirect()->route('sicentik');
    }

    public function edit($id)
    {
        $sicentik = Sicentik::find($id);
        return view('sicentik.form', ['sicentik' => $sicentik]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'tahun'             => 'required',
            'bulan'             => 'required',
            'sasaran_sekolah'   => 'required|min:0',
            'real_sekolah'      => 'required|min:0',
            'sekolah_pantau'    => 'required|min:0',
            'sekolah_positif'   => 'required|min:0',
            'sekolah_monev'     => 'required|min:0',
        ]);

        $user = Auth::user();
        $sicentik = Sicentik::find($id);
        $sicentik->tahun = $request->tahun;
        $sicentik->bulan = $request->bulan;
        $sicentik->puskesmas = $user->kode;
        $sicentik->sasaranSekolah = $request->sasaran_sekolah;
        $sicentik->realSekolah = $request->real_sekolah;
        $sicentik->sekolahPantau = $request->sekolah_pantau;
        $sicentik->sekolahPositif = $request->sekolah_positif;
        $sicentik->sekolahMonev = $request->sekolah_monev;
        $sicentik->save();

        return redirect()->route('sicentik');
    }

    public function destroy($id)
    {
        $sicentik = Sicentik::find($id);
        $sicentik->delete();

        return response()->json(["status" => true, "message" => "Data berhasil di hapus"]);
    }
}
