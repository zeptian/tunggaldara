@extends('home')

@section('content')
    <h3>Lapran SiCentik</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap Laporan SiCentik</h4>
        </div>
        <div class="card-tools">
            <a class="btn btn-success" href="{{ route('sicentik.create') }}">Tambah Data</a>
        </div>
        <div class="card-body of-scroll">
            <form>
                <div class="form-group row">
                    <label class="col-md-1">Tahun</label>
                    <div class="col-md-2">
                        <select name="tahun" class="form-control">
                            @for ($i = date('Y'); $i >= 2017; $i--)
                                <option {{ $i == $request->tahun ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <label class="col-md-1">Bulan</label>
                    <div class="col-md-2">
                        <select name="bulan" class="form-control">
                            <option value="all">Semua</option>
                            <option value="01" {{ $request->bulan == '01' ? 'selected' : '' }}>Januari</option>
                            <option value="02" {{ $request->bulan == '02' ? 'selected' : '' }}>Februari</option>
                            <option value="03" {{ $request->bulan == '03' ? 'selected' : '' }}>Maret</option>
                            <option value="04" {{ $request->bulan == '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ $request->bulan == '05' ? 'selected' : '' }}>Mei</option>
                            <option value="06" {{ $request->bulan == '06' ? 'selected' : '' }}>Juni</option>
                            <option value="07" {{ $request->bulan == '07' ? 'selected' : '' }}>Juli</option>
                            <option value="08" {{ $request->bulan == '08' ? 'selected' : '' }}>Agustus</option>
                            <option value="09" {{ $request->bulan == '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $request->bulan == '10' ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $request->bulan == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $request->bulan == '12' ? 'selected' : '' }}>Desember</option>
                        </select>
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
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Puskesmas</th>
                        <th>Jumlah sekolah sasaran SiCentik</th>
                        <th>Jumlah sekolah yang melakukan Sicentik</th>
                        <th>Jumlah Sekolah yang dipantau jentik oleh Puskesmas</th>
                        <th>Jumlah Sekolah yang Positif jentik</th>
                        <th>Jumlah Sekolah yang termonev oleh Puskesmas</th>
                        <th>Lampiran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sicentik as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->bulan }}</td>
                            <td>{{ $item->puskesmas }}</td>
                            <td>{{ $item->sasaranSekolah }}</td>
                            <td>{{ $item->realSekolah }}</td>
                            <td>{{ $item->sekolahPantau }}</td>
                            <td>{{ $item->sekolahPositif }}</td>
                            <td>{{ $item->sekolahMonev }}</td>
                            <td>{{ $item->Lampiran }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('sicentik.edit', ['id' => $item->id_sicentik]) }}"
                                        class="btn btn-sm btn-warning">edit</a>
                                    <a href="#" class="btn btn-sm btn-danger"
                                        onclick="hapus('{{ $item->id_sicentik }}','{{ $item->puskesmas }}','{{ $item->bulan }}')">hapus</a>
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

        function hapus(id, puskesmas, bulan) {
            Swal.fire({
                title: 'Apakah anda ingin menghapus data Sicentik Pusk ' + puskesmas + " bulan " +
                    bulan + '?',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Ya, Saya yakin`,
                denyButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ URL::to('/sicentik') }}/" + id, {
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
