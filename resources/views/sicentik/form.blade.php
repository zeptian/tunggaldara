@extends('home')

@section('content')
    <h3>Lapran SiCentik</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap Laporan SiCentik</h4>
        </div>
        <div class="card-body of-scroll">
            @if (!isset($sicentik))
                <form action="{{ route('sicentik.create') }}" method="post">
                    @csrf
                @else
                    <form action="{{ route('sicentik.update', ['id' => $sicentik->id_sicentik]) }}" method="post">
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
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            @endif
            <div class="form-group row">
                <label class="col-4 col-md-2">Tahun</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="tahun" class="form-control"
                        value="{{ isset($sicentik) && $sicentik->tahun != '' ? $sicentik->tahun : date('Y') }}" />
                </div>
                <label class="col-4 col-md-2">Bulan</label>
                <div class="col-8 col-md-4">
                    <select name="bulan" class="form-control">
                        <option value="01" {{ isset($sicentik) && $sicentik->bulan == '01' ? 'selected' : '' }}>
                            Januari
                        </option>
                        <option value="02" {{ isset($sicentik) && $sicentik->bulan == '02' ? 'selected' : '' }}>
                            Februari
                        </option>
                        <option value="03" {{ isset($sicentik) && $sicentik->bulan == '03' ? 'selected' : '' }}>
                            Maret
                        </option>
                        <option value="04" {{ isset($sicentik) && $sicentik->bulan == '04' ? 'selected' : '' }}>
                            April
                        </option>
                        <option value="05" {{ isset($sicentik) && $sicentik->bulan == '05' ? 'selected' : '' }}>
                            Mei
                        </option>
                        <option value="06" {{ isset($sicentik) && $sicentik->bulan == '06' ? 'selected' : '' }}>
                            Juni
                        </option>
                        <option value="07" {{ isset($sicentik) && $sicentik->bulan == '07' ? 'selected' : '' }}>
                            Juli
                        </option>
                        <option value="08" {{ isset($sicentik) && $sicentik->bulan == '08' ? 'selected' : '' }}>
                            Agustus
                        </option>
                        <option value="09" {{ isset($sicentik) && $sicentik->bulan == '09' ? 'selected' : '' }}>
                            September
                        </option>
                        <option value="10" {{ isset($sicentik) && $sicentik->bulan == '10' ? 'selected' : '' }}>
                            Oktober
                        </option>
                        <option value="11" {{ isset($sicentik) && $sicentik->bulan == '11' ? 'selected' : '' }}>
                            November
                        </option>
                        <option value="12" {{ isset($sicentik) && $sicentik->bulan == '12' ? 'selected' : '' }}>
                            Desember
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah sekolah sasaran SiCentik</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="sasaran_sekolah" class="form-control"
                        value="{{ old('sasaran_sekolah') ?? ($sicentik->sasaranSekolah ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah sekolah yang melakukan Sicentik</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="real_sekolah" class="form-control"
                        value="{{ old('real_sekolah') ?? ($sicentik->realSekolah ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Sekolah yang dipantau jentik oleh Puskesmas</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="sekolah_pantau" class="form-control"
                        value="{{ old('sekolah_pantau') ?? ($sicentik->sekolahPantau ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Sekolah yang Positif jentik</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="sekolah_positif" class="form-control"
                        value="{{ old('sekolah_positif') ?? ($sicentik->sekolahPositif ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Sekolah yang termonev oleh Puskesmas</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="sekolah_monev" class="form-control"
                        value="{{ old('sekolah_monev') ?? ($sicentik->sekolahMonev ?? '') }}" />
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
