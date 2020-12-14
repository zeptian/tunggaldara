<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pjn extends Model
{
    //
    protected $table = 'pjn';
    protected $fillable = ['minggu_ke', 'bulan', 'tahun', 'rt', 'rw', 'kdesa', 'jml_rumah', 'jml_positif'];
}