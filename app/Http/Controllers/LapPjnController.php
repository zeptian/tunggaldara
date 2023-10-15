<?php

namespace App\Http\Controllers;

use App\LapPjn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LapPjnController extends Controller
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
            $lapPjn = LapPjn::where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $lapPjn = $lapPjn->where('bulan', $request->bulan);
            }
        } else {
            $lapPjn = LapPjn::where('user', $user)->where('tahun', $request->tahun);
            if ($request->bulan != "all") {
                $lapPjn = $lapPjn->where('bulan', $request->bulan);
            }
        }
        $lapPjn = $lapPjn->get();
        return view('lapPjn.rekap', ['lapPjn' => $lapPjn, 'request' => $request]);
    }

    public function create()
    {
        return view('lapPjn.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_kegiatan'  => 'required',
            'kelurahan'     => 'required',
            'rw'            => 'required',
            'bangunan_pantau'   => 'required|min:0',
            'bangunan_positif'  => 'required|min:0',
            'kontainer_dalam_periksa'   => 'required|min:0',
            'kontainer_dalam_positif'   => 'required|min:0',
            'kontainer_luar_periksa'   => 'required|min:0',
            'kontainer_luar_positif'   => 'required|min:0',
            'perangkap_tikus'   => 'required|min:0',
            'tikus_tertangkap'   => 'required|min:0',
            'larvasida'         => 'required',
            'apel'              => 'required',
            'pimpinan_pjn'      => 'required',
            'jabatan'           => 'required',
            'evaluasi'          => 'required',
            'sirine'            => 'required',
        ]);

        $user = Auth::user();
        $lapPjn = new lapPjn();
        $lapPjn->tgl_lapor              = date('Y-m-d');
        $lapPjn->puskesmas              = $user->kode;
        $lapPjn->tgl_kegiatan           = $request->tgl_kegiatan;
        $lapPjn->kelurahan              = $request->kelurahan;
        $lapPjn->rw                     = $request->rw;
        $lapPjn->bangunan_pantau        = $request->bangunan_pantau;
        $lapPjn->bangunan_positif       = $request->bangunan_positif;
        $lapPjn->kontainer_dalam_periksa = $request->kontainer_dalam_periksa;
        $lapPjn->kontainer_dalam_positif = $request->kontainer_dalam_positif;
        $lapPjn->kontainer_luar_periksa = $request->kontainer_luar_periksa;
        $lapPjn->kontainer_luar_positif = $request->kontainer_luar_positif;
        $lapPjn->perangkap_tikus        = $request->perangkap_tikus;
        $lapPjn->tikus_tertangkap       = $request->tikus_tertangkap;
        $lapPjn->larvasida      = $request->larvasida;
        $lapPjn->apel           = $request->apel;
        $lapPjn->pimpinan_pjn   = $request->pimpinan_pjn;
        $lapPjn->jabatan        = $request->jabatan;
        $lapPjn->evaluasi       = $request->evaluasi;
        $lapPjn->sirine         = $request->sirine;
        $lapPjn->save();

        return redirect()->route('monev_pjn');
    }

    public function edit($id)
    {
        $lapPjn = lapPjn::find($id);
        return view('lapPjn.form', ['lapPjn' => $lapPjn]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'tgl_kegiatan'  => 'required',
            'kelurahan'     => 'required',
            'rw'            => 'required',
            'bangunan_pantau'   => 'required|min:0',
            'bangunan_positif'  => 'required|min:0',
            'kontainer_dalam_periksa'   => 'required|min:0',
            'kontainer_dalam_positif'   => 'required|min:0',
            'kontainer_luar_periksa'   => 'required|min:0',
            'kontainer_luar_positif'   => 'required|min:0',
            'perangkap_tikus'   => 'required|min:0',
            'tikus_tertangkap'   => 'required|min:0',
            'larvasida'         => 'required',
            'apel'              => 'required',
            'pimpinan_pjn'      => 'required',
            'jabatan'           => 'required',
            'evaluasi'          => 'required',
            'sirine'            => 'required',
        ]);

        $user = Auth::user();
        $lapPjn = lapPjn::find($id);
        $lapPjn->tgl_lapor              = date('Y-m-d');
        $lapPjn->puskesmas              = $user->kode;
        $lapPjn->tgl_kegiatan           = $request->tgl_kegiatan;
        $lapPjn->kelurahan              = $request->kelurahan;
        $lapPjn->rw                     = $request->rw;
        $lapPjn->bangunan_pantau        = $request->bangunan_pantau;
        $lapPjn->bangunan_positif       = $request->bangunan_positif;
        $lapPjn->kontainer_dalam_periksa = $request->kontainer_dalam_periksa;
        $lapPjn->kontainer_dalam_positif = $request->kontainer_dalam_positif;
        $lapPjn->kontainer_luar_periksa = $request->kontainer_luar_periksa;
        $lapPjn->kontainer_luar_positif = $request->kontainer_luar_positif;
        $lapPjn->perangkap_tikus        = $request->perangkap_tikus;
        $lapPjn->tikus_tertangkap       = $request->tikus_tertangkap;
        $lapPjn->larvasida      = $request->larvasida;
        $lapPjn->apel           = $request->apel;
        $lapPjn->pimpinan_pjn   = $request->pimpinan_pjn;
        $lapPjn->jabatan        = $request->jabatan;
        $lapPjn->evaluasi       = $request->evaluasi;
        $lapPjn->sirine         = $request->sirine;
        $lapPjn->save();

        return redirect()->route('monev_pjn');
    }

    public function destroy($id)
    {
        $lapPjn = lapPjn::find($id);
        $lapPjn->delete();

        return response()->json(["status" => true, "message" => "Data berhasil di hapus"]);
    }
}
