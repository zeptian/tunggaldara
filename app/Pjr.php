<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pjr extends Model
{
    //
    protected $table = 'pjr';
    protected $fillable = ['tanggal', 'minggu_ke', 'bulan', 'tahun', 'rt', 'rw', 'kdesa', 'jml_rumah', 'jml_positif', 'info_tersangka', 'no_pengirim'];
}