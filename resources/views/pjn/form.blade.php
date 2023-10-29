@extends('home')

@section('content')
    <h3>PJN</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Lapor Pemberantasan Jentik Nyamuk</h4>
        </div>
        <div class="card-body of-scroll">
            @if (!isset($pjn))
                <form action="{{ route('pjn.create') }}" method="post">
                    @csrf
                @else
                    <form action="{{ route('pjn.update', ['id' => $pjn->id]) }}" method="post">
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
                        value="{{ isset($pjn) && $pjn->tahun != '' ? $pjn->tahun : date('Y') }}" />
                </div>
                <label class="col-4 col-md-2">Bulan</label>
                <div class="col-8 col-md-4">
                    <select name="bulan" class="form-control">
                        <option value="01" {{ isset($pjn) && $pjn->bulan == '01' ? 'selected' : '' }}>
                            Januari
                        </option>
                        <option value="02" {{ isset($pjn) && $pjn->bulan == '02' ? 'selected' : '' }}>
                            Februari
                        </option>
                        <option value="03" {{ isset($pjn) && $pjn->bulan == '03' ? 'selected' : '' }}>
                            Maret
                        </option>
                        <option value="04" {{ isset($pjn) && $pjn->bulan == '04' ? 'selected' : '' }}>
                            April
                        </option>
                        <option value="05" {{ isset($pjn) && $pjn->bulan == '05' ? 'selected' : '' }}>
                            Mei
                        </option>
                        <option value="06" {{ isset($pjn) && $pjn->bulan == '06' ? 'selected' : '' }}>
                            Juni
                        </option>
                        <option value="07" {{ isset($pjn) && $pjn->bulan == '07' ? 'selected' : '' }}>
                            Juli
                        </option>
                        <option value="08" {{ isset($pjn) && $pjn->bulan == '08' ? 'selected' : '' }}>
                            Agustus
                        </option>
                        <option value="09" {{ isset($pjn) && $pjn->bulan == '09' ? 'selected' : '' }}>
                            September
                        </option>
                        <option value="10" {{ isset($pjn) && $pjn->bulan == '10' ? 'selected' : '' }}>
                            Oktober
                        </option>
                        <option value="11" {{ isset($pjn) && $pjn->bulan == '11' ? 'selected' : '' }}>
                            November
                        </option>
                        <option value="12" {{ isset($pjn) && $pjn->bulan == '12' ? 'selected' : '' }}>
                            Desember
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Minggu Ke</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="minggu_ke" class="form-control"
                        value="{{ old('minggu_ke') ?? ($pjn->minggu_ke ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Desa</label>
                <div class="col-8 col-md-4">
                    <select name="kdesa" class="form-control">
                        <option></option>
                        @foreach ($desa as $item)
                            <option value="{{ $item->kode }}"
                                {{ old('kdesa') == $item->kode ? 'selected' : (isset($pjn) && $pjn->kdesa == $item->kode ? 'selected' : '') }}>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <label class="col-4 col-md-2">RT / RW</label>
                <div class="col-4 col-md-2">
                    <input type="number" name="rt" class="form-control"
                        value="{{ old('rt') ?? ($pjn->rt ?? '') }}" />
                </div>
                <div class="col-4 col-md-2">
                    <input type="number" name="rw" class="form-control"
                        value="{{ old('rw') ?? ($pjn->rw ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Rumah Di Pantau</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_rumah" class="form-control"
                        value="{{ old('jml_rumah') ?? ($pjn->jml_rumah ?? '') }}" />
                </div>
                <label class="col-4 col-md-2">Jumlah Rumah Positif</label>
                <div class="col-8 col-md-4">
                    <input type="number" name="jml_positif" class="form-control"
                        value="{{ old('jml_positif') ?? ($pjn->jml_positif ?? '') }}" />
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
