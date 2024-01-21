@extends('home')

@section('content')
    <h3>Kasus</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Tambah Kasus</h4>
        </div>
        @if (isset($kasus))
            <form id="FormKasus" method="POST" action="{{ route('kasus.update', ['idk' => $kasus->idk]) }}">
                @csrf
                @method('PUT')
            @else
                <form id="FormKasus" method="POST" action="{{ route('kasus.store') }}">
                    @csrf
        @endif
        <div class="card-body">
            <h4>Identitas Pasien</h4>
            <div class="form-group row">
                <label for="no_rm" class="col-md-2">Nomor RM</label>
                <div class="col-md-4">
                    <input type="text" name="no_rm" id="no_rm"
                        class="form-control {{ $errors->has('no_rm') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->no_rm ?? old('no_rm') }}">
                    @if ($errors->has('no_rm'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('no_rm') }}</strong>
                        </div>
                    @endif
                </div>
                <label for="nik" class="col-md-2">NIK</label>
                <div class="col-md-4">
                    <input type="text" name="nik" id="nik"
                        class="form-control {{ $errors->has('nik') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->nik ?? old('nik') }}">
                    @if ($errors->has('nik'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('nik') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-2">Nama Pasien</label>
                <div class="col-md-4">
                    <input type="text" name="nama" id="nama"
                        class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->nama ?? old('nama') }}">
                    @if ($errors->has('nama'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('nama') }}</strong>
                        </div>
                    @endif
                </div>

                <label for="ortu" class="col-md-2">Nama KK</label>
                <div class="col-md-4">
                    <input type="text" name="ortu" id="ortu"
                        class="form-control {{ $errors->has('ortu') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->ortu ?? old('ortu') }}">
                    @if ($errors->has('ortu'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('ortu') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_lahir" class="col-md-2">Tanggal Lahir</label>
                <div class="col-md-4">
                    <input type="text" name="tgl_lahir" id="tgl_lahir"
                        class="form-control {{ $errors->has('tgl_lahir') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->tgl_lahir ?? old('tgl_lahir') }}">
                    @if ($errors->has('tgl_lahir'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('tgl_lahir') }}</strong>
                        </div>
                    @endif
                </div>

                <label for="jkl" class="col-md-2">Jenis Kelamin</label>
                <div class="col-md-4">
                    <select name="jkl" id="jkl"
                        class="form-control {{ $errors->has('jkl') ? 'is-invalid' : '' }}">
                        <option></option>
                        <option value="L"
                            {{ isset($kasus) && $kasus->jkl == 'L' ? 'selected' : (old('jkl') == 'L' ? 'selected' : '') }}>
                            Laki-laki
                        </option>
                        <option value="P"
                            {{ isset($kasus) && $kasus->jkl == 'P' ? 'selected' : (old('jkl') == 'P' ? 'selected' : '') }}>
                            Perempuan
                        </option>
                    </select>
                    @if ($errors->has('jkl'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('jkl') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-md-2">Alamat Domisili</label>
                <div class="col-md-4">
                    <textarea name="alamat" id="alamat" class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}">{{ $kasus->alamat ?? old('alamat') }}</textarea>
                    @if ($errors->has('alamat'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('alamat') }}</strong>
                        </div>
                    @endif
                </div>

                <label for="rtrw" class="col-md-2">RT/RW</label>
                <div class="col-md-4">
                    <input type="text" name="rtrw" id="rtrw"
                        class="form-control {{ $errors->has('rtrw') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->rtrw ?? old('rtrw') }}">
                    @if ($errors->has('rtrw'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('rtrw') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="kdesa" class="col-md-2">Kelurahan</label>
                <div class="col-md-4">
                    <input type="text" name="kdesa" id="kdesa"
                        class="form-control {{ $errors->has('kdesa') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->kdesa ?? old('kdesa') }}">

                    @if ($errors->has('kdesa'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('kdesa') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat_ktp" class="col-md-2">Alamat KTP</label>
                <div class="col-md-4">
                    <textarea name="alamat_ktp" id="alamat_ktp" class="form-control {{ $errors->has('alamat_ktp') ? 'is-invalid' : '' }}">{{ $kasus->alamat_ktp ?? old('alamat_ktp') }}</textarea>
                    @if ($errors->has('alamat_ktp'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('alamat_ktp') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <h4>Contact Person</h4>
            <div class="form-group row">
                <label for="nama_kontak" class="col-md-2">Nama CP</label>
                <div class="col-md-4">
                    <input type="text" name="nama_kontak" id="nama_kontak"
                        class="form-control {{ $errors->has('nama_kontak') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->nama_kontak ?? old('nama_kontak') }}">
                    @if ($errors->has('nama_kontak'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('nama_kontak') }}</strong>
                        </div>
                    @endif
                </div>

                <label for="relasi" class="col-md-2">Hubungan</label>
                <div class="col-md-4">
                    <select name="relasi" id="relasi"
                        class="form-control {{ $errors->has('relasi') ? 'is-invalid' : '' }}">
                        <option></option>
                        <option
                            {{ (isset($kasus) && $kasus->relasi == 'Orangtua' ? 'selected' : old('relasi') == 'Orangtua') ? 'selected' : '' }}>
                            Orangtua</option>
                        <option
                            {{ (isset($kasus) && $kasus->relasi == 'KK' ? 'selected' : old('relasi') == 'KK') ? 'selected' : '' }}>
                            KK</option>
                        <option
                            {{ (isset($kasus) && $kasus->relasi == 'Saudara' ? 'selected' : old('relasi') == 'Saudara') ? 'selected' : '' }}>
                            Saudara</option>
                        <option
                            {{ (isset($kasus) && $kasus->relasi == 'Lain-lain' ? 'selected' : old('relasi') == 'Lain-lain') ? 'selected' : '' }}>
                            Lain-lain</option>
                    </select>
                    @if ($errors->has('relasi'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('relasi') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="no_kontak" class="col-md-2">Nomor Kontak</label>
                <div class="col-md-4">
                    <input type="text" name="no_kontak" id="no_kontak"
                        class="form-control {{ $errors->has('no_kontak') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->no_kontak ?? old('no_kontak') }}">
                </div>
                @if ($errors->has('no_kontak'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('no_kontak') }}</strong>
                    </div>
                @endif
            </div>
            <h4>Kasus</h4>

            <div class="form-group row">
                <label for="rs" class="col-md-2">Tempat Perawatan</label>
                <div class="col-md-4">
                    <input type="text" name="rs" id="rs"
                        class="form-control {{ $errors->has('rs') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->rs ?? old('rs') }}">
                </div>
                @if ($errors->has('rs'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('rs') }}</strong>
                    </div>
                @endif
            </div>
            <div class="form-group row">
                <label for="tgl_rs" class="col-md-2">Tanggal Masuk</label>
                <div class="col-md-4">
                    <input type="text" name="tgl_rs" id="tgl_rs"
                        class="form-control datepicker {{ $errors->has('tgl_rs') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->tgl_rs ?? old('tgl_rs') }}">
                    @if ($errors->has('tgl_rs'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('tgl_rs') }}</strong>
                        </div>
                    @endif
                </div>

                <label for="tgl_sk" class="col-md-2">Tanggal Gejala</label>
                <div class="col-md-4">
                    <input type="text" name="tgl_sk" id="tgl_sk"
                        class="form-control datepicker {{ $errors->has('tgl_sk') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->tgl_sk ?? old('tgl_sk') }}">
                    @if ($errors->has('tgl_sk'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('tgl_sk') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="tegak" class="col-md-2">Tanggal Diagnosa</label>
                <div class="col-md-4">
                    <input type="text" name="tegak" id="tegak"
                        class="form-control datepicker {{ $errors->has('tegak') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->tegak ?? old('tegak') }}">
                    @if ($errors->has('tegak'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('tegak') }}</strong>
                        </div>
                    @endif

                </div>
                <label for="jenis" class="col-md-2">Jenis Penyakit</label>
                <div class="col-md-4">
                    <select name="jenis" id="jenis"
                        class="form-control {{ $errors->has('jenis') ? 'is-invalid' : '' }}">
                        <option></option>
                        <option
                            {{ (isset($kasus) && $kasus->jenis == 'DBD' ? 'selected' : old('jenis') == 'DBD') ? 'selected' : '' }}>
                            DBD</option>
                        <option
                            {{ (isset($kasus) && $kasus->jenis == 'DSS' ? 'selected' : old('jenis') == 'DSS') ? 'selected' : '' }}>
                            DSS</option>
                        <option
                            {{ (isset($kasus) && $kasus->jenis == 'DD' ? 'selected' : old('jenis') == 'DD') ? 'selected' : '' }}>
                            DD
                        </option>
                    </select>
                    @if ($errors->has('jenis'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('jenis') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="kasus" class="col-md-2">Kasus</label>
                <div class="col-md-4">
                    <select name="kasus" id="kasus"
                        class="form-control {{ $errors->has('kasus') ? 'is-invalid' : '' }}">
                        <option></option>
                        <option
                            {{ (isset($kasus) && $kasus->kasus == 'P' ? 'selected' : old('kasus') == 'P') ? 'selected' : '' }}
                            value="P">
                            Penderita</option>
                        <option
                            {{ (isset($kasus) && $kasus->kasus == 'M' ? 'selected' : old('kasus') == 'M') ? 'selected' : '' }}
                            value="M">
                            Meninggal</option>
                    </select>
                    @if ($errors->has('kasus'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('kasus') }}</strong>
                        </div>
                    @endif
                </div>
                <label for="sumber" class="col-md-2">Sumber Data</label>
                <div class="col-md-4">
                    <select name="sumber" id="sumber"
                        class="form-control {{ $errors->has('sumber') ? 'is-invalid' : '' }}">
                        <option></option>
                        <option
                            {{ (isset($kasus) && $kasus->sumber == 'KDRS' ? 'selected' : old('sumber') == 'KDRS') ? 'selected' : '' }}>
                            KDRS</option>
                        <option
                            {{ (isset($kasus) && $kasus->sumber == 'W2' ? 'selected' : old('sumber') == 'W2') ? 'selected' : '' }}>
                            W2</option>
                        <option
                            {{ (isset($kasus) && $kasus->sumber == 'TL' ? 'selected' : old('sumber') == 'TL') ? 'selected' : '' }}>
                            TL</option>
                    </select>
                    @if ($errors->has('sumber'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('sumber') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="panas" class="col-md-2">Panas </label>
                <div class="col-md-4">
                    <select name="panas" id="panas"
                        class="form-control {{ $errors->has('panas') ? 'is-invalid' : '' }}">
                        <option
                            {{ (isset($kasus) && $kasus->panas == 'x' ? 'selected' : old('panas') == 'x') ? 'selected' : '' }}
                            value="x">
                            Tidak Diperiksa</option>
                        <option
                            {{ (isset($kasus) && $kasus->panas == '1' ? 'selected' : old('panas') == '1') ? 'selected' : '' }}
                            value="1">
                            Ya
                        </option>
                        <option
                            {{ (isset($kasus) && $kasus->panas == '0' ? 'selected' : old('panas') == '0') ? 'selected' : '' }}
                            value="0">
                            Tidak</option>
                    </select>
                    @if ($errors->has('panas'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('panas') }}</strong>
                        </div>
                    @endif
                </div>

                <label for="uji_rl" class="col-md-2">Uji RL</label>
                <div class="col-md-4">
                    <select name="uji_rl" id="uji_rl"
                        class="form-control {{ $errors->has('uji_rl') ? 'is-invalid' : '' }}">
                        <option
                            {{ (isset($kasus) && $kasus->uji_rl == 'x' ? 'selected' : old('uji_rl') == 'x') ? 'selected' : '' }}
                            value="x">
                            Tidak Diperiksa</option>
                        <option
                            {{ (isset($kasus) && $kasus->uji_rl == '1' ? 'selected' : old('uji_rl') == '1') ? 'selected' : '' }}
                            value="1">
                            Ya
                        </option>
                        <option
                            {{ (isset($kasus) && $kasus->uji_rl == '0' ? 'selected' : old('uji_rl') == '0') ? 'selected' : '' }}
                            value="0">
                            Tidak</option>
                    </select>
                    @if ($errors->has('uji_rl'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('uji_rl') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="gejala" class="col-md-2">Gejala Lain </label>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" name="gejala[]" type="checkbox" value="Efusi Pleura">
                        <label class="form-check-label">Efusi Pleura</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="gejala[]" type="checkbox" value="Ascites">
                        <label class="form-check-label">Ascites</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="gejala[]" type="checkbox" value="Hipoproteinemia">
                        <label class="form-check-label">Hipoproteinemia</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" name="gejala[]" type="checkbox" value="Hepatomegali">
                        <label class="form-check-label">Hepatomegali</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="gejala[]" type="checkbox" value="Syok">
                        <label class="form-check-label">Syok</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="trombosit_awal" class="col-md-2">Trombosit Awal</label>
                <div class="col-md-4">
                    <input type="text" name="trombosit_awal" id="trombosit_awal"
                        class="form-control {{ $errors->has('trombosit_awal') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->trombosit_awal ?? old('trombosit_awal') }}">
                    @if ($errors->has('trombosit_awal'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('trombosit_awal') }}</strong>
                        </div>
                    @endif
                </div>
                <label for="trombosit_tegak" class="col-md-2">Trombosit Tegak</label>
                <div class="col-md-4">
                    <input type="text" name="trombosit_tegak" id="trombosit_tegak"
                        class="form-control {{ $errors->has('trombosit_tegak') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->trombosit_tegak ?? old('trombosit_tegak') }}">
                    @if ($errors->has('trombosit_tegak'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('trombosit_tegak') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="hb_awal" class="col-md-2">HB Awal</label>
                <div class="col-md-4">
                    <input type="text" name="hb_awal" id="hb_awal"
                        class="form-control {{ $errors->has('hb_awal') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->hb_awal ?? old('hb_awal') }}">
                    @if ($errors->has('hb_awal'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('hb_awal') }}</strong>
                        </div>
                    @endif
                </div>
                <label for="hb_tegak" class="col-md-2">HB Tegak</label>
                <div class="col-md-4">
                    <input type="text" name="hb_tegak" id="hb_tegak"
                        class="form-control {{ $errors->has('hb_tegak') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->hb_tegak ?? old('hb_tegak') }}">
                    @if ($errors->has('hb_tegak'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('hb_tegak') }}</strong>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="ht_awal" class="col-md-2">HT Awal</label>
                <div class="col-md-4">
                    <input type="text" name="ht_awal" id="ht_awal"
                        class="form-control {{ $errors->has('ht_awal') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->ht_awal ?? old('ht_awal') }}">
                    @if ($errors->has('ht_awal'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('ht_awal') }}</strong>
                        </div>
                    @endif
                </div>

                <label for="ht_tegak" class="col-md-2">HT Penegakan</label>
                <div class="col-md-4">
                    <input type="text" name="ht_tegak" id="ht_tegak"
                        class="form-control {{ $errors->has('ht_tegak') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->ht_tegak ?? old('ht_tegak') }}">
                    @if ($errors->has('ht_tegak'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('ht_tegak') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="igg" class="col-md-2">IGG </label>
                <div class="col-md-4">
                    <select name="igg" id="igg"
                        class="form-control {{ $errors->has('igg') ? 'is-invalid' : '' }}">
                        <option
                            {{ (isset($kasus) && $kasus->igg == 'x' ? 'selected' : old('igg') == 'x') ? 'selected' : '' }}>
                            Tidak
                            Diperiksa</option>
                        <option
                            {{ (isset($kasus) && $kasus->igg == '1' ? 'selected' : old('igg') == '1') ? 'selected' : '' }}>
                            Ya
                        </option>
                        <option
                            {{ (isset($kasus) && $kasus->igg == '0' ? 'selected' : old('igg') == '0') ? 'selected' : '' }}>
                            Tidak
                        </option>
                    </select>
                    @if ($errors->has('igg'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('igg') }}</strong>
                        </div>
                    @endif
                </div>

                <label for="igm" class="col-md-2">IGM</label>
                <div class="col-md-4">
                    <select name="igm" id="igm"
                        class="form-control {{ $errors->has('igm') ? 'is-invalid' : '' }}">
                        <option
                            {{ (isset($kasus) && $kasus->igm == 'x' ? 'selected' : old('igm') == 'x') ? 'selected' : '' }}>
                            Tidak
                            Diperiksa</option>
                        <option
                            {{ (isset($kasus) && $kasus->igm == '1' ? 'selected' : old('igm') == '1') ? 'selected' : '' }}>
                            Ya
                        </option>
                        <option
                            {{ (isset($kasus) && $kasus->igm == '0' ? 'selected' : old('igm') == '0') ? 'selected' : '' }}>
                            Tidak
                        </option>
                    </select>
                    @if ($errors->has('igm'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('igm') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="ns1" class="col-md-2">NS 1 </label>
                <div class="col-md-4">
                    <select name="ns1" id="ns1"
                        class="form-control {{ $errors->has('ns1') ? 'is-invalid' : '' }}">
                        <option
                            {{ (isset($kasus) && $kasus->ns1 == 'x' ? 'selected' : old('ns1') == 'x') ? 'selected' : '' }}>
                            Tidak
                            Diperiksa</option>
                        <option
                            {{ (isset($kasus) && $kasus->ns1 == '1' ? 'selected' : old('ns1') == '1') ? 'selected' : '' }}>
                            Ya
                        </option>
                        <option
                            {{ (isset($kasus) && $kasus->ns1 == '0' ? 'selected' : old('ns1') == '0') ? 'selected' : '' }}>
                            Tidak
                        </option>
                    </select>
                    @if ($errors->has('ns1'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('ns1') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="dokter" class="col-md-2">Dokter Pemeriksa</label>
                <div class="col-md-4">
                    <input type="text" name="pemeriksa" id="pemeriksa"
                        class="form-control {{ $errors->has('pemeriksa') ? 'is-invalid' : '' }}"
                        value="{{ $kasus->pemeriksa ?? old('pemeriksa') }}">
                    @if ($errors->has('pemeriksa'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('pemeriksa') }}</strong>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="card-footer">
            <div class="form-group row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
