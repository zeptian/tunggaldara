<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pjb extends Model
{
    //    
    protected $table = 'pjb';
    protected $fillable = ['bulan', 'tahun', 'kdesa', 'jml_rumah', 'jml_positif'];
}