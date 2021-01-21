<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pe extends Model
{
    //
    protected $table = 'pe';
    protected $fillable = [
        'idpe', 'idk', 'tgl_pe', 'nama_cp', 'telp_cp', 'status_pekerjaan',
        'pekerjaan', 'almt_pekerjaan', 'wilayah', 'c_index', 'cl_panjang', 'perjalanan',
        'jml_pe', 'jml_pos', 'jml_larv', 'panas', 'tdbd', 'dbd', 'dss', 'kesimpulan',
        'fogging'
    ];

    public function pasien()
    {
        $this->hasOne(Pasien::class);
    }
}