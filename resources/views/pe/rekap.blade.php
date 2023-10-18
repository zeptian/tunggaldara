@extends('home')

@section('content')
    <h3>Penyelidikan Epidemiologi</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap PE</h4>
        </div>
        <div class="card-body of-scroll">
            <form>
                <div class="form-group row">
                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option {{ $request->status == 'Sudah PE' ? 'selected' : '' }}>Sudah PE</option>
                            <option {{ $request->status == 'Belum PE' ? 'selected' : '' }}>Belum PE</option>
                        </select>
                    </div>

                    <label class="col-md-1">Tanggal</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control datepicker" name="start" value="{{ $request->start }}" />
                    </div>

                    <label class="col-md-1">Sampai</label>
                    <div class="col-md-2">
                        <input type="text" class="form-control datepicker" name="end" value="{{ $request->end }}" />
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-sm" type="submit">Telusur</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        @if ($request->status == 'Sudah PE')
                            <th>Tanggal PE</th>
                        @endif
                        <th>Tanggal Lapor</th>
                        <th>Rumah Sakit</th>
                        <th>Nama</th>
                        <th>Nama KK</th>
                        <th>ID Kasus</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Kelurahan</th>
                        <th>RS</th>
                        <th>Diagnosa</th>
                        <th>Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kasus as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if ($request->status == 'Sudah PE')
                                <td>{{ $item->tgl_pe }}</td>
                            @endif
                            <td>{{ $item->tgl_lp }}</td>
                            <td>{{ $item->rs }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->ortu }}</td>
                            <td>{{ $item->idk }}</td>
                            <td>{{ $item->tgl_lahir }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->kdesa }}</td>
                            <td>{{ $item->rs }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->diag_akhir }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#" class="btn btn-sm btn-success">detail</a>
                                    <a href="{{ route('pe.create', ['idk' => $item->idk]) }}"
                                        class="btn btn-sm btn-primary">input PE</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection
@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".datatable").dataTable();
        })
    </script>
@endsection
