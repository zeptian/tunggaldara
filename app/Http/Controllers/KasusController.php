<?php

namespace App\Http\Controllers;

use App\Kasus;
use App\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasusController extends Controller
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
            $request->start = $request->start ?? date('01-m-Y');
            $request->end = $request->end ?? date('d-m-Y');
            $kasus = Kasus::with('Pasien')
                ->where('tgl_lp', '>=', date("Y-m-d", strtotime($request->start)))
                ->where('tgl_lp', '<=',  date("Y-m-d", strtotime($request->end)))
                ->get();
        } else {
            $faskes = $user->kode;
            $request->start = $request->start ?? date('01-m-Y');
            $request->end = $request->end ?? date('d-m-Y');
            $kasus = Kasus::with('pasien')
                ->where('rs', $faskes)
                ->where('tgl_lp', '>=', date("Y-m-d", strtotime($request->start)))
                ->where('tgl_lp', '<=',  date("Y-m-d", strtotime($request->end)))
                ->get();
        }
        return view('kasus.rekap', ['kasus' => $kasus, 'request' => $request]);
    }

    public function create()
    {
        return view('kasus.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_rm' => 'required',
            'nama' => 'required',
            'ortu' => 'required',
            'alamat' => 'required',
            'rtrw' => 'required',
            'kdesa' => 'required',
            'tegak' => 'required',
            'jenis' => 'required',
            'kasus' => 'required',
        ]);

        $pasien = new Pasien();
        $pasien->no_rm = $request->no_rm;
        $pasien->nama = $request->nama;
        $pasien->ortu = $request->ortu;
        $pasien->kdesa = $request->kdesa;
        $pasien->rtrw = $request->rtrw;
        $pasien->alamat = $request->alamat;
        $pasien->alamat_ktp = $request->alamat_ktp;
        $pasien->jkl = $request->jkl;
        $pasien->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        $pasien->nama_kontak = $request->nama_kontak;
        $pasien->relasi = $request->relasi;
        $pasien->no_kontak = $request->no_kontak;
        $pasien->save();

        $kasus = new Kasus();
        $kasus->no_rm = $request->no_rm;
        $kasus->idp = $pasien->id;
        $kasus->jenis = $request->jenis;
        $kasus->icdx = ""; // need to set default value
        $kasus->lab = ""; // need to set default value
        $kasus->diag_akhir = ""; // need to set default value
        $kasus->tegak =  date('Y-m-d', strtotime($request->tegak));
        $kasus->tgl_lp = date('Y-m-d');
        $kasus->tgl_ct = date('Y-m-d');
        $kasus->tgl_sk = date('Y-m-d', strtotime($request->tgl_sk));
        $kasus->tgl_rs = date('Y-m-d', strtotime($request->tgl_rs));
        $kasus->rs = $request->rs;
        $kasus->status = substr($request->kasus, 0, 1);
        $kasus->sumber = $request->sumber;
        $kasus->panas = $request->panas;
        $kasus->uji_rl = $request->uji_rl;
        $kasus->gejala = implode(",", $request->gejala);
        $kasus->trombosit = $request->trombosit;
        $kasus->ht_awal = $request->ht_awal;
        $kasus->ht_tegak = $request->ht_tegak;
        $kasus->hb_tegak = $request->hb_tegak;
        $kasus->igg = $request->igg;
        $kasus->igm = $request->igm;
        $kasus->ns1 = $request->ns1;
        $kasus->pemeriksa = $request->pemeriksa;
        $kasus->save();
        $kasus->idk = $kasus->id . "." . date("md", strtotime($kasus->tegak));
        $kasus->save();

        return redirect()->route('kasus');
    }

    public function show($idp)
    {
        $pasien = Pasien::find($idp);
        $kasus = Kasus::where('idp', (int)$idp)->first();
        return view('kasus.detail', ['pasien' => $pasien, 'kasus' => $kasus]);
    }

    public function edit($idp)
    {

        $pasien = Pasien::find($idp);
        $kasus = Kasus::where('idp', (int)$idp)->first();
        return view('kasus.form', ['pasien' => $pasien, 'kasus' => $kasus]);
    }

    public function update($idp, Request $request)
    {
        $request->validate([
            'no_rm' => 'required',
            'nama' => 'required',
            'ortu' => 'required',
            'alamat' => 'required',
            'rtrw' => 'required',
            'kdesa' => 'required',
            'tegak' => 'required',
            'jenis' => 'required',
            'kasus' => 'required',
        ]);

        $pasien = Pasien::find($idp);
        $pasien->no_rm = $request->no_rm;
        $pasien->nama = $request->nama;
        $pasien->ortu = $request->ortu;
        $pasien->kdesa = $request->kdesa;
        $pasien->rtrw = $request->rtrw;
        $pasien->alamat = $request->alamat;
        $pasien->alamat_ktp = $request->alamat_ktp;
        $pasien->jkl = $request->jkl;
        $pasien->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        $pasien->nama_kontak = $request->nama_kontak;
        $pasien->relasi = $request->relasi;
        $pasien->no_kontak = $request->no_kontak;
        $pasien->latlong = "";
        $pasien->save();

        $kasus = Kasus::where('idp', (int)$idp)->first();
        $kasus->no_rm = $request->no_rm;
        $kasus->jenis = $request->jenis;
        $kasus->tegak = $request->tegak;
        $kasus->tgl_lp = date('Y-m-d');
        $kasus->tgl_ct = date('Y-m-d');
        $kasus->tgl_sk = date('Y-m-d', strtotime($request->tgl_sk));
        $kasus->tgl_rs = date('Y-m-d', strtotime($request->tgl_rs));
        $kasus->rs = $request->rs;
        $kasus->status = substr($request->kasus, 0, 1);
        $kasus->sumber = $request->sumber;
        $kasus->panas = $request->panas;
        $kasus->uji_rl = $request->uji_rl;
        $kasus->gejala = implode(",", $request->gejala);
        $kasus->trombosit = $request->trombosit;
        $kasus->ht_awal = $request->ht_awal;
        $kasus->ht_tegak = $request->ht_tegak;
        $kasus->hb_tegak = $request->hb_tegak;
        $kasus->igg = $request->igg;
        $kasus->igm = $request->igm;
        $kasus->ns1 = $request->ns1;
        $kasus->pemeriksa = $request->pemeriksa;
        $kasus->save();

        return redirect()->route('kasus');
    }

    public function verif($idp)
    {
        $pasien = Pasien::find($idp);
        $kasus = Kasus::where('idp', (int)$idp)->first();
        return view('kasus.verif_modal', ['pasien' => $pasien, 'kasus' => $kasus]);
    }
}
