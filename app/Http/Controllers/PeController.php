<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use App\Pasien;
use App\Pe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeController extends Controller
{
    //
    public function index(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        if ($start == '' || $end == '') {
            return redirect()->route('pe', ['start' => date('01-m-Y'), 'end' => date('d-m-Y')]);
        }
        $user = Auth::user();
        if ($user->level == 'puskesmas') {
            $kode = $user->kode;
            $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
            foreach ($kels as $k => $v) {
                $kels[] = $v->kode;
            }
        }

        $start = date("Y-m-d", strtotime($request->start));
        $end = date("Y-m-d", strtotime($request->end));
        $pasien = Pasien::select('kasus.idk', 'nama', 'ortu', 'alamat', 'rtrw', 'kdesa', 'alamat_ktp', 'jkl', 'tgl_lahir', 'no_kontak', 'tgl_lp', 'rs', 'status', 'tgl_pe', 'jenis', 'diag_akhir', 'kasus.tgl_verifikasi')
            ->join('kasus', 'kasus.idp', '=', 'pasien.id')
            ->join('pe', 'pe.idk', '=', 'kasus.idk', 'left outer')
            ->whereBetween('tgl_lp', [$start, $end]);
        if ($request->status == "Sudah PE") {
            $pasien = $pasien->where('tgl_pe', '!=', null);
        } else {
            $pasien = $pasien->where('tgl_pe', null);
        }

        if ($user->level == 'puskesmas') {
            $pasien = $pasien->whereIn('kdesa', $kels);
        }
        $pasien = $pasien->orderBy('tgl_lp', 'asc')->get();
        // dd($pasien->toSql());
        // dump($pasien->attributesToArray());
        return view('pe.rekap', ['request' => $request, 'kasus' => $pasien]);
    }

    public function create($idk)
    {
        $pasien = Pasien::join('kasus', 'kasus.idp', '=', 'pasien.id')->where('kasus.idk', $idk)->first();
        $pe = Pe::where('idk', $idk)->first();
        return view("pe.form", ['pasien' => $pasien, 'pe' => $pe ?? null]);
    }
    public function store($idk, Request $request)
    {
        $request->validate([
            'idpe'      => 'required|unique',
            'tgl_pe'    => 'required',
            'nama_cp'   => 'required',
            'telp_cp'   => 'required',
            'status_pekerjaan'  => 'required',
            'cl_panjang'    => 'required',
            'pekerjaan' => 'required',
            'almt_pekerjaan'    => 'required',
            'wilayah'   => 'required',
            'c_index'   => 'required',
            'perjalanan'  => 'required',
            'frekuensi' => 'required',
            'jml_pe'    => 'required',
            'jml_pos'   => 'required',
            'jml_larv'  => 'required',
            'liter_larv' => 'required',
            'panas'     => 'required',
            'tdbd'      => 'required',
            'dbd'       => 'required',
            'dss'       => 'required',
        ]);

        $pe                 = new Pe();
        $pe->idk            = $idk;
        $pe->idpe           = $request->idpe;
        $pe->tgl_pe         = $request->tgl_pe;
        $pe->nama_cp        = $request->nama_cp;
        $pe->telp_cp        = $request->telp_cp;
        $pe->status_pekerjaan = $request->status_pekerjaan;
        $pe->cl_panjang     = $request->cl_panjang[0];
        $pe->pekerjaan      = $request->pekerjaan;
        $pe->almt_pekerjaan = $request->almt_pekerjaan;
        $pe->wilayah        = $request->wilayah[0];
        $pe->c_index        = $request->c_index;
        $pe->perjalanan       = $request->perjalanan[0];
        $pe->frekuensi      = $request->frekuensi;
        $pe->jml_pe         = $request->jml_pe;
        $pe->jml_pos        = $request->jml_pos;
        $pe->jml_larv       = $request->jml_larv;
        $pe->liter_larv     = $request->liter_larv;
        $pe->panas          = $request->panas;
        $pe->tdbd           = $request->tdbd;
        $pe->dbd            = $request->dbd;
        $pe->dss            = $request->dss;
        $pe->save();

        return redirect()->route('kasus');
    }

    public function edit($idk)
    {
        $pasien = Pasien::join('kasus', 'kasus.idp', '=', 'pasien.id')->where('kasus.idk', $idk)->first();
        $pe = Pe::where('idk', $idk)->first();
        return view("pe.form", ['pasien' => $pasien, 'pe' => $pe]);
    }
    public function update($idk, Request $request)
    {
        $request->validate([
            'idpe'      => 'required',
            'tgl_pe'    => 'required',
            'nama_cp'   => 'required',
            'telp_cp'   => 'required',
            'status_pekerjaan'  => 'required',
            'cl_panjang'    => 'required',
            'pekerjaan' => 'required',
            'almt_pekerjaan'    => 'required',
            'wilayah'   => 'required',
            'c_index'   => 'required',
            'perjalanan'  => 'required',
            'frekuensi' => 'required',
            'jml_pe'    => 'required',
            'jml_pos'   => 'required',
            'jml_larv'  => 'required',
            'liter_larv' => 'required',
            'panas'     => 'required',
            'tdbd'      => 'required',
            'dbd'       => 'required',
            'dss'       => 'required',
        ]);

        $pe                 = Pe::where('idk', $idk)->first();
        $pe->idk            = $idk;
        $pe->idpe           = $request->idpe;
        $pe->tgl_pe         = $request->tgl_pe;
        $pe->nama_cp        = $request->nama_cp;
        $pe->telp_cp        = $request->telp_cp;
        $pe->status_pekerjaan = $request->status_pekerjaan;
        $pe->cl_panjang     = $request->cl_panjang[0];
        $pe->pekerjaan      = $request->pekerjaan;
        $pe->almt_pekerjaan = $request->almt_pekerjaan;
        $pe->wilayah        = $request->wilayah[0];
        $pe->c_index        = $request->c_index;
        $pe->perjalanan       = $request->perjalanan[0];
        $pe->frekuensi      = $request->frekuensi;
        $pe->jml_pe         = $request->jml_pe;
        $pe->jml_pos        = $request->jml_pos;
        $pe->jml_larv       = $request->jml_larv;
        $pe->liter_larv     = $request->liter_larv;
        $pe->panas          = $request->panas;
        $pe->tdbd           = $request->tdbd;
        $pe->dbd            = $request->dbd;
        $pe->dss            = $request->dss;
        $pe->save();
        dd($pe);
        return redirect()->route('kasus');
    }
}
