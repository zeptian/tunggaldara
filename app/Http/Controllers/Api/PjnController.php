<?php

namespace App\Http\Controllers\Api;

use App\Pjn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use Illuminate\Support\Facades\Validator;

class PjnController extends Controller
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
                $pjn = Pjn::join('desa', 'desa.kode', '=', 'pjn.kdesa')
                    ->where([['tahun', $tahun], ['bulan', $bulan], ['kdesa', $kel]])
                    ->orderBy('tahun', 'asc')
                    ->orderBy('bulan', 'asc')
                    ->get();
            } else {
                $kels = Kelurahan::select('kode')->where('kode_p', $kode)->get();
                foreach ($kels as $k => $v) {
                    $kels[] = $v->kode;
                }
                $pjn = Pjn::join('desa', 'desa.kode', '=', 'pjn.kdesa')
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
            $pjn = Pjn::join('desa', 'desa.kode', '=', 'pjn.kdesa')->where('id', $id)->where('kdesa', $kels)->first();
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
                'minggu_ke'     => 'required|numeric',
                'bulan'         => 'required|numeric',
                'tahun'         => 'required|numeric',
                'rt'            => 'required|numeric',
                'rw'            => 'required|numeric',
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
                $pjn = new Pjn();
                $pjn->minggu_ke       = $request->minggu_ke;
                $pjn->bulan           = $request->bulan;
                $pjn->tahun           = $request->tahun;
                $pjn->rt              = $request->rt;
                $pjn->rw              = $request->rw;
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
                'minggu_ke'     => 'required|numeric',
                'bulan'         => 'required|numeric',
                'tahun'         => 'required|numeric',
                'rt'            => 'required|numeric',
                'rw'            => 'required|numeric',
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
                $pjn = Pjn::where('id', $id)->first();
                $pjn->minggu_ke       = $request->minggu_ke;
                $pjn->bulan           = $request->bulan;
                $pjn->tahun           = $request->tahun;
                $pjn->rt              = $request->rt;
                $pjn->rw              = $request->rw;
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
            $pjn = Pjn::where('id', $id)->whereIn('kdesa', $kels)->delete();
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