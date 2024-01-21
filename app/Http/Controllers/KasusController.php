<?php

namespace App\Http\Controllers;

use App\Kasus;
use App\Kelurahan;
use App\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        $request->start = $request->start ?? date('01-m-Y');
        $request->end = $request->end ?? date('d-m-Y');

        $kasus = Kasus::join('pasien', 'pasien.id', '=', 'kasus.idp')
            ->where('tgl_lp', '>=', date("Y-m-d", strtotime($request->start)))
            ->where('tgl_lp', '<=',  date("Y-m-d", strtotime($request->end)));
        if ($user->role == "rs") {
            $faskes = $user->faskes;
            $kasus = $kasus->where('rs', $faskes);
        } else if ($user->role == "puskesmas") {
            $kode = $user->kode;
            $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
            foreach ($kels as $k => $v) {
                $kels[] = $v->kode;
            }
            $kasus = $kasus->whereIn('pasien.kdesa', $kels);
        }

        if ($request->status_verifikasi != "all") {
            if ($request->status_verifikasi == "verified") {
                $kasus = $kasus->where("diag_akhir", "!=", "");
            } else {
                $kasus = $kasus->where("diag_akhir", "");
            }
        }
        $kasus = $kasus->get();
        // dd($kasus);
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
        $kasus->trombosit_awal = $request->trombosit_awal;
        $kasus->trombosit = $request->trombosit;
        $kasus->ht_awal = $request->ht_awal;
        $kasus->ht_tegak = $request->ht_tegak;
        $kasus->hb_awal = $request->hb_awal;
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
        $kasus->trombosit_awal = $request->trombosit_awal;
        $kasus->ht_awal = $request->ht_awal;
        $kasus->ht_tegak = $request->ht_tegak;
        $kasus->hb_awal = $request->hb_awal;
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
        $kelurahan = Kelurahan::get();
        return view('kasus.verif_modal', ['pasien' => $pasien, 'kasus' => $kasus, 'kelurahan' => $kelurahan]);
    }
    public function verifSave($idp, Request $request)
    {
        $rules = [
            'trombosit_awal' => 'required',
            'trombosit' => 'required',
            'hb_awal' => 'required',
            'hb_tegak' => 'required',
            'ht_awal' => 'required',
            'ht_tegak' => 'required',
            'igg' => 'required',
            'igm' => 'required',
            'ns1' => 'required',
            'diag_akhir' => 'required',
        ];
        $validatedData = Validator::make($request->all(), $rules);
        if ($validatedData->fails()) {
            $message = "";
            foreach ($validatedData->errors()->toArray() as $error) {
                foreach ($error as $sub_error) {
                    $message .= $sub_error . " <br/>";
                }
            }
            return response()->json(["status" => false, "message" => $message]);
        }
        $kasus = Kasus::where('idp', (int)$idp)->first();
        $kasus->trombosit_awal  = $request->trombosit_awal;
        $kasus->trombosit = $request->trombosit;
        $kasus->hb_awal         = $request->hb_awal;
        $kasus->hb_tegak        = $request->hb_tegak;
        $kasus->ht_awal         = $request->ht_awal;
        $kasus->ht_tegak        = $request->ht_tegak;
        $kasus->igg             = $request->igg;
        $kasus->igm             = $request->igm;
        $kasus->ns1             = $request->ns1;
        $kasus->diag_akhir      = $request->diag_akhir;
        $kasus->tgl_verifikasi  = date("Y-m-d");

        $pasien = Pasien::find($idp);
        $pasien->alamat = $request->alamat;
        $pasien->kdesa = $request->kelurahan;
        $pasien->rtrw = $request->rtrw;
        $pasien->alamat_ktp = $request->alamat_ktp;
        $pasien->save();

        if ($kasus->save()) {
            return response()->json(["status" => true, "message" => "Data berhasil disimpan"]);
        } else {
            return response()->json(["status" => false, "message" => "Data gagal disimpan"]);
        }
    }
}
