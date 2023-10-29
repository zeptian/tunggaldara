@extends('home')

@section('content')
    <h3>PJR & PTP</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <div class="user-block">
                <h4>Rekap Pemantauan Jentik Rutin & Pemberantasan Tikus Pemukiman</h4>
            </div>
            <div class="card-tools">
                <a class="btn btn-success" href="{{ route('pjr.create') }}">Tambah Data</a>
            </div>
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
                <div class="form-group row">
                    <label class="col-md-1">Minggu Ke</label>
                    <div class="col-md-2">
                        <select name="minggu_ke" class="form-control">
                            <option></option>
                            <option {{ $request->minggu_ke == '1' ? 'selected' : '' }}>1</option>
                            <option {{ $request->minggu_ke == '2' ? 'selected' : '' }}>2</option>
                            <option {{ $request->minggu_ke == '3' ? 'selected' : '' }}>3</option>
                            <option {{ $request->minggu_ke == '4' ? 'selected' : '' }}>4</option>
                            <option {{ $request->minggu_ke == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    <label class="col-md-1">Kelurahan</label>
                    <div class="col-md-2">
                        <select name="kdesa" class="form-control">
                            <option></option>
                            @foreach ($desa as $item)
                                <option value="{{ $item->kode }}"
                                    {{ old('kdesa') == $item->kode ? 'selected' : ($request->kdesa == $item->kode ? 'selected' : '') }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            <hr />
            <table class="table table-striped datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelurahan</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Minggu Ke</th>
                        <th>RT/RW</th>
                        <th>Jumlah Rumah Dipantau</th>
                        <th>Jumlah Rumah Positif</th>
                        <th>Jumlah Perangkap</th>
                        <th>Jumlah Tikus Tertangkap</th>
                        <th>Pengirim</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pjr as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kdesa }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->bulan }}</td>
                            <td>{{ $item->minggu_ke }}</td>
                            <td>{{ $item->rt . '/' . $item->rw }}</td>
                            <td>{{ $item->jml_rumah }}</td>
                            <td>{{ $item->jml_positif }}</td>
                            <td>{{ $item->jml_perangkap }}</td>
                            <td>{{ $item->jml_tikus }}</td>
                            <td>{{ $item->no_pengirim }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('pjr.edit', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-warning">edit</a>
                                    <a href="#" class="btn btn-sm btn-danger"
                                        onclick="hapus('{{ $item->id }}','{{ $item->kdesa }}','{{ $item->bulan }}')">hapus</a>
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

        function hapus(id, kelurahan, bulan) {
            Swal.fire({
                title: 'Apakah anda ingin menghapus data PJR kelurahan ' + kelurahan + " bulan " +
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
                    $.post("{{ URL::to('/pjr') }}/" + id, {
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
