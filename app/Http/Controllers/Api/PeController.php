<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $user = auth('api')->user();
        if (!$user->level == 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $rules = [
                'id_kasus'       => 'required',
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
            ];
            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $pjr = new Pe();
                $pjr->idk       = $request->id_kasus;
                $pjr->ide          = $request->id_pe;
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

                if ($pjr->save()) {
                    $this->status = true;
                    $this->code = 202;
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
}