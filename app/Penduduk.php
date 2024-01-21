<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Penduduk extends Model
{
    //
    protected $table = 'penduduk';

    public static function rekapKec($tahun)
    {
        $penduduk = DB::table('penduduk as pd')
            ->join('desa as kd', 'kd.kode', 'pd.kdesa')
            ->join('kecamatan as kc', 'kc.kode', 'kd.kode_k')
            ->selectRaw('kc.kode as kode_kc, kc.nama, sum(jumlah) as penduduk')
            ->where('tahun', $tahun)
            ->groupBy('kc.kode');
        return $penduduk;
    }
    public static function rekapDesa($tahun)
    {
        $penduduk = DB::table('penduduk as pd')
            ->join('desa as kd', 'kd.kode', 'pd.kdesa')
            ->selectRaw('kd.kode as kode_kd, kd.nama, sum(jumlah) as penduduk')
            ->where('tahun', $tahun)
            ->groupBy('kd.kode');
        return $penduduk;
    }
    public static function rekapPusk($tahun)
    {
        $penduduk = DB::table('penduduk as pd')
            ->join('desa as kd', 'kd.kode', 'pd.kdesa')
            ->join('puskesmas as ps', 'ps.kode', 'kd.kode_p')
            ->selectRaw('kd.kode_p as kode_p, ps.nama, sum(jumlah) as penduduk')
            ->where('tahun', $tahun)
            ->groupBy('kd.kode_p');
        return $penduduk;
    }
}
