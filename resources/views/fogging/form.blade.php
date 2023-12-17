@extends('home')

@section('content')
    <h5>Fogging</h5>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Fogging Fokus</h4>
        </div>
        @if (isset($fogging))
            <form id="FormFogging" method="POST"
                action="{{ route('fogging.update', ['idpe' => $pasien->idpe, 'fogging' => $fogging->id]) }}">
                @csrf
                @method('PUT')
            @else
                <form id="FormFogging" method="POST" action="{{ route('fogging.store', ['idpe' => $pasien->idpe]) }}">
                    @csrf
        @endif
        <div class="card-body">
            <h4>Identitas Pasien</h4>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-4 col-md-2">Nama</label>
                    <div class="col-8 col-md-4">
                        {{ $pasien->pasien->nama }}
                    </div>
                    <label class="col-4 col-md-2">NIK</label>
                    <div class="col-8 col-md-4">
                        {{ $pasien->pasien->nik }}
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-2">Nama KK</label>
                    <div class="col-8 col-md-4">
                        {{ $pasien->pasien->ortu }}
                    </div>
                    <label class="col-4 col-md-2">Alamat</label>
                    <div class="col-8 col-md-4">
                        {{ $pasien->pasien->alamat . ' ' . $pasien->pasien->rtrw . ' ' . $pasien->pasien->kdesa }}
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="col-4 col-md-3">
                        <h5>Fogging</h5>
                    </label>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-3">Id PE</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="idpe"
                            class="form-control {{ $errors->has('idpe') ? 'is-invalid' : '' }}"
                            value="{{ $fogging->idpe ?? old('idpe') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-3">Tanggal Instruksi</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="tgl_instruksi" class="form-control datepicker"
                            value="{{ isset($fogging->tgl_pe) && date('d-m-Y', strtotime($fogging->tgl_pe)) ?? date('d-m-Y') }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-8 col-md-3">Pembiayaan</label>
                    <div class="col-8 col-md-4">
                        <select name="pembiayaan" class="form-control {{ $errors->has('pembiayaan') ? 'is-invalid' : '' }}">
                            <option></option>
                            <option {{ isset($fogging->pembiayaan) && $fogging->pembiayaan == 'APBD1' ? 'selected' : '' }}>
                                APBD1 </option>
                            <option {{ isset($fogging->pembiayaan) && $fogging->pembiayaan == 'APBD2' ? 'selected' : '' }}>
                                APBD2 </option>
                            <option
                                {{ isset($fogging->pembiayaan) && $fogging->pembiayaan == 'Bantuan' ? 'selected' : '' }}>
                                Bantuan </option>
                            <option
                                {{ isset($fogging->pembiayaan) && $fogging->pembiayaan == 'Swadaya' ? 'selected' : '' }}>
                                Swadaya </option>

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-8 col-md-3">Pelaksana</label>
                    <div class="col-8 col-md-4">
                        <input type="text" name="pelaks"
                            class="form-control {{ $errors->has('pelaks') ? 'is-invalid' : '' }}"
                            value="{{ $fogging->pelaks ?? old('pelaks') }}" />
                    </div>
                </div>


                <div class="form-group row">
                    <label for="nama" class="col-4 col-md-3">
                        <h5>Lokasi Fogging</h5>
                    </label>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-3">Kelurahan</label>
                    <div class="col-8 col-md-3">
                        <select name="kdesa"
                            class="form-control select2 {{ $errors->has('nama_cp') ? 'is-invalid' : '' }}">
                            <option></option>
                            @foreach ($kelurahan as $item)
                                <option {{ isset($fogging->kdesa) && $fogging->kdesa == $item->kode ? 'selected' : '' }}
                                    value="{{ $item->kode }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label class="col-4 col-md-3">RT/RW</label>
                    <div class="col-8 col-md-3">
                        <input type="text" name="rtrw"
                            class="form-control {{ $errors->has('rtrw') ? 'is-invalid' : '' }}"
                            value="{{ $fogging->rtrw ?? old('rtrw') }}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4 col-md-3">Bahan Aktif</label>
                    <div class="col-8 col-md-3">
                        <input type="text" name="bahan"
                            class="form-control {{ $errors->has('bahan') ? 'is-invalid' : '' }}"
                            value="{{ $fogging->bahan ?? old('bahan') }}" />
                    </div>
                    <label class="col-4 col-md-3">Merek</label>
                    <div class="col-8 col-md-3">
                        <input type="text" name="merk"
                            class="form-control {{ $errors->has('merk') ? 'is-invalid' : '' }}"
                            value="{{ $fogging->merk ?? old('merk') }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="nama" class="col-4 col-md-3">
                                <h5>Sikus Pertama</h5>
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-md-6">Tanggal</label>
                            <div class="col-8 col-md-6">
                                <input type="text" name="tgl1"
                                    class="form-control datepicker {{ $errors->has('tgl1') ? 'is-invalid' : '' }}"
                                    value="{{ isset($fogging->tgl1) && date('d-m-Y', strtotime($fogging->tgl1)) ?? old('tgl1') }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-md-6">Volume Obat yang digunakan</label>
                            <div class="col-8 col-md-6">
                                <input type="text" name="liter1"
                                    class="form-control {{ $errors->has('liter1') ? 'is-invalid' : '' }}"
                                    value="{{ $fogging->liter1 ?? old('liter1') }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-md-6">Jumlah Rumah yang di fogging</label>
                            <div class="col-8 col-md-6">
                                <input type="text" name="jml_rumah1"
                                    class="form-control {{ $errors->has('jml_rumah1') ? 'is-invalid' : '' }}"
                                    value="{{ $fogging->jml_rumah1 ?? old('jml_rumah1') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">

                        <div class="form-group row">
                            <label for="nama" class="col-4 col-md-3">
                                <h5>Sikus Kedua</h5>
                            </label>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-md-6">Tanggal</label>
                            <div class="col-8 col-md-6">
                                <input type="text" name="tgl2"
                                    class="form-control datepicker {{ $errors->has('tgl2') ? 'is-invalid' : '' }}"
                                    value="{{ isset($fogging->tgl2) && date('d-m-Y', strtotime($fogging->tgl2)) ?? old('tgl2') }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-md-6">Volume Obat yang digunakan</label>
                            <div class="col-8 col-md-6">
                                <input type="text" name="liter2"
                                    class="form-control {{ $errors->has('liter2') ? 'is-invalid' : '' }}"
                                    value="{{ $fogging->liter2 ?? old('liter2') }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-8 col-md-6">Jumlah Rumah yang di fogging</label>
                            <div class="col-8 col-md-6">
                                <input type="text" name="jml_rumah2"
                                    class="form-control {{ $errors->has('jml_rumah2') ? 'is-invalid' : '' }}"
                                    value="{{ $fogging->jml_rumah2 ?? old('jml_rumah2') }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-8 col-md-3">Total Rumah yang di fogging</label>
                    <div class="col-8 col-md-3">
                        <input type="text" name="total_rumah"
                            class="form-control {{ $errors->has('total_rumah') ? 'is-invalid' : '' }}"
                            value="{{ $fogging->total_rumah ?? old('total_rumah') }}" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-4 col-md-3"></label>
                    <div class="col-8 col-md-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
