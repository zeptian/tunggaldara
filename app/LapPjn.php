<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LapPjn extends Model
{
    //
    protected $table = 'lap_pjn';
    protected $fillable = ['puskesmas', 'tanggal', 'tahun', 'bulan', 'minggu_ke', 'jml_rw', 'jml_kelurahan', 'jml_rw_melaksanakan', 'jml_kelurahan_melaksanakan', 'jml_rw_melaksanakan_ptp', 'jml_kelurahan_melaksanakan_ptp'];
}