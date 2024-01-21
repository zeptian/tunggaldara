<?php

use App\Kecamatan;
use App\Kelurahan;
use App\Puskesmas;

if (!function_exists('kelurahan')) {
    function kelurahan($kode)
    {
        $kelurahan = Kelurahan::select('nama')->where('kode', $kode)->first();
        if (isset($kelurahan->nama)) {
            return $kelurahan->nama;
        } else {
            return $kode;
        }
    }
}

if (!function_exists('kecamatan')) {
    function kecamatan($kode)
    {
        $kecamatan = Kecamatan::select('nama')->where('kode', $kode)->first();
        if (isset($kecamatan->nama)) {
            return $kecamatan->nama;
        } else {
            return $kode;
        }
    }
}

if (!function_exists('puskesmas')) {
    function puskesmas($kode)
    {
        $puskesmas = Puskesmas::select('nama')->where('kode', $kode)->first();
        if (isset($puskesmas->nama)) {
            return $puskesmas->nama;
        } else {
            return $kode;
        }
    }
}
