<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    //    
    protected $table = "kasus";
    protected $fillable = ['no_rm', 'nama', 'ortu', 'latlong', 'kdesa', 'rtrw', 'alamat', 'alamat_ktp', 'jkl', 'tgl_lahir', 'nama_kontak', 'relasi', 'no_kontak'];

    public function Pasien()
    {
        return $this->hasOne(Pasien::class);
    }
}