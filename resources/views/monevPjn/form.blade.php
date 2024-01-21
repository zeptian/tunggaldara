@extends('home')

@section('content')
    <h3>Lapran Monev Pemantauan Jentik</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Lapor Monev PJN</h4>
        </div>
        <div class="card-body of-scroll">
            @if (!isset($monevPjn))
                <form action="{{ route('monev_pjn.create') }}" method="post">
                    @csrf
                @else
                    <form action="{{ route('monev_pjn.update', ['id' => $monevPjn->id]) }}" method="post">
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
                <label class="col-4 col-md-2">Tanggal Lapor</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="tgl_lapor" class="form-control"
                        value="{{ isset($monevPjn) && $monevPjn->tgl_lapor != '' ? $monevPjn->tgl_lapor : date('Y-m-d') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Kelurahan</label>
                <div class="col-8 col-md-4">
                    <select name="kelurahan" class="form-control">
                        @foreach ($kelurahan as $item)
                            <option value="{{ $item->kode }}"
                                {{ isset($monevPjn) && $monevPjn->kelurahan == $item->kode ? 'selected' : '' }}>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">RW</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="rw" class="form-control"
                        value="{{ old('rw') ?? ($monevPjn->rw ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Bangunan Dipantau Jentik</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="bangunan_pantau" class="form-control"
                        value="{{ old('bangunan_pantau') ?? ($monevPjn->bangunan_pantau ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Bangunan Positif (+) Jentik</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="bangunan_positif" class="form-control"
                        value="{{ old('bangunan_positif') ?? ($monevPjn->bangunan_positif ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">ABJ</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="abj" class="form-control" value="" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Kontainer dalam Bangunan Diperiksa </label>
                <div class="col-8 col-md-4">
                    <input type="text" name="kontainer_dalam_periksa" class="form-control"
                        value="{{ old('kontainer_dalam_periksa') ?? ($monevPjn->kontainer_dalam_periksa ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Kontainer dalam Bangunan Positif (+) Jentik</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="kontainer_dalam_positif" class="form-control"
                        value="{{ old('kontainer_dalam_positif') ?? ($monevPjn->kontainer_dalam_positif ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Kontainer Luar Bangunan Diperiksa</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="kontainer_luar_periksa" class="form-control"
                        value="{{ old('kontainer_luar_periksa') ?? ($monevPjn->kontainer_luar_periksa ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Kontainer luar Bangunan Positif (+) Jentik</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="kontainer_luar_positif" class="form-control"
                        value="{{ old('kontainer_luar_positif') ?? ($monevPjn->kontainer_luar_positif ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Bangunan Pasang Perangkap Tikus</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="perangkap_tikus" class="form-control"
                        value="{{ old('perangkap_tikus') ?? ($monevPjn->perangkap_tikus ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah Tikus Tertangkap</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="tikus_tertangkap" class="form-control"
                        value="{{ old('tikus_tertangkap') ?? ($monevPjn->tikus_tertangkap ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jumlah larvasida (gr)</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="larvasida" class="form-control"
                        value="{{ old('larvasida') ?? ($monevPjn->larvasida ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Ada Apel sebelum Kegiatan</label>
                <div class="col-8 col-md-4">
                    <select name="apel" class="form-control">
                        <option>Tidak</option>
                        <option {{ isset($monevPjn) && $monevPjn->apel == 'Ada' ? 'selected' : '' }}>Ada</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Pimpinan PSN Serentak</label>
                <div class="col-8 col-md-4">
                    <select name="pimpinan_pjn" class="form-control">
                        <option></option>
                        <option {{ isset($monevPjn) && $monevPjn->pimpinan_pjn == 'Kecamatan' ? 'selected' : '' }}>
                            Kecamatan</option>
                        <option {{ isset($monevPjn) && $monevPjn->pimpinan_pjn == 'Kelurahan' ? 'selected' : '' }}>
                            Kelurahan</option>
                        <option {{ isset($monevPjn) && $monevPjn->pimpinan_pjn == 'Puskesmas' ? 'selected' : '' }}>
                            Puskesmas</option>
                        <option
                            {{ isset($monevPjn) && $monevPjn->pimpinan_pjn == 'Babinsa/Babinkamtibmas' ? 'selected' : '' }}>
                            Babinsa/Babinkamtibmas</option>
                        <option {{ isset($monevPjn) && $monevPjn->pimpinan_pjn == 'Institusi' ? 'selected' : '' }}>
                            Institusi</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Jabatan</label>
                <div class="col-8 col-md-4">
                    <input type="text" name="jabatan" class="form-control"
                        value="{{ old('jabatan') ?? ($monevPjn->jabatan ?? '') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Ada Evaluasi setelah Kegiatan</label>
                <div class="col-8 col-md-4">
                    <select name="evaluasi" class="form-control">
                        <option>Tidak</option>
                        <option {{ isset($monevPjn) && $monevPjn->evaluasi == 'Ada' ? 'selected' : '' }}>Ada</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2">Ada Sirine</label>
                <div class="col-8 col-md-4">
                    <select name="sirine" class="form-control">
                        <option>Tidak</option>
                        <option {{ isset($monevPjn) && $monevPjn->sirine == 'Ada' ? 'selected' : '' }}>Ada</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-4 col-md-2"></label>
                <div class="col-8 col-md-4">
                    <button class="btn btn-success btn-sm">Simpan</button>
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
