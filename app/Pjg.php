<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pjg extends Model
{
    //
    protected $table = 'pjg';
    protected $fillable = ['puskesmas', 'tanggal', 'tahun', 'bulan', 'minggu_ke', 'jml_rumah', 'jml_positif', 'larvasida', 'jml_penyuluhan'];
}