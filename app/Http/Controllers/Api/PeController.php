<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Kasus;
use App\Pasien;
use App\Pe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeController extends Controller
{
    //
    public $status = false;
    public $message = 'failed';
    public $data = [];
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function show($id)
    {
        $user = auth('api')->user();
        if (!$user->level == 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $pe = Pe::select(
                'kasus.idk',
                'nama',
                'ortu',
                'alamat',
                'rtrw',
                'kdesa',
                'alamat_ktp',
                'jkl',
                'tgl_lahir',
                'no_kontak',
                'jenis',
                'tgl_lp',
                'rs',
                'status',
                'pe.idpe',
                'tgl_pe',
                'nama_cp',
                'telp_cp',
                'status_pekerjaan',
                'pekerjaan',
                'almt_pekerjaan',
                'wilayah',
                'c_index',
                'cl_panjang',
                'perjalanan',
                'jml_pe',
                'jml_pos',
                'jml_larv',
                'pe.panas',
                'tdbd',
                'dbd',
                'dss',
                'kesimpulan'
            )
                ->join('kasus', 'pe.idk', '=', 'kasus.idk')
                ->join('pasien', 'pasien.id', '=', 'kasus.idp')
                ->where('pe.idk', $id)->first();
            if (empty($pe)) {
                $this->code = 404;
                $this->message = 'data tidak ditemukan';
            } else {
                $this->status = true;
                $this->code = 200;
                $this->message = 'ok';
                $this->data = $pe;
            }
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ], $this->code);
    }
    public function store(Request $request)
    {
        $user = auth('api')->user();
        if (!$user->level == 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $rules = [
                'id_kasus'       => 'required|unique:pe,idk',
                'id_pe'          => 'required',
                'tgl_pe'         => 'required|date',
                'nama_cp'        => 'required',
                'telp_cp'        => 'required',
                'status_pekerjaan' => 'required',
                'pekerjaan'      => 'required',
                'almt_pekerjaan' => 'required',
                'wilayah'        => 'required',
                'c_index'        => 'required',
                'cl_panjang'     => 'required',
                'perjalanan'     => 'required',
                'jml_pe'         => 'required',
                'jml_pos'        => 'required',
                'jml_larv'       => 'required',
                'panas'          => 'required',
                'dd'             => 'required',
                'dbd'            => 'required',
                'dss'            => 'required',
                'kesimpulan'     => 'required',
                'latitude'       => 'required',
                'longitude'      => 'required',
            ];
            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $pjr = new Pe();
                $pjr->idk       = $request->id_kasus;
                $pjr->idpe          = $request->id_pe;
                $pjr->tgl_pe         = date("Y-m-d", strtotime($request->tgl_pe));
                $pjr->nama_cp        = $request->nama_cp;
                $pjr->telp_cp        = $request->telp_cp;
                $pjr->status_pekerjaan  = $request->status_pekerjaan;
                $pjr->pekerjaan      = $request->pekerjaan;
                $pjr->almt_pekerjaan = $request->almt_pekerjaan;
                $pjr->wilayah        = $request->wilayah;
                $pjr->c_index        = $request->c_index;
                $pjr->cl_panjang     = $request->cl_panjang;
                $pjr->perjalanan     = $request->perjalanan;
                $pjr->jml_pe         = $request->jml_pe;
                $pjr->jml_pos        = $request->jml_pos;
                $pjr->jml_larv       = $request->jml_larv;
                $pjr->panas          = $request->panas;
                $pjr->tdbd           = $request->dd;
                $pjr->dbd            = $request->dbd;
                $pjr->dss            = $request->dss;
                $pjr->kesimpulan     = $request->kesimpulan;
                $pjr->user           = $user->kpusk;

                $idp = Kasus::select('idp')->where('idk', $request->id_kasus)->first();
                $pasien = Pasien::where('id', $idp->idp)->first();
                $pasien->latlong          = $request->latitude . "," . $request->longitude;
                $pasien->save();

                if ($pjr->save()) {
                    $this->status = true;
                    $this->code = 201;
                    $this->message = "created";
                    $this->data = $request->input();
                }
            }
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ], $this->code);
    }
    public function storeLoc(Request $request)
    {
        $user = auth('api')->user();
        if (!$user->level == 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $rules = [
                'id_kasus'       => 'required|unique:pe,idk',
                'latitude'       => 'required',
                'longitude'      => 'required',
            ];
            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {

                $idp = Kasus::select('idp')->where('idk', $request->id_kasus)->first();
                $pasien = Pasien::where('id', $idp->idp)->first();
                $pasien->latlong          = $request->latitude . "," . $request->longitude;

                if ($pasien->save()) {
                    $this->status = true;
                    $this->code = 201;
                    $this->message = "created";
                    $this->data = $request->input();
                }
            }
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ], $this->code);
    }

    public function update(Request $request, $id)
    {
        $user = auth('api')->user();
        if (!$user->level == 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $rules = [
                'id_pe'          => 'required',
                'tgl_pe'         => 'required|date',
                'nama_cp'        => 'required',
                'telp_cp'        => 'required',
                'status_pekerjaan' => 'required',
                'pekerjaan'      => 'required',
                'almt_pekerjaan' => 'required',
                'wilayah'        => 'required',
                'c_index'        => 'required',
                'cl_panjang'     => 'required',
                'perjalanan'     => 'required',
                'jml_pe'         => 'required',
                'jml_pos'        => 'required',
                'jml_larv'       => 'required',
                'panas'          => 'required',
                'dd'             => 'required',
                'dbd'            => 'required',
                'dss'            => 'required',
                'kesimpulan'     => 'required',
                'latitude'       => 'required',
                'longitude'      => 'required',
            ];
            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $pjr = Pe::where('idk', $id)->first();
                $pjr->idpe          = $request->id_pe;
                $pjr->tgl_pe         = date("Y-m-d", strtotime($request->tgl_pe));
                $pjr->nama_cp        = $request->nama_cp;
                $pjr->telp_cp        = $request->telp_cp;
                $pjr->status_pekerjaan  = $request->status_pekerjaan;
                $pjr->pekerjaan      = $request->pekerjaan;
                $pjr->almt_pekerjaan = $request->almt_pekerjaan;
                $pjr->wilayah        = $request->wilayah;
                $pjr->c_index        = $request->c_index;
                $pjr->cl_panjang     = $request->cl_panjang;
                $pjr->perjalanan     = $request->perjalanan;
                $pjr->jml_pe         = $request->jml_pe;
                $pjr->jml_pos        = $request->jml_pos;
                $pjr->jml_larv       = $request->jml_larv;
                $pjr->panas          = $request->panas;
                $pjr->tdbd           = $request->dd;
                $pjr->dbd            = $request->dbd;
                $pjr->dss            = $request->dss;
                $pjr->kesimpulan     = $request->kesimpulan;
                $pjr->user           = $user->kpusk;

                if ($pjr->save()) {
                    $this->status = true;
                    $this->code = 202;
                    $this->message = "Updated";
                    $this->data = $request->input();
                }
            }
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ], $this->code);
    }
}