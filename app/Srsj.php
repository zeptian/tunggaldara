<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Srsj extends Model
{
    //
    protected $table = 'srsj';
    protected $fillable = ['puskesmas', 'tahun', 'bulan', 'jml_target_lokasi', 'jml_total_bangunan', 'jml_jumantik', 'jml_koord', 'abj_jumantik', 'abj_koord', 'abj_nakes', 'jml_dd', 'jml_dbd', 'jml_dss'];
}