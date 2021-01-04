<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pjg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PjgController extends Controller
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
            $pjg = Pjg::where([['tahun', $tahun], ['puskesmas', $kode]])
                ->orderBy('tahun', 'asc')
                ->orderBy('bulan', 'asc')
                ->get();
            $this->status = true;
            $this->message = 'ok';
            $this->data = $pjg;
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
            $pjg = Pjg::where('id', $id)
                ->whereIn('puskesmas', $kode)
                ->orderBy('tahun', 'asc')
                ->orderBy('bulan', 'asc')
                ->first();
            // dd($pjg);
            if (!empty($pjg)) {
                $this->status = true;
                $this->message = 'ok';
                $this->data = $pjg;
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
                'jml_rumah'     => 'required|numeric',
                'jml_positif'   => 'required|numeric',
                'larvasida'     => 'required|numeric',
                'jml_penyuluhan' => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $pjg = new Pjg();
                $pjg->puskesmas       = $user->kpusk;
                $pjg->tanggal         = date("Y-m-d", strtotime($request->tanggal));
                $pjg->bulan           = $request->bulan;
                $pjg->tahun           = $request->tahun;
                $pjg->minggu_ke       = $request->minggu_ke;
                $pjg->jml_rumah       = $request->jml_rumah;
                $pjg->jml_positif     = $request->jml_positif;
                $pjg->larvasida       = $request->larvasida;
                $pjg->jml_penyuluhan  = $request->jml_penyuluhan;

                if ($pjg->save()) {
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
                'jml_rumah'     => 'required|numeric',
                'jml_positif'   => 'required|numeric',
                'larvasida'     => 'required|numeric',
                'jml_penyuluhan' => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $pjg = Pjg::where('id', $id)->first();
                $pjg->tanggal         = date("Y-m-d", strtotime($request->tanggal));
                $pjg->bulan           = $request->bulan;
                $pjg->tahun           = $request->tahun;
                $pjg->minggu_ke       = $request->minggu_ke;
                $pjg->jml_rumah       = $request->jml_rumah;
                $pjg->jml_positif     = $request->jml_positif;
                $pjg->larvasida       = $request->larvasida;
                $pjg->jml_penyuluhan  = $request->jml_penyuluhan;

                if ($pjg->save()) {
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
            $pjg = Pjg::where([['id', $id], ['puskesmas', $kode]])->delete();
            if ($pjg) {
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