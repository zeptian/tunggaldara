<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    function getFileDb(Request $request)
    {
        $request->validate([
            'tbl' => 'required',
            'id'  => 'required|min:1'
        ]);

        $data = DB::table($request->tbl)->first($request->id);

        $file = 'tmp/lampiran.' . $data->file_ext;
        file_put_contents($file, $data->lampiran);
        return header('location:' . $file);
    }
}
