<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\Pjb;

class PjbController extends Controller
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
        $kel = $request->input('kelurahan') ?? '';
        $user = auth('api')->user();
        $kode = $user->kpusk;
        if ($user->level != 'puskesmas') {
            $this->message = 'Anauthorized';
            $this->code = 401;
        } else {
            if ($kel != '') {
                $pjn = Pjb::join('desa', 'desa.kode', '=', 'pjb.kdesa')
                    ->where([['tahun', $tahun], ['bulan', $bulan], ['kdesa', $kel]])
                    ->orderBy('tahun', 'asc')
                    ->orderBy('bulan', 'asc')
                    ->get();
            } else {
                $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
                foreach ($kels as $k => $v) {
                    $kels[] = $v->kode;
                }
                $pjn = Pjb::join('desa', 'desa.kode', '=', 'pjb.kdesa')
                    ->where([['tahun', $tahun], ['bulan', $bulan]])
                    ->whereIn('kdesa', $kels)
                    ->orderBy('tahun', 'asc')
                    ->orderBy('bulan', 'asc')
                    ->get();
            }
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
            $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
            foreach ($kels as $k => $v) {
                $kels[] = $v->kode;
            }
            $pjn = Pjb::join('desa', 'desa.kode', '=', 'pjb.kdesa')
                ->where('id', $id)
                ->whereIn('kdesa', $kels)
                ->orderBy('tahun', 'asc')
                ->orderBy('bulan', 'asc')
                ->first();
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
                'bulan'         => 'required|numeric',
                'tahun'         => 'required|numeric',
                'kelurahan'     => 'required',
                'jml_rumah'     => 'required|numeric',
                'jml_positif'   => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $pjn = new Pjb();
                $pjn->bulan           = $request->bulan;
                $pjn->tahun           = $request->tahun;
                $pjn->kdesa           = $request->kelurahan;
                $pjn->jml_rumah       = $request->jml_rumah;
                $pjn->jml_positif     = $request->jml_positif;

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
                'bulan'         => 'required|numeric',
                'tahun'         => 'required|numeric',
                'kelurahan'     => 'required',
                'jml_rumah'     => 'required|numeric',
                'jml_positif'   => 'required|numeric',
            ];

            $validatedData = Validator::make($request->all(), $rules);
            if ($validatedData->fails()) {
                $this->status = false;
                $this->code = 422;
                $this->message = $validatedData->errors();
            } else {
                $user_id = auth('api')->user()->kpusk;
                $pjn = Pjb::where('id', $id)->first();
                $pjn->bulan           = $request->bulan;
                $pjn->tahun           = $request->tahun;
                $pjn->kdesa           = $request->kelurahan;
                $pjn->jml_rumah       = $request->jml_rumah;
                $pjn->jml_positif     = $request->jml_positif;

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
            $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
            foreach ($kels as $k => $v) {
                $kels[] = $v->kode;
            }
            $pjn = Pjb::where('id', $id)->whereIn('kdesa', $kels)->delete();
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