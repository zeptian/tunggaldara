@extends('home')

@section('content')
    <h3>Laporan Monev PJN</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap Laporan Monev PJN</h4>
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
                        <th>Puskesmas</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Kelurahan</th>
                        <th>RW</th>
                        <th>Jml bangunan dipantau jentik</th>
                        <th>Jml bangunan positif jentik</th>
                        <th>ABJ</th>
                        <th>Jml kontainer diperiksa (dalam bangunan)</th>
                        <th>jml kontainer positif (dalam bangunan)</th>
                        <th>Jml kontainer diperiksa (luar bangunan)</th>
                        <th>jml kontainer positif (luar bangunan)</th>
                        <th>Jml bangunan pasang perangkap</th>
                        <th>Jml tikus tertangkap</th>
                        <th>Jml larvasida (gr)</th>
                        <th>Apel sebelum kegiatan</th>
                        <th>Pimpinan PSN Serentak</th>
                        <th>Evaluasi setelah kegiatan</th>
                        <th>Jabatan Pimpinan Apel</th>
                        <th>Sirine</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monevPjn as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->puskesmas }}</td>
                            <td>{{ $item->tgl_kegiatan }}</td>
                            <td>{{ $item->kelurahan }}</td>
                            <td>{{ $item->rw }}</td>
                            <td>{{ $item->bangunan_pantau }}</td>
                            <td>{{ $item->bangunan_positif }}</td>
                            <td>{{ $item->bangunan_pantau > 0 ? round((($item->bangunan_pantau - $item->bangunan_positif) / $item->bangunan_pantau) * 100, 2) : '-' }}
                            </td>
                            <td>{{ $item->kontainer_dalam_periksa }}</td>
                            <td>{{ $item->kontainer_dalam_positif }}</td>
                            <td>{{ $item->kontainer_luar_periksa }}</td>
                            <td>{{ $item->kontainer_luar_positif }}</td>
                            <td>{{ $item->perangkap_tikus }}</td>
                            <td>{{ $item->tikus_ditangkap }}</td>
                            <td>{{ $item->larvasida }}</td>
                            <td>{{ $item->apel }}</td>
                            <td>{{ $item->pimpinan_pjn }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->evaluasi }}</td>
                            <td>{{ $item->sirine }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('monev_pjn.edit', ['id' => $item->id]) }}"
                                        class="btn btn-sm btn-warning">edit</a>
                                    <a href="#" class="btn btn-sm btn-danger"
                                        onclick="hapus('{{ $item->id }}','{{ $item->tgl_kegiatan }}','{{ $item->kelurahan }}')">hapus</a>
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

        function hapus(id, tgl, kel) {
            Swal.fire({
                title: 'Apakah anda ingin menghapus Monev PJN pada ' + kel + " tanggal " + tgl + '?',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Ya, Saya yakin`,
                denyButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ URL::to('/monev_pjn') }}/" + id, {
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
