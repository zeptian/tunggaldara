@extends('home')

@section('content')
    <h3>Kasus</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap Kecepatan Penyelidikan Epidemiologi Puskesmas</h4>
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
                        <th rowspan="2">Puskesmas</th>
                        <th rowspan="2">Jumlah Kasus DBD & DSS</th>
                        <th colspan="3">Kecepatan PE DBD & DSS</th>
                        <th rowspan="2">Kasus Belum PE DBD & DSS</th>

                        <th rowspan="2">Jumlah Kasus DD</th>
                        <th colspan="3">Kecepatan PE DD</th>
                        <th rowspan="2">Kasus Belum PE DD</th>
                    </tr>
                    <tr>
                        <th> PE < 24Jam </th>
                        <th> PE 2 hari</th>
                        <th> PE > 2 hari</th>

                        <th> PE < 24Jam </th>
                        <th> PE 2 hari</th>
                        <th> PE > 2 hari</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($kecepatanPe != null)
                        @foreach ($kecepatanPe as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pus }}</td>
                                <td>{{ $item->dbdtotal }}</td>
                                <td>{{ $item->dbd24jam }}</td>
                                <td>{{ $item->dbd2hr }}</td>
                                <td>{{ $item->dbdlbh2hr }}</td>
                                <td>{{ $item->dbdblmpe }}</td>
                                <td>{{ $item->ddtotal }}</td>
                                <td>{{ $item->dd24jam }}</td>
                                <td>{{ $item->dd2hr }}</td>
                                <td>{{ $item->ddlbh2hr }}</td>
                                <td>{{ $item->ddblmpe }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @isset($kecepatanPe)
                <div class="form-group">
                    <a id="dlink" style="display:none;"></a>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" name="export" value="export"
                            onclick="tableToExcel('data', 'name', 'rekap_kecepatan_pe.xls')">EXPORT</button>
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
