<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    //
    protected $table = "pasien";
    protected $fillable = ['no_rm', 'nama', 'ortu', 'latlong', 'kdesa', 'rtrw', 'alamat', 'alamat_ktp', 'jkl', 'tgl_lahir', 'nama_kontak', 'relasi', 'no_kontak'];

    public function Kasus()
    {
        $this->hasOne(Kasus::class);
    }
}