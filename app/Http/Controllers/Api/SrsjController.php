<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Srsj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SrsjController extends Controller
{
    //
    //
    public $status = false;
    public $message = 'failed';
    public $code = 200;
    public $data = [];
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request)
    {
        $tahun = $request->input('tahun') ?? date('Y');
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'puskesmas') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $srsj = Srsj::where([['tahun', $tahun], ['puskesmas', $kode]])
                ->orderBy('bulan', 'asc')
                ->get();

            $this->status = true;
            $this->message = 'ok';
            $this->data = $srsj;
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ], $this->code);
    }
    public function show($id)
    {
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'puskesmas') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $srsj = Srsj::where('id', $id)->where('puskesmas', $kode)->first();
            // dd($srsj);
            if (!empty($srsj)) {
                $this->status = true;
                $this->message = 'ok';
                $this->data = $srsj;
            } else {
                $this->status = false;
                $this->message = 'Not Found';
                $this->code = 404;
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
        if (!$user->level == 'puskesmas') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $rules = [
                'tahun'                   => 'required|numeric',
                'bulan'                   => 'required|numeric',
                'jml_target_lokasi'       => 'required|numeric',
                'jml_total_bangunan'      => 'required|numeric',
                'jml_jumantik'            => 'required|numeric',
                'jml_koord'               => 'required|numeric',
                'abj_jumantik'            => 'required|between:0,100.00',
                'abj_koord'               => 'required|between:0,100.00',
                'abj_nakes'               => 'required|between:0,100.00',
                'jml_dd'                  => 'required|numeric',
                'jml_dbd'                 => 'required|numeric',
                'jml_dss'                 => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $srsj = new Srsj();
                $srsj->puskesmas       = $user->kpusk;
                $srsj->tahun           = $request->tahun;
                $srsj->bulan           = $request->bulan;
                $srsj->jml_target_lokasi  = $request->jml_target_lokasi;
                $srsj->jml_total_bangunan     = $request->jml_total_bangunan;
                $srsj->jml_jumantik       = $request->jml_jumantik;
                $srsj->jml_koord         = $request->jml_koord;
                $srsj->abj_jumantik     = $request->abj_jumantik;
                $srsj->abj_koord        = $request->abj_koord;
                $srsj->abj_nakes        = $request->abj_nakes;
                $srsj->jml_dd           = $request->jml_dd;
                $srsj->jml_dbd          = $request->jml_dd;
                $srsj->jml_dss          = $request->jml_dss;

                if ($srsj->save()) {
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
        if (!$user->level == 'puskesmas') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $rules = [
                'tahun'                   => 'required|numeric',
                'bulan'                   => 'required|numeric',
                'jml_target_lokasi'       => 'required|numeric',
                'jml_total_bangunan'      => 'required|numeric',
                'jml_jumantik'            => 'required|numeric',
                'jml_koord'               => 'required|numeric',
                'abj_jumantik'            => 'required|between:0,100.00',
                'abj_koord'               => 'required|between:0,100.00',
                'abj_nakes'               => 'required|between:0,100.00',
                'jml_dd'                  => 'required|numeric',
                'jml_dbd'                 => 'required|numeric',
                'jml_dss'                 => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $srsj = Srsj::where('id', $id)->first();
                $srsj->puskesmas       = $user->kpusk;
                $srsj->tahun           = $request->tahun;
                $srsj->bulan           = $request->bulan;
                $srsj->jml_target_lokasi  = $request->jml_target_lokasi;
                $srsj->jml_total_bangunan     = $request->jml_total_bangunan;
                $srsj->jml_jumantik       = $request->jml_jumantik;
                $srsj->jml_koord         = $request->jml_koord;
                $srsj->abj_jumantik     = $request->abj_jumantik;
                $srsj->abj_koord        = $request->abj_koord;
                $srsj->abj_nakes        = $request->abj_nakes;
                $srsj->jml_dd           = $request->jml_dd;
                $srsj->jml_dbd          = $request->jml_dd;
                $srsj->jml_dss          = $request->jml_dss;

                if ($srsj->save()) {
                    $this->status = true;
                    $this->code = 202;
                    $this->message = "updated";
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
    public function destroy($id)
    {
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'puskesmas') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $srsj = Srsj::where([['id', $id], ['puskesmas', $kode]])->delete();
            if ($srsj) {
                $this->status = true;
                $this->code = 202;
                $this->message = 'deleted';
            }
        }
        return response()->json([
            'status'    => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
        ], $this->code);
    }
}