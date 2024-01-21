@extends('home')

@section('content')
    <h3>Kasus</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap Kecepatan Pelaporan Rumah Sakit</h4>
        </div>
        <div class="card-body of-scroll">
            <form>
                <div class="form-group row">
                    <label class="col-md-1">Tanggal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-group" name="start"
                            value="{{ $request->start ?? date('01-m-Y') }}" />
                    </div>
                    <label class="col-md-1">Sampai</label>
                    <div class="col-md-2">
                        <input type="text" class="form-group" name="end"
                            value="{{ $request->end ?? date('d-m-Y') }}" />
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary btn-sm" type="submit">Lihat</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped" id="data">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Rumah Sakit</th>
                        <th rowspan="2">Jumlah Kasus</th>
                        <th rowspan="2">Rata-rata Kecepatan</th>
                        <th colspan="2">
                            < 1hr </th>
                        <th colspan="2"> 1 - 2hr </th>
                        <th colspan="2"> 3 - 7hr </th>
                        <th colspan="2"> 8 - 14hr </th>
                        <th colspan="2"> > 15hr </th>
                    </tr>
                    <tr>
                        <td>Jumlah Data</td>
                        <td>%</td>
                        <td>Jumlah Data</td>
                        <td>%</td>
                        <td>Jumlah Data</td>
                        <td>%</td>
                        <td>Jumlah Data</td>
                        <td>%</td>
                        <td>Jumlah Data</td>
                        <td>%</td>
                    </tr>
                </thead>
                <tbody>
                    @if ($rekap != null)
                        @foreach ($rekap as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->rs }}</td>
                                <td>{{ $item->jml }}</td>
                                <td>{{ round($item->selisih / $item->jml, 2) }}</td>
                                <td>{{ $item->hr1 }}</td>
                                <td>{{ round(($item->hr1 / $item->jml) * 100, 2) }}</td>
                                <td>{{ $item->hr2 }}</td>
                                <td>{{ round(($item->hr2 / $item->jml) * 100, 2) }}</td>
                                <td>{{ $item->hr3 }}</td>
                                <td>{{ round(($item->hr3 / $item->jml) * 100, 2) }}</td>
                                <td>{{ $item->hr8 }}</td>
                                <td>{{ round(($item->hr8 / $item->jml) * 100, 2) }}</td>
                                <td>{{ $item->hr15 }}</td>
                                <td>{{ round(($item->hr15 / $item->jml) * 100, 2) }}</td>
                            </tr>
                        @endforeach
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
                            onclick="tableToExcel('data', 'name', 'rekap_kecepatan_pelaporan_rs.xls')">EXPORT</button>
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
