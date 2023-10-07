@extends('home')

@section('content')
    <h3>Kasus</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap Kasus</h4>
        </div>
        <div class="card-body of-scroll">
            <form>
                <div class="form-group row">
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
                        <th>Tanggal Lapor</th>
                        <th>Tanggal Masuk RS</th>
                        <th>Nama</th>
                        <th>Nama KK</th>
                        <th>ID Kasus</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Kelurahan</th>
                        <th>RS</th>
                        <th>Diagnosa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kasus as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tgl_lp }}</td>
                            <td>{{ $item->tgl_rs }}</td>
                            <td>{{ $item->pasien->nama }}</td>
                            <td>{{ $item->pasien->ortu }}</td>
                            <td>{{ $item->idk }}</td>
                            <td>{{ $item->tgl_lahir }}</td>
                            <td>{{ $item->pasien->alamat }}</td>
                            <td>{{ $item->pasien->kdesa }}</td>
                            <td>{{ $item->rs }}</td>
                            <td>{{ $item->diag }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".datatable").dataTable();

        })

        function hapus(id, nama) {
            Swal.fire({
                title: 'Apakah anda ingin menghapus ibu a/n ' + nama + '?',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Ya, Saya yakin`,
                denyButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ URL::to('/bumil') }}/" + id, {
                            _token: '{{ csrf_token() }}',
                            _method: 'delete'
                        },
                        function(data) {
                            if (data.status) {
                                Swal.fire(data.message, '', 'success');
                                window.location.reload();
                            }
                        })
                }
            })
        }
    </script>
@endsection
