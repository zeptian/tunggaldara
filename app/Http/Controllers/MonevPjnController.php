<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use App\MonevPjn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonevPjnController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $monevPjn = MonevPjn::whereYear('tgl_kegiatan', $request->tahun);
        if ($request->bulan != "all") {
            $monevPjn = $monevPjn->whereMonth('tgl_kegiatan', $request->bulan);
        }
        if ($user->kode != "dkk") {
            $monevPjn = $monevPjn->where('user', $user);
        }
        $monevPjn = $monevPjn->get();
        return view('monevPjn.rekap', ['monevPjn' => $monevPjn, 'request' => $request]);
    }

    public function create()
    {
        $user = Auth::user();
        $kelurahan = Kelurahan::get();
        if ($user->kode != "dkk") {
            $kelurahan = Kelurahan::where('kode_p', $user->kode)->get();
        }
        return view('monevPjn.form', ['kelurahan' => $kelurahan]);
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
        $monevPjn = new monevPjn();
        $monevPjn->tgl_lapor              = date('Y-m-d');
        $monevPjn->puskesmas              = $user->kode;
        $monevPjn->tgl_kegiatan           = $request->tgl_kegiatan;
        $monevPjn->kelurahan              = $request->kelurahan;
        $monevPjn->rw                     = $request->rw;
        $monevPjn->bangunan_pantau        = $request->bangunan_pantau;
        $monevPjn->bangunan_positif       = $request->bangunan_positif;
        $monevPjn->kontainer_dalam_periksa = $request->kontainer_dalam_periksa;
        $monevPjn->kontainer_dalam_positif = $request->kontainer_dalam_positif;
        $monevPjn->kontainer_luar_periksa = $request->kontainer_luar_periksa;
        $monevPjn->kontainer_luar_positif = $request->kontainer_luar_positif;
        $monevPjn->perangkap_tikus        = $request->perangkap_tikus;
        $monevPjn->tikus_tertangkap       = $request->tikus_tertangkap;
        $monevPjn->larvasida      = $request->larvasida;
        $monevPjn->apel           = $request->apel;
        $monevPjn->pimpinan_pjn   = $request->pimpinan_pjn;
        $monevPjn->jabatan        = $request->jabatan;
        $monevPjn->evaluasi       = $request->evaluasi;
        $monevPjn->sirine         = $request->sirine;
        $monevPjn->save();

        return redirect()->route('monev_pjn');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $kelurahan = Kelurahan::get();
        if ($user->kode != "dkk") {
            $kelurahan = Kelurahan::where('kode_p', $user->kode)->get();
        }
        $monevPjn = monevPjn::find($id);
        return view('monevPjn.form', ['monevPjn' => $monevPjn, 'kelurahan' => $kelurahan]);
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
        $monevPjn = monevPjn::find($id);
        $monevPjn->tgl_lapor              = date('Y-m-d');
        $monevPjn->puskesmas              = $user->kode;
        $monevPjn->tgl_kegiatan           = $request->tgl_kegiatan;
        $monevPjn->kelurahan              = $request->kelurahan;
        $monevPjn->rw                     = $request->rw;
        $monevPjn->bangunan_pantau        = $request->bangunan_pantau;
        $monevPjn->bangunan_positif       = $request->bangunan_positif;
        $monevPjn->kontainer_dalam_periksa = $request->kontainer_dalam_periksa;
        $monevPjn->kontainer_dalam_positif = $request->kontainer_dalam_positif;
        $monevPjn->kontainer_luar_periksa = $request->kontainer_luar_periksa;
        $monevPjn->kontainer_luar_positif = $request->kontainer_luar_positif;
        $monevPjn->perangkap_tikus        = $request->perangkap_tikus;
        $monevPjn->tikus_tertangkap       = $request->tikus_tertangkap;
        $monevPjn->larvasida      = $request->larvasida;
        $monevPjn->apel           = $request->apel;
        $monevPjn->pimpinan_pjn   = $request->pimpinan_pjn;
        $monevPjn->jabatan        = $request->jabatan;
        $monevPjn->evaluasi       = $request->evaluasi;
        $monevPjn->sirine         = $request->sirine;
        $monevPjn->save();

        return redirect()->route('monev_pjn');
    }

    public function destroy($id)
    {
        $monevPjn = monevPjn::find($id);
        $monevPjn->delete();

        return response()->json(["status" => true, "message" => "Data berhasil di hapus"]);
    }
}
