@extends('home')

@section('content')
    <h3>Kasus</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap Angka Kasus</h4>
        </div>
        <div class="card-body of-scroll">
            <form>
                <div class="form-group row">
                    <label class="col-md-1">Tahun</label>
                    <div class="col-md-2">
                        <select name="periode" class="form-control">
                            @for ($i = 0; $i < 5; $i++)
                                <option {{ $request->periode == date('Y') - $i ? 'selected' : '' }}>{{ date('Y') - $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <label class="col-md-1">Jenis Kasus</label>
                    <div class="col-md-2">
                        <select name="kasus" class="form-control">
                            <option value="DBD" {{ $request->kasus == 'DBD' ? 'selected' : '' }}>DBD + DSS</option>
                            <option value="DD" {{ $request->kasus == 'DD' ? 'selected' : '' }}>DD</option>
                        </select>
                    </div>
                    <label class="col-md-1">Wilayah</label>
                    <div class="col-md-2">
                        <select name="wilayah" class="form-control">
                            <option value="kec" {{ $request->wilayah == 'kec' ? 'selected' : '' }}>Kecamatan</option>
                            <option value="pus" {{ $request->wilayah == 'pus' ? 'selected' : '' }}>Puskesmas</option>
                            <option value="kelurahan" {{ $request->wilayah == 'kelurahan' ? 'selected' : '' }}>Kelurahan
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary btn-sm" type="submit">Lihat</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped" id="data">
                <thead>
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">Wilayah</th>
                        <th rowspan="3">Jumlah Penduduk</th>
                        <th colspan="24">Jumlah Kasus</th>
                        <th colspan="2" rowspan="2">Jumlah</th>
                        <th rowspan="3">IR <br /> (per 100.000)</th>
                        <th rowspan="3">CFR</th>
                    </tr>
                    <tr>
                        <th colspan="2">Jan</th>
                        <th colspan="2">Feb</th>
                        <th colspan="2">Mar</th>
                        <th colspan="2">Apr</th>
                        <th colspan="2">Mei</th>
                        <th colspan="2">Jun</th>
                        <th colspan="2">Jul</th>
                        <th colspan="2">Ags</th>
                        <th colspan="2">Sep</th>
                        <th colspan="2">Okt</th>
                        <th colspan="2">Nov</th>
                        <th colspan="2">Des</th>
                    </tr>
                    <tr>
                        @for ($i = 0; $i <= 12; $i++)
                            <td>P</td>
                            <td>M</td>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                    @if ($rekap != null)
                        @php
                            $totalPd = 0;
                        @endphp
                        @foreach ($rekap as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->{$request->wilayah} }}</td>
                                <td>{{ $penduduk[$item->{$request->wilayah}] }}</td>
                                @php
                                    $totalP = 0;
                                    $totalM = 0;
                                @endphp
                                @for ($i = 1; $i <= 12; $i++)
                                    <td>{{ $item->{'P' . $i} }}</td>
                                    <td>{{ $item->{'M' . $i} }}</td>
                                    @php
                                        $totalP += $item->{'P' . $i};
                                        $totalM += $item->{'M' . $i};
                                    @endphp
                                @endfor
                                <td>{{ $totalP }}</td>
                                <td>{{ $totalM }}</td>
                                <td>{{ round(($totalP / $penduduk[$item->{$request->wilayah}]) * 100000, 2) }}
                                <td>{{ round(($totalM / $totalP) * 100, 2) }}</td>
                                @php
                                    $totalPd += $penduduk[$item->{$request->wilayah}];
                                @endphp
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">TOTAL</th>
                            <th>{{ $totalPd }}</th>
                            @php
                                $grandTotalP = 0;
                                $grandTotalM = 0;
                            @endphp
                            @for ($i = 1; $i <= 12; $i++)
                                <th>{{ $rekap->sum('P' . $i) }}</th>
                                <th>{{ $rekap->sum('M' . $i) }}</th>

                                @php
                                    $grandTotalP += $rekap->sum('P' . $i);
                                    $grandTotalM += $rekap->sum('M' . $i);
                                @endphp
                            @endfor
                            <th>{{ $grandTotalP }}</th>
                            <th>{{ $grandTotalM }}</th>
                            <td>{{ round(($grandTotalP / $totalPd) * 100000, 2) }}
                            <th>{{ round(($grandTotalM / $grandTotalP) * 100, 2) }}</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @isset($rekap)
                <div class="form-group">
                    <a id="dlink" style="display:none;"></a>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" name="export" value="export"
                            onclick="tableToExcel('data', 'name', 'rekap_kasus_{{ $request->kasus }}.xls')">EXPORT</button>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('js')
@endsection
