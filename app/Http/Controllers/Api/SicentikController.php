<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sicentik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SicentikController extends Controller
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
            $sicentik = Sicentik::where([['tahun', $tahun], ['user', $kode]])
                ->orderBy('bulan', 'asc')
                ->get();

            $this->status = true;
            $this->message = 'ok';
            $this->data = $sicentik;
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
            $sicentik = Sicentik::where('id_sicentik', $id)->where('user', $kode)->first();
            // dd($sicentik);
            if (!empty($sicentik)) {
                $this->status = true;
                $this->message = 'ok';
                $this->data = $sicentik;
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
                'bulan'             => 'required|numeric',
                'tahun'             => 'required|numeric',
                'sasaranSekolah'    => 'required|numeric',
                'realSekolah'       => 'required|numeric',
                'sekolahPantau'     => 'required|numeric',
                'sekolahPositif'    => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $sicentik = new Sicentik();
                $sicentik->bulan           = $request->bulan;
                $sicentik->tahun           = $request->tahun;
                $sicentik->puskesmas       = $user->kpusk;
                $sicentik->user            = $user->kpusk;
                $sicentik->sasaranSekolah  = $request->sasaranSekolah;
                $sicentik->realSekolah     = $request->realSekolah;
                $sicentik->sekolahPantau   = $request->sekolahPantau;
                $sicentik->sekolahPositif  = $request->sekolahPositif;

                if ($sicentik->save()) {
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
                'bulan'             => 'required|numeric',
                'tahun'             => 'required|numeric',
                'sasaranSekolah'    => 'required|numeric',
                'realSekolah'       => 'required|numeric',
                'sekolahPantau'     => 'required|numeric',
                'sekolahPositif'    => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $sicentik = Sicentik::where('id_sicentik', $id)->first();
                $sicentik->bulan           = $request->bulan;
                $sicentik->tahun           = $request->tahun;
                $sicentik->puskesmas       = $user->kpusk;
                $sicentik->user            = $user->kpusk;
                $sicentik->sasaranSekolah  = $request->sasaranSekolah;
                $sicentik->realSekolah     = $request->realSekolah;
                $sicentik->sekolahPantau   = $request->sekolahPantau;
                $sicentik->sekolahPositif  = $request->sekolahPositif;

                if ($sicentik->save()) {
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
            $sicentik = Sicentik::where([['id_sicentik', $id], ['user', $kode]])->delete();
            if ($sicentik) {
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