<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LapPjn extends Model
{
    //
    protected $table = 'lap_pjn';
    protected $fillable = ['puskesmas', 'tanggal', 'tahun', 'bulan', 'minggu_ke', 'jml_kelurahan', 'jml_kelurahan_melaksanakan'];
}