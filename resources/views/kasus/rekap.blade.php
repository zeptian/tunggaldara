@extends('home')

@section('content')
<h3>Kasus</h3>
<hr/>
<div class="card">
    <div class="card-header">
        <h4>Rekap Kasus</h4>
    </div>
    <div class="card-body of-scroll">
        <table class="table">
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
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->tgl_lp}}</td>
                        <td>{{$item->tgl_rs}}</td>
                        <td>{{$item->pasien->nama}}</td>
                        <td>{{$item->pasien->ortu}}</td>
                        <td>{{$item->idk}}</td>
                        <td>{{$item->tgl_lahir}}</td>
                        <td>{{$item->pasien->alamat}}</td>
                        <td>{{$item->pasien->kdesa}}</td>
                        <td>{{$item->rs}}</td>
                        <td>{{$item->diag}}</td>
                    </tr>
                @endforeach
                <tr></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection