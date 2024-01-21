<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sicentik extends Model
{
    //
    protected $table = 'sicentik';
    protected $primaryKey = 'id_sicentik';
    protected $fillable = ['bulan', 'tahun', 'puskesmas', 'sasaranSekolah', 'realSekolah', 'sekolahPantau', 'sekolahPositif', 'user'];
}