<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pe extends Model
{
    //
    protected $table = 'pe';
    protected $fillable = [
        'idpe', 'idk', 'tgl_pe', 'nama_cp', 'telp_cp', 'status_pekerjaan',
        'pekerjaan', 'almt_pekerjaan', 'wilayah', 'c_index', 'cl_panjang', 'perjalanan',
        'jml_pe', 'jml_pos', 'jml_larv', 'panas', 'tdbd', 'dbd', 'dss', 'kesimpulan',
        'fogging'
    ];

    public function pasien()
    {
        $this->hasOne(Pasien::class);
    }

    public static function kecepatanPe($tanggal1, $tanggal2) 
    {
        $pe = DB::table("kasus_rinci as k")
            ->leftjoin("pe", "pe.idk","=","k.idk")
            ->selectRaw("pus,
                    SUM(IF(diag_akhir='DBD' OR diag_akhir='DSS',1,0)) dbdtotal,
                    sum(if(TOTAL_WEEKDAYS( k.tgl_lp, tgl_pe) <=1 AND (diag_akhir='DBD' OR diag_akhir='DSS'),1,0)) as dbd24jam,
                    sum(if(TOTAL_WEEKDAYS( k.tgl_lp, tgl_pe) <=2 and TOTAL_WEEKDAYS( k.tgl_lp, tgl_pe) >1  AND (diag_akhir='DBD' OR diag_akhir='DSS'),1,0)) as dbd2hr,
                    sum(if(TOTAL_WEEKDAYS( k.tgl_lp, tgl_pe) >2 AND (diag_akhir='DBD' OR diag_akhir='DSS'),1,0)) as dbdlbh2hr,
                    SUM(IF(diag_akhir='DBD' OR diag_akhir='DSS',1,0)) - SUM(IF(tgl_pe!='' AND (diag_akhir='DBD' OR diag_akhir='DSS'),1,0)) as dbdblmpe,
                    SUM(IF(diag_akhir='DD',1,0)) ddtotal,
                    sum(if(TOTAL_WEEKDAYS( k.tgl_lp, tgl_pe) <=1 AND diag_akhir='DD',1,0)) as dd24jam,
                    sum(if(TOTAL_WEEKDAYS( k.tgl_lp, tgl_pe) <=2 and TOTAL_WEEKDAYS( k.tgl_lp, tgl_pe) >1 AND diag_akhir='DD',1,0)) as dd2hr,
                    sum(if(TOTAL_WEEKDAYS( k.tgl_lp, tgl_pe) >2 AND diag_akhir='DD',1,0)) as ddlbh2hr,
                    SUM(IF(diag_akhir='DD',1,0)) - SUM(IF(tgl_pe!='' AND diag_akhir='DD',1,0)) as ddblmpe")
            ->where("diag_akhir","<>",'NON Kriteria')
            ->where("k.tgl_lp", ">=", $tanggal1) 
            ->where("k.tgl_lp", "<=", $tanggal2)
            ->where("pus","!=","luar kota")
            ->where("pus","!=","NON DATA")
            ->groupBy("pus");
        
        return $pe;
    }
}