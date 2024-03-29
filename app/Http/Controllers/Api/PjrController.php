<?php

namespace App\Http\Controllers\Api;

use App\Pjr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PjrController extends Controller
{
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
        $bulan = $request->input('bulan') ?? date('m');
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $pjr = Pjr::select('id', 'tanggal', 'minggu_ke', 'bulan', 'tahun', 'rt', 'rw', 'jml_rumah', 'jml_positif', 'jml_perangkap', 'jml_tikus', 'no_pengirim as pelapor', 'kdesa', 'nama')
                ->join('desa', 'desa.kode', '=', 'pjr.kdesa')
                ->where([['kdesa', $kode], ['tahun', $tahun], ['bulan', $bulan]])
                ->orderBy('tahun', 'asc')
                ->orderBy('bulan', 'asc')
                ->get();

            $this->status = true;
            $this->message = 'ok';
            $this->data = $pjr;
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
                'tanggal'       => 'required|date',
                'minggu_ke'     => 'required|numeric',
                'bulan'         => 'required|numeric',
                'tahun'         => 'required|numeric',
                'rt'            => 'required|numeric',
                'rw'            => 'required|numeric',
                'jml_rumah'     => 'required|numeric',
                'jml_positif'   => 'required|numeric',
                'jml_perangkap' => 'required|numeric',
                'jml_tikus'     => 'required|numeric',
                'pelapor'       => 'required',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else if (Pjr::where([
                ['minggu_ke', $request->minggu_ke], ['bulan', $request->bulan],
                ['tahun', $request->tahun], ['rt', $request->rt],
                ['rw', $request->rw], ['kdesa', $user->kpusk],
            ])->first()) {
                $this->status = false;
                $this->code = 422;
                $this->message = "data PJR telah di input Sebelumnya";
            } else {
                $user_id = auth('api')->user()->kpusk;
                $pjr = new Pjr();
                $pjr->tanggal         = date("Y-m-d", strtotime($request->tanggal));
                $pjr->minggu_ke       = $request->minggu_ke;
                $pjr->bulan           = $request->bulan;
                $pjr->tahun           = $request->tahun;
                $pjr->rt              = $request->rt;
                $pjr->rw              = $request->rw;
                $pjr->kdesa           = $user_id;
                $pjr->jml_rumah       = $request->jml_rumah;
                $pjr->jml_positif     = $request->jml_positif;
                $pjr->jml_perangkap   = $request->jml_perangkap;
                $pjr->jml_tikus       = $request->jml_tikus;
                $pjr->no_pengirim         = $request->pelapor;

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
    public function update(Request $request, $id)
    {
        $user = auth('api')->user();
        if (!$user->level == 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $rules = [
                'tanggal'       => 'required|date',
                'minggu_ke'     => 'required|numeric',
                'bulan'         => 'required|numeric',
                'tahun'         => 'required|numeric',
                'rt'            => 'required|numeric',
                'rw'            => 'required|numeric',
                'jml_rumah'     => 'required|numeric',
                'jml_positif'   => 'required|numeric',
                'jml_perangkap' => 'required|numeric',
                'jml_tikus'     => 'required|numeric',
                'pelapor'       => 'required',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $user_id = auth('api')->user()->kpusk;
                $pjr = Pjr::where('id', $id)->first();
                $pjr->tanggal         = date("Y-m-d", strtotime($request->tanggal));
                $pjr->minggu_ke       = $request->minggu_ke;
                $pjr->bulan           = $request->bulan;
                $pjr->tahun           = $request->tahun;
                $pjr->rt              = $request->rt;
                $pjr->rw              = $request->rw;
                $pjr->kdesa           = $user_id;
                $pjr->jml_rumah       = $request->jml_rumah;
                $pjr->jml_positif     = $request->jml_positif;
                $pjr->jml_perangkap   = $request->jml_perangkap;
                $pjr->jml_tikus       = $request->jml_tikus;
                $pjr->no_pengirim         = $request->pelapor;

                if ($pjr->save()) {
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
    public function show($id)
    {
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $pjr = Pjr::select('id', 'tanggal', 'minggu_ke', 'bulan', 'tahun', 'rt', 'rw', 'jml_rumah', 'jml_positif', 'jml_perangkap', 'jml_tikus', 'no_pengirim as pelapor', 'kdesa', 'nama')
                ->join('desa', 'desa.kode', '=', 'pjr.kdesa')
                ->where([['kdesa', $kode], ['id', $id]])
                ->first();
            if (!empty($pjr)) {
                $this->status = true;
                $this->message = 'ok';
                $this->data = $pjr;
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
    public function destroy($id)
    {
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'kader') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $pjr = Pjr::where([['kdesa', $kode], ['id', $id]])->delete();
            if ($pjr) {
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