@extends('home')

@section('content')
<h3>Kasus</h3>
<hr/>
<div class="card">
    <div class="card-header">
        <h4>Tambah Kasus</h4>
    </div>
    <div class="card-body">
        <form method="POST">
            @csrf
            @if (isset($kasus))
                @method('PUT')
            @endif
            <h4>Identitas Pasien</h4>
            <div class="form-group row">
                <label for="no_rm" class="col-md-2" >Nomor RM</label>
                <div class="col-md-4">
                    <input type="text" name="no_rm" id="no_rm" class="form-control" value="{{$kasus->no_rm??old('no_rm')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-md-2" >Nama Pasien</label>
                <div class="col-md-4">
                    <input type="text" name="nama" id="nama" class="form-control" value="{{$kasus->nama??old('nama')}}">
                </div>
                
                <label for="ortu" class="col-md-2" >Nama KK</label>
                <div class="col-md-4">
                    <input type="text" name="ortu" id="ortu" class="form-control" value="{{$kasus->ortu??old('ortu')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_lahir" class="col-md-2" >Tanggal Lahir</label>
                <div class="col-md-4">
                    <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{$kasus->tgl_lahir??old('tgl_lahir')}}">
                </div>
                
                <label for="jkl" class="col-md-2" >Jenis Kelamin</label>
                <div class="col-md-4">
                    <select name="jkl" id="jkl" class="form-control">
                        <option ></option>
                        <option value="L"  {{isset($kasus)&&$kasus->jkl=='L'?'selected':old('jkl')=='L'?'selected':''}} >Laki-laki</option>
                        <option value="P"  {{isset($kasus)&&$kasus->jkl=='P'?'selected':old('jkl')=='P'?'selected':''}} >Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-md-2" >Alamat Domisili</label>
                <div class="col-md-4">
                    <textarea name="alamat" id="alamat" class="form-control" >{{$kasus->alamat??old('alamat')}}</textarea>
                </div>

                <label for="rtrw" class="col-md-2" >RT/RW</label>
                <div class="col-md-4">
                    <input type="text" name="rtrw" id="rtrw" class="form-control" value="{{$kasus->rtrw??old('rtrw')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="kdesa" class="col-md-2" >Kelurahan</label>
                <div class="col-md-4">
                    <input type="text" name="kdesa" id="kdesa" class="form-control" value="{{$kasus->kdesa??old('kdesa')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat_ktp" class="col-md-2" >Alamat KTP</label>
                <div class="col-md-4">
                    <textarea name="alamat_ktp" id="alamat_ktp" class="form-control" >{{$kasus->alamat_ktp??old('alamat_ktp')}}</textarea>
                </div>
            </div>
            <h4>Contact Person</h4>
            <div class="form-group row">
                <label for="nama_kontak" class="col-md-2" >Nama CP</label>
                <div class="col-md-4">
                    <input type="text" name="nama_kontak" id="nama_kontak" class="form-control" value="{{$kasus->nama_kontak??old('nama_kontak')}}">
                </div>
                
                <label for="relasi" class="col-md-2" >Hubungan</label>
                <div class="col-md-4">
                    <select name="relasi" id="relasi" class="form-control">
                        <option></option>
                        <option {{isset($kasus)&&$kasus->relasi=='Orangtua'?'selected':old('relasi')=='Orangtua'?'selected':''}}>Orangtua</option>
                        <option {{isset($kasus)&&$kasus->relasi=='KK'?'selected':old('relasi')=='KK'?'selected':''}} >KK</option>
                        <option {{isset($kasus)&&$kasus->relasi=='Saudara'?'selected':old('relasi')=='Saudara'?'selected':''}} >Saudara</option>
                        <option {{isset($kasus)&&$kasus->relasi=='Lain-lain'?'selected':old('relasi')=='Lain-lain'?'selected':''}} >Lain-lain</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="no_kontak" class="col-md-2" >Nomor Kontak</label>
                <div class="col-md-4">
                    <input type="text" name="no_kontak" id="no_kontak" class="form-control" value="{{$kasus->no_kontak??old('no_kontak')}}">
                </div>
            </div>
            <h4>Kasus</h4>
            
            <div class="form-group row">
                <label for="rs" class="col-md-2" >Tempat Perawatan</label>
                <div class="col-md-4">
                    <input type="text" name="rs" id="rs" class="form-control" value="{{$kasus->rs??old('rs')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_rs" class="col-md-2" >Tanggal Masuk</label>
                <div class="col-md-4">
                    <input type="text" name="tgl_rs" id="tgl_rs" class="form-control datepicker" value="{{$kasus->tgl_rs??old('tgl_rs')}}">
                </div>
                
                <label for="tgl_sk" class="col-md-2" >Tanggal Gejala</label>
                <div class="col-md-4">
                    <input type="text" name="tgl_sk" id="tgl_sk" class="form-control datepicker" value="{{$kasus->tgl_sk??old('tgl_sk')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="tegak" class="col-md-2" >Tanggal Diagnosa</label>
                <div class="col-md-4">
                    <input type="text" name="tegak" id="tegak" class="form-control datepicker" value="{{$kasus->tegak??old('tegak')}}">
                </div>
                <label for="jenis" class="col-md-2" >Jenis Penyakit</label>
                <div class="col-md-4">
                    <select name="jenis" id="jenis" class="form-control">
                        <option></option>
                        <option {{isset($kasus)&&$kasus->jenis=='DBD'?'selected':old('jenis')=='DBD'?'selected':''}} >DBD</option>
                        <option {{isset($kasus)&&$kasus->jenis=='DSS'?'selected':old('jenis')=='DSS'?'selected':''}} >DSS</option>
                        <option {{isset($kasus)&&$kasus->jenis=='DD'?'selected':old('jenis')=='DD'?'selected':''}} >DD</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">                
                <label for="kasus" class="col-md-2" >Kasus</label>
                <div class="col-md-4">
                    <select name="kasus" id="kasus" class="form-control">
                        <option></option>
                        <option {{isset($kasus)&&$kasus->kasus=='Penderita'?'selected':old('kasus')=='Penderita'?'selected':''}} >Penderita</option>
                        <option {{isset($kasus)&&$kasus->kasus=='Meninggal'?'selected':old('kasus')=='Meninggal'?'selected':''}} >Meninggal</option>
                    </select>
                </div>
                <label for="sumber" class="col-md-2" >Sumber Data</label>
                <div class="col-md-4">
                    <select name="sumber" id="sumber" class="form-control">
                        <option></option>
                        <option {{isset($kasus)&&$kasus->sumber=='KDRS'?'selected':old('sumber')=='KDRS'?'selected':''}} >KDRS</option>
                        <option {{isset($kasus)&&$kasus->sumber=='W2'?'selected':old('sumber')=='W2'?'selected':''}} >W2</option>
                        <option {{isset($kasus)&&$kasus->sumber=='TL'?'selected':old('sumber')=='TL'?'selected':''}} >TL</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="panas" class="col-md-2" >Panas </label>
                <div class="col-md-4">
                    <select name="panas" id="panas" class="form-control">
                        <option {{isset($kasus)&&$kasus->panas=='x'?'selected':old('panas')=='x'?'selected':''}} >Tidak Diperiksa</option>
                        <option {{isset($kasus)&&$kasus->panas=='1'?'selected':old('panas')=='1'?'selected':''}} >Ya</option>
                        <option {{isset($kasus)&&$kasus->panas=='0'?'selected':old('panas')=='0'?'selected':''}} >Tidak</option>
                    </select>
                </div>
                
                <label for="uji_rl" class="col-md-2" >Uji RL</label>
                <div class="col-md-4">
                    <select name="uji_rl" id="uji_rl" class="form-control">
                        <option {{isset($kasus)&&$kasus->uji_rl=='x'?'selected':old('uji_rl')=='x'?'selected':''}} >Tidak Diperiksa</option>
                        <option {{isset($kasus)&&$kasus->uji_rl=='1'?'selected':old('uji_rl')=='1'?'selected':''}} >Ya</option>
                        <option {{isset($kasus)&&$kasus->uji_rl=='0'?'selected':old('uji_rl')=='0'?'selected':''}} >Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="gejala" class="col-md-2" >Gejala Lain </label>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Efusi Pleura">
                        <label class="form-check-label">Efusi Pleura</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Ascites">
                        <label class="form-check-label">Ascites</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Hipoproteinemia">
                        <label class="form-check-label">Hipoproteinemia</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Hepatomegali">
                        <label class="form-check-label">Hepatomegali</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Syok">
                        <label class="form-check-label">Syok</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="trombosit" class="col-md-2" >Trombosit</label>
                <div class="col-md-4">
                    <input type="text" name="trombosit" id="trombosit" class="form-control datepicker" value="{{$kasus->trombosit??old('trombosit')}}">
                </div>
                
                <label for="hb_tegak" class="col-md-2" >HB Tegak</label>
                <div class="col-md-4">
                    <input type="text" name="hb_tegak" id="hb_tegak" class="form-control datepicker" value="{{$kasus->hb_tegak??old('hb_tegak')}}">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="ht_awal" class="col-md-2" >HT Awal</label>
                <div class="col-md-4">
                    <input type="text" name="ht_awal" id="ht_awal" class="form-control datepicker" value="{{$kasus->ht_awal??old('ht_awal')}}">
                </div>
                
                <label for="ht_tegak" class="col-md-2" >HT Penegakan</label>
                <div class="col-md-4">
                    <input type="text" name="ht_tegak" id="ht_tegak" class="form-control datepicker" value="{{$kasus->ht_tegak??old('ht_tegak')}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="igg" class="col-md-2" >IGG </label>
                <div class="col-md-4">
                    <select name="igg" id="igg" class="form-control">
                        <option {{isset($kasus)&&$kasus->igg=='x'?'selected':old('igg')=='x'?'selected':''}} >Tidak Diperiksa</option>
                        <option {{isset($kasus)&&$kasus->igg=='1'?'selected':old('igg')=='1'?'selected':''}} >Ya</option>
                        <option {{isset($kasus)&&$kasus->igg=='0'?'selected':old('igg')=='0'?'selected':''}} >Tidak</option>
                    </select>
                </div>
                
                <label for="igm" class="col-md-2" >IGM</label>
                <div class="col-md-4">
                    <select name="igm" id="igm" class="form-control">
                        <option {{isset($kasus)&&$kasus->igm=='x'?'selected':old('igm')=='x'?'selected':''}} >Tidak Diperiksa</option>
                        <option {{isset($kasus)&&$kasus->igm=='1'?'selected':old('igm')=='1'?'selected':''}} >Ya</option>
                        <option {{isset($kasus)&&$kasus->igm=='0'?'selected':old('igm')=='0'?'selected':''}} >Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="ns1" class="col-md-2" >NS 1 </label>
                <div class="col-md-4">
                    <select name="ns1" id="ns1" class="form-control">
                        <option {{isset($kasus)&&$kasus->ns1=='x'?'selected':old('ns1')=='x'?'selected':''}} >Tidak Diperiksa</option>
                        <option {{isset($kasus)&&$kasus->ns1=='1'?'selected':old('ns1')=='1'?'selected':''}} >Ya</option>
                        <option {{isset($kasus)&&$kasus->ns1=='0'?'selected':old('ns1')=='0'?'selected':''}} >Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="dokter" class="col-md-2" >Dokter Pemeriksa</label>
                <div class="col-md-4">
                    <input type="text" name="pemeriksa" id="pemeriksa" class="form-control datepicker" value="{{$kasus->pemeriksa??old('pemeriksa')}}">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection