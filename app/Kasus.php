<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\Stub\ReturnValueMap;

class Kasus extends Model
{
    //    
    protected $table = "kasus";
    protected $fillable = ['no_rm', 'nama', 'ortu', 'latlong', 'kdesa', 'rtrw', 'alamat', 'alamat_ktp', 'jkl', 'tgl_lahir', 'nama_kontak', 'relasi', 'no_kontak'];

    public function Pasien()
    {
        return $this->hasOne(Pasien::class, 'id', 'idp');
    }

    public static function rekapKasusDbd($wilayah, $periode)
    {
        $kasus = DB::table('kasus_rinci as k')
            ->selectRaw($wilayah . ",sum(if(month(tegak)=1,1,0)) P1,
                    sum(if(month(tegak)=1 and status='M',1,0)) M1,
                    sum(if(month(tegak)=2,1,0)) P2,
                    sum(if(month(tegak)=2 and status='M',1,0)) M2,
                    sum(if(month(tegak)=3,1,0)) P3,
                    sum(if(month(tegak)=3 and status='M',1,0)) M3,
                    sum(if(month(tegak)=4,1,0)) P4,
                    sum(if(month(tegak)=4 and status='M',1,0)) M4,
                    sum(if(month(tegak)=5,1,0)) P5,
                    sum(if(month(tegak)=5 and status='M',1,0)) M5,
                    sum(if(month(tegak)=6,1,0)) P6,
                    sum(if(month(tegak)=6 and status='M',1,0)) M6,
                    sum(if(month(tegak)=7,1,0)) P7,
                    sum(if(month(tegak)=7 and status='M',1,0)) M7,
                    sum(if(month(tegak)=8,1,0)) P8,
                    sum(if(month(tegak)=8 and status='M',1,0)) M8,
                    sum(if(month(tegak)=9,1,0)) P9,
                    sum(if(month(tegak)=9 and status='M',1,0)) M9,
                    sum(if(month(tegak)=10,1,0)) P10,
                    sum(if(month(tegak)=10 and status='M',1,0)) M10,
                    sum(if(month(tegak)=11,1,0)) P11,
                    sum(if(month(tegak)=11 and status='M',1,0)) M11,
                    sum(if(month(tegak)=12,1,0)) P12,
                    sum(if(month(tegak)=12 and status='M',1,0)) M12,
                    sum(if(status='M' or status='P',1,0)) P,
                    sum(if(status='M',1,0)) M")
            ->where(function ($query) {
                $query->where('diag_akhir', 'DBD')->orWhere('diag_akhir', 'DSS');
            })
            ->whereYear('tegak', $periode)->where('tgl_verifikasi', '>', '1970-01-01')
            ->where('k.kec', '!=', 'NON DATA')->where('k.kec', '!=', 'Luar Kota')
            ->groupBy($wilayah)->orderBy($wilayah);

        return $kasus;
    }
    public static function rekapKasusDd($wilayah, $periode)
    {
        $kasus = DB::table('kasus_rinci as k')
            ->selectRaw($wilayah . ",sum(if(month(tegak)=1,1,0)) P1,
                    sum(if(month(tegak)=1 and status='M',1,0)) M1,
                    sum(if(month(tegak)=2,1,0)) P2,
                    sum(if(month(tegak)=2 and status='M',1,0)) M2,
                    sum(if(month(tegak)=3,1,0)) P3,
                    sum(if(month(tegak)=3 and status='M',1,0)) M3,
                    sum(if(month(tegak)=4,1,0)) P4,
                    sum(if(month(tegak)=4 and status='M',1,0)) M4,
                    sum(if(month(tegak)=5,1,0)) P5,
                    sum(if(month(tegak)=5 and status='M',1,0)) M5,
                    sum(if(month(tegak)=6,1,0)) P6,
                    sum(if(month(tegak)=6 and status='M',1,0)) M6,
                    sum(if(month(tegak)=7,1,0)) P7,
                    sum(if(month(tegak)=7 and status='M',1,0)) M7,
                    sum(if(month(tegak)=8,1,0)) P8,
                    sum(if(month(tegak)=8 and status='M',1,0)) M8,
                    sum(if(month(tegak)=9,1,0)) P9,
                    sum(if(month(tegak)=9 and status='M',1,0)) M9,
                    sum(if(month(tegak)=10,1,0)) P10,
                    sum(if(month(tegak)=10 and status='M',1,0)) M10,
                    sum(if(month(tegak)=11,1,0)) P11,
                    sum(if(month(tegak)=11 and status='M',1,0)) M11,
                    sum(if(month(tegak)=12,1,0)) P12,
                    sum(if(month(tegak)=12 and status='M',1,0)) M12,
                    sum(if(status='M' or status='P',1,0)) P,
                    sum(if(status='M',1,0)) M")
            ->where('diag_akhir', 'DD')
            ->whereYear('tegak', $periode)->where('tgl_verifikasi', '>', '1970-01-01')
            ->where('k.kec', '!=', 'NON DATA')->where('k.kec', '!=', 'Luar Kota')
            ->groupBy($wilayah)->orderBy($wilayah);

        return $kasus;
    }
}
