<?php

namespace App\Http\Controllers;

use App\Kasus;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function index()
    {
        return view('welcome');
    }
    public function menu()
    {
        $jmlKasus = Kasus::whereYear('tegak', date('Y'))->count();
        $jmlKasusNonVerif = Kasus::whereYear('tegak', date('Y'))->where('diag_akhir', '')->count();
        $blumPe = Kasus::leftJoin('pe', 'kasus.idk', '=', 'pe.idk')->whereYear('tegak', date('Y'))->where('pe.id', null)->count();

        return view('menu', ['jml_kasus' => $jmlKasus, 'jml_belum_pe' => $blumPe, 'jml_kasus_nonverif' => $jmlKasusNonVerif]);
    }
}
