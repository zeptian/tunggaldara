@extends('home')

@section('content')
    <h3>Kasus</h3>
    <hr />
    <div class="card">
        <div class="card-header">
            <h4>Rekap Laporan Per Rumah Sakit</h4>
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
                    <div class="col-md-1">
                        <button class="btn btn-primary btn-sm" type="submit">Lihat</button>
                    </div>
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th rowspan="3">No</th>
                        <th rowspan="3">Rumah Sakit</th>
                        <th colspan="24">Jumlah Kasus</th>
                        <th colspan="2" rowspan="2">Jumlah</th>
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
                        @foreach ($rekap as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->rs }}</td>
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
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">TOTAL</th>
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
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('js')
@endsection
