<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\LapPjn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LapPjnController extends Controller
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
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'puskesmas') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            $pjn = LapPjn::where([['tahun', $tahun], ['puskesmas', $kode]])
                ->orderBy('bulan', 'desc')
                ->get();
            $this->status = true;
            $this->message = 'ok';
            $this->data = $pjn;
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
            $pjn = LapPjn::where([['id', $id], ['puskesmas', $kode]])->first();
            // dd($pjn);
            if (!empty($pjn)) {
                $this->status = true;
                $this->message = 'ok';
                $this->data = $pjn;
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
                'tanggal'       => 'required|date',
                'bulan'         => 'required|numeric',
                'tahun'         => 'required|numeric',
                'minggu_ke'         => 'required|numeric',
                'jml_kelurahan'     => 'required|numeric',
                'jml_kelurahan_melaksanakan'   => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $pjn = new LapPjn();
                $pjn->puskesmas       = $user->kpusk;
                $pjn->tanggal         = date("Y-m-d", strtotime($request->tanggal));
                $pjn->bulan           = $request->bulan;
                $pjn->tahun           = $request->tahun;
                $pjn->minggu_ke       = $request->minggu_ke;
                $pjn->jml_kelurahan       = $request->jml_kelurahan;
                $pjn->jml_kelurahan_melaksanakan     = $request->jml_kelurahan_melaksanakan;

                if ($pjn->save()) {
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
                'tanggal'       => 'required|date',
                'bulan'         => 'required|numeric',
                'tahun'         => 'required|numeric',
                'minggu_ke'         => 'required|numeric',
                'jml_kelurahan'     => 'required|numeric',
                'jml_kelurahan_melaksanakan'   => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $pjn = LapPjn::where('id', $id)->first();
                $pjn->tanggal         = date("Y-m-d", strtotime($request->tanggal));
                $pjn->bulan           = $request->bulan;
                $pjn->tahun           = $request->tahun;
                $pjn->minggu_ke       = $request->minggu_ke;
                $pjn->jml_kelurahan       = $request->jml_kelurahan;
                $pjn->jml_kelurahan_melaksanakan     = $request->jml_kelurahan_melaksanakan;

                if ($pjn->save()) {
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
            $pjn = LapPjn::where([['id', $id], ['puskesmas', $kode]])->delete();
            if ($pjn) {
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