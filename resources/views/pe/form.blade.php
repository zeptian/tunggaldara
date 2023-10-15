@extends('home')

@section('content')
    <h3>Kasus</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Penyelidikan Epidemiologi</h4>
        </div>
        @if (isset($pe))
            <form id="FormPE" method="POST" action="{{ route('pe.update', ['idk' => $pasien->idk, 'pe' => $pe->id]) }}">
                @csrf
                @method('PUT')
            @else
                <form id="FormPE" method="POST" action="{{ route('pe.store', ['idk' => $pasien->idk]) }}">
                    @csrf
        @endif
        <div class="card-body">
            <h4>Identitas Pasien</h4>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-4 col-md-2">Nama</label>
                    <div class="col-8 col-md-4">
                        {{ $pasien->nama }}
                    </div>
                    <label class="col-4 col-md-2">NIK</label>
                    <div class="col-8 col-md-4">
                        {{ $pasien->nik }}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Nama KK</label>
                    <div class="col-8 col-md-4">
                        {{ $pasien->ortu }}
                    </div>
                    <label class="col-4 col-md-2">Alamat</label>
                    <div class="col-8 col-md-4">
                        {{ $pasien->alamat . ' ' . $pasien->rtrw . ' ' . $pasien->kdesa }}
                        {{ $errors }}
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="col-4 col-md-2">Form Penyelidikan Epidemiologi</label>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Id PE</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="idpe"
                            class="form-control {{ $errors->has('idpe') ? 'is-invalid' : '' }}"
                            value="{{ $pe->idpe ?? old('idpe') }}" />
                    </div>
                    <label class="col-4 col-md-2">Tanggal PE</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="tgl_pe" class="form-control" value="{{ $pe->tgl_pe ?? date('d-m-Y') }}"
                            readonly />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Nama Kontak Person</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="nama_cp"
                            class="form-control {{ $errors->has('nama_cp') ? 'is-invalid' : '' }}"
                            value="{{ $pe->nama_cp ?? old('nama_cp') }}" />
                    </div>
                    <label class="col-4 col-md-2">No Telp</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="telp_cp"
                            class="form-control {{ $errors->has('telp_cp') ? 'is-invalid' : '' }}"
                            value="{{ $pe->telp_cp ?? old('telp_cp') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Sekolah/Pekerjaan</label>
                    <div class="col-8 col-md-4">
                        <select name="status_pekerjaan"
                            class="form-control {{ $errors->has('status_pekerjaan') ? 'is-invalid' : '' }}">
                            <option></option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'Belum Sekolah') || old('status_pekerjaan') == 'Belum Sekolah' ? 'selected' : '' }}>
                                Belum Sekolah
                            </option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'Pengangguran') || old('status_pekerjaan') == 'Pengangguran' ? 'selected' : '' }}>
                                Pengangguran
                            </option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'SD') || old('status_pekerjaan') == 'SD' ? 'selected' : '' }}>
                                SD
                            </option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'SMP') || old('status_pekerjaan') == 'SMP' ? 'selected' : '' }}>
                                SMP
                            </option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'SMA') || old('status_pekerjaan') == 'SMA' ? 'selected' : '' }}>
                                SMA
                            </option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'Kuliah') || old('status_pekerjaan') == 'Kuliah' ? 'selected' : '' }}>
                                Kuliah
                            </option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'Kerja') || old('status_pekerjaan') == 'Kerja' ? 'selected' : '' }}>
                                Kerja
                            </option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'IRT') || old('status_pekerjaan') == 'IRT' ? 'selected' : '' }}>
                                IRT
                            </option>
                            <option
                                {{ (isset($pe) && $pe->status_pekerjaan == 'Lain-lain') || old('status_pekerjaan') == 'Lain-lain' ? 'selected' : '' }}>
                                Lain-lain
                            </option>
                        </select>
                    </div>
                    <label class="col-4 col-md-2">Menggunakan Celana Panjang</label>
                    <div class="col-8 col-md-4">
                        <select name="cl_panjang"
                            class="form-control {{ $errors->has('cl_panjang') ? 'is-invalid' : '' }}">
                            <option
                                {{ (isset($pe) && $pe->cl_panjang == 'Y') || old('cl_panjang') == 'Y' ? 'selected' : '' }}>
                                Ya</option>
                            <option
                                {{ (isset($pe) && $pe->cl_panjang == 'T') || old('cl_panjang') == 'T' ? 'selected' : '' }}>
                                Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Nama Pekerjaan</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="pekerjaan"
                            class="form-control {{ $errors->has('pekerjaan') ? 'is-invalid' : '' }}"
                            value="{{ $pe->pekerjaan ?? old('pekerjaan') }}" />
                    </div>
                    <label class="col-4 col-md-2">Alamat Sekolah / Kantor</label>
                    <div class="col-8 col-md-4">
                        <textarea name="almt_pekerjaan" class="form-control {{ $errors->has('almt_pekerjaan') ? 'is-invalid' : '' }}">{{ $pe->almt_pekerjaan ?? old('almt_pekerjaan') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Wilayah Kerja</label>
                    <div class="col-8 col-md-4">
                        <select name="wilayah" class="form-control {{ $errors->has('wilayah') ? 'is-invalid' : '' }}">
                            <option></option>
                            <option value="D"
                                {{ (isset($pe) && $pe->wilayah == 'D') || old('wilayah') == 'D' ? 'selected' : '' }}>
                                Dalam Wilayah</option>
                            <option value="L"
                                {{ (isset($pe) && $pe->wilayah == 'L') || old('wilayah') == 'L' ? 'selected' : '' }}>
                                Luar Wilayah</option>
                        </select>
                    </div>
                    <label class="col-4 col-md-2">Container Index</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="c_index"
                            class="form-control {{ $errors->has('c_index') ? 'is-invalid' : '' }}"
                            value="{{ $pe->c_index ?? old('c_index') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Melakukan penjalanan 3 minggu terakhir</label>
                    <div class="col-8 col-md-4">
                        <select name="perjalanan"
                            class="form-control {{ $errors->has('perjalanan') ? 'is-invalid' : '' }}">
                            <option></option>
                            <option
                                {{ (isset($pe) && $pe->perjalanan == 'Y') || old('perjalanan') == 'Y' ? 'selected' : '' }}>
                                Ya</option>
                            <option
                                {{ (isset($pe) && $pe->perjalanan == 'T') || old('perjalanan') == 'T' ? 'selected' : '' }}>
                                TIdak</option>
                        </select>
                    </div>
                    <label class="col-4 col-md-2">Frekuensi pemeriksaan sebelum penegakan kasus</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="frekuensi"
                            class="form-control {{ $errors->has('frekuensi') ? 'is-invalid' : '' }}"
                            value="{{ $pe->frekuensi ?? old('frekuensi') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12 col-md-12"><strong>Pemeriksaan Jentik</strong></label>
                    <label class="col-4 col-md-2">Jumlah Rumah Diperiksa</label>
                    <div class="col-8 col-md-4">
                        <input type="number" min="0" name="jml_pe"
                            class="form-control {{ $errors->has('jml_pe') ? 'is-invalid' : '' }}"
                            value="{{ $pe->jml_pe ?? old('jml_pe') }}" />
                    </div>
                    <label class="col-4 col-md-2">Jumlah Rumah Positif</label>
                    <div class="col-8 col-md-4">
                        <input type="number" min="0" name="jml_pos"
                            class="form-control {{ $errors->has('jml_pos') ? 'is-invalid' : '' }}"
                            value="{{ $pe->jml_pos ?? old('jml_pos') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Jumlah Rumah Diberi Larvasida</label>
                    <div class="col-8 col-md-4">
                        <input type="number" min="0" name="jml_larv"
                            class="form-control {{ $errors->has('jml_larv') ? 'is-invalid' : '' }}"
                            value="{{ $pe->jml_larv ?? old('jml_larv') }}" />
                    </div>
                    <label class="col-4 col-md-2">Jumlah Larvasida digunakan</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="liter_larv"
                            class="form-control {{ $errors->has('liter_larv') ? 'is-invalid' : '' }}"
                            value="{{ $pe->liter_larv ?? old('liter_larv') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12 col-md-12"><strong>Kasus Tambahan</strong></label>
                    <label class="col-4 col-md-2">Jumlah Kasus Panas</label>
                    <div class="col-8 col-md-4">
                        <input type="number" min="0" name="panas"
                            class="form-control {{ $errors->has('panas') ? 'is-invalid' : '' }}"
                            value="{{ $pe->panas ?? old('panas') }}" />
                    </div>
                    <label class="col-4 col-md-2">Jumlah Kasus DD</label>
                    <div class="col-8 col-md-4">
                        <input type="number" min="0" name="tdbd"
                            class="form-control {{ $errors->has('tdbd') ? 'is-invalid' : '' }}"
                            value="{{ $pe->tdbd ?? old('tdbd') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Jumlah Kasus DBD</label>
                    <div class="col-8 col-md-4">
                        <input type="number" min="0" name="dbd"
                            class="form-control {{ $errors->has('dbd') ? 'is-invalid' : '' }}"
                            value="{{ $pe->dbd ?? old('dbd') }}" />
                    </div>
                    <label class="col-4 col-md-2">Jumlah Kasus DSS</label>
                    <div class="col-8 col-md-4">
                        <input type="number" min="0" name="dss"
                            class="form-control {{ $errors->has('dss') ? 'is-invalid' : '' }}"
                            value="{{ $pe->dss ?? old('dss') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2"></label>
                    <div class="col-8 col-md-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    @endsection
