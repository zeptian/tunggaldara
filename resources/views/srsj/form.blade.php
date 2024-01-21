@extends('home')

@section('content')
    <h3>SRSJ</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Lapor Satu Rumah Satu Jumantik</h4>
        </div>
        <div class="card-body of-scroll">
            @if (!isset($srsj))
                <form action="{{ route('srsj.create') }}" method="post">
                    @csrf
                @else
                    <form action="{{ route('srsj.update', ['id' => $srsj->id]) }}" method="post">
                        @csrf
                        @method('PUT')
            @endif

            <div class="form-group row">
                <label class="col-4 col-md-2">Kode Puskesmas</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="puskesmas" class="form-control" value="{{ Auth::user()->kode }}" readonly />
                </div>
                <label class="col-4 col-md-2">Nama Puskesmas</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="puskesmas" class="form-control" value="{{ Auth::user()->faskes }}"
                        readonly />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Tahun</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="tahun" class="form-control"
                        value="{{ isset($srsj) && $srsj->tahun != '' ? $srsj->tahun : date('Y') }}" />
                </div>
                <label class="col-4 col-md-2">Bulan</label>
                <div class="col-8 col-md-4">
                    <select name="bulan" class="form-control">
                        <option value="01" {{ isset($srsj) && $srsj->bulan == '01' ? 'selected' : '' }}>
                            Januari
                        </option>
                        <option value="02" {{ isset($srsj) && $srsj->bulan == '02' ? 'selected' : '' }}>
                            Februari
                        </option>
                        <option value="03" {{ isset($srsj) && $srsj->bulan == '03' ? 'selected' : '' }}>
                            Maret
                        </option>
                        <option value="04" {{ isset($srsj) && $srsj->bulan == '04' ? 'selected' : '' }}>
                            April
                        </option>
                        <option value="05" {{ isset($srsj) && $srsj->bulan == '05' ? 'selected' : '' }}>
                            Mei
                        </option>
                        <option value="06" {{ isset($srsj) && $srsj->bulan == '06' ? 'selected' : '' }}>
                            Juni
                        </option>
                        <option value="07" {{ isset($srsj) && $srsj->bulan == '07' ? 'selected' : '' }}>
                            Juli
                        </option>
                        <option value="08" {{ isset($srsj) && $srsj->bulan == '08' ? 'selected' : '' }}>
                            Agustus
                        </option>
                        <option value="09" {{ isset($srsj) && $srsj->bulan == '09' ? 'selected' : '' }}>
                            September
                        </option>
                        <option value="10" {{ isset($srsj) && $srsj->bulan == '10' ? 'selected' : '' }}>
                            Oktober
                        </option>
                        <option value="11" {{ isset($srsj) && $srsj->bulan == '11' ? 'selected' : '' }}>
                            November
                        </option>
                        <option value="12" {{ isset($srsj) && $srsj->bulan == '12' ? 'selected' : '' }}>
                            Desember
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Target Lokasi SRSJ</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_target_lokasi" class="form-control"
                        value="{{ old('jml_target_lokasi') ?? ($srsj->jml_target_lokasi ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Total Bangunan Target SRSJ</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_total_bangunan" class="form-control"
                        value="{{ old('jml_total_bangunan') ?? ($srsj->jml_total_bangunan ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Jumantik Rumah yang Menigisi Kartu SRSJ</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_jumantik" class="form-control"
                        value="{{ old('jml_jumantik') ?? ($srsj->jml_jumantik ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Koordinator RT</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_koord" class="form-control"
                        value="{{ old('jml_koord') ?? ($srsj->jml_koord ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">ABJ Jumantik Rumah</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="abj_jumantik" class="form-control"
                        value="{{ old('abj_jumantik') ?? ($srsj->abj_jumantik ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">ABJ Koordinator RT</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="abj_koord" class="form-control"
                        value="{{ old('abj_koord') ?? ($srsj->abj_koord ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">ABJ Tenaga Kesehatan (Puskesmas)</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="abj_nakes" class="form-control"
                        value="{{ old('abj_nakes') ?? ($srsj->abj_nakes ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Kasus DD di Lokasi SRSJ</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_dd" class="form-control"
                        value="{{ old('jml_dd') ?? ($srsj->jml_dd ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Kasus DBD di Lokasi SRSJ</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_dbd" class="form-control"
                        value="{{ old('jml_dbd') ?? ($srsj->jml_dbd ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Kasus DSS di Lokasi SRSJ</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_dss" class="form-control"
                        value="{{ old('jml_dss') ?? ($srsj->jml_dss ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Lampiran</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="lampiran" class="form-control"
                        value="{{ old('lampiran') ?? ($srsj->lampiran ?? '') }}" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-4 col-md-2"></label>
                <div class="col-8 col-md-4">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </div>

            </form>
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('js')
@endsection
