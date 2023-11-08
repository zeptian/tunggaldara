@extends('home')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="info-box mb-3 bg-danger elevation-2">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Kasus</span>
                    <span class="info-box-number">{{ $jml_kasus }}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="info-box mb-3 bg-danger elevation-2">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kasus Belum Verif</span>
                    <span class="info-box-number">{{ $jml_kasus_nonverif }}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="info-box mb-3 bg-danger elevation-2">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kasus Belum PE</span>
                    <span class="info-box-number">{{ $jml_belum_pe }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-2" style="background-color: #ffffff80; padding:20px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" id="grafikBulanan" style=" height:300px;"></div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="card">
                    <div class="card-body" id="grafikBulanan2" style=" height:300px;"></div>
                </div>
            </div> --}}
        </div>
    </div>
    <div style="background-color: #ffffff80; padding:20px;">
        <h3>Kasus</h3>
        <hr />
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box elevation-2">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus.create') }}" class="stretched-link">
                                <h5>TAMBAH KASUS</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box elevation-2">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus') }}" class="stretched-link">
                                <h5>TELUSUR KASUS</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box elevation-2">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('pe') }}" class="stretched-link">
                                <h5>PENYELIDIKAN EPIDEMIOLOGI</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3>Pemantauan Jentik</h3>
        <hr />
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box elevation-2">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('monev_pjn') }}" class="stretched-link">
                                <h5>MONEV PJN & PTP</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box elevation-2">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('sicentik') }}" class="stretched-link">
                                <h5>SICENTIK</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box elevation-2">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('srsj') }}" class="stretched-link">
                                <h5>SATU RUMAH SATU JUMANTIK</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3>laporan</h3>
        <hr />
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box elevation-2">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus.rekapAngka') }}" class="stretched-link">
                                <h5>REKAP KASUS</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box elevation-2">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus.rekapKecepatan') }}" class="stretched-link">
                                <h5>KECEPATAN PELAPORAN</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        $.get("{{ route('graph.kasusBulanan') }}",
            function(resp) {
                if (resp.status) {
                    graphBulanan(resp.data)
                }
            })
        $.get("{{ route('graph.kasusBulanan2') }}",
            function(resp) {
                if (resp.status) {
                    graphBulanan2(resp.data)
                }
            })

        function graphBulanan(data) {
            Highcharts.chart('grafikBulanan', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Rekap Kasus Bulanan'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Kasus'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} kasus</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: data
            });
        }

        function graphBulanan2(data) {
            Highcharts.chart('grafikBulanan2', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Rekap Kasus Bulanan'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                        'Dec'
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Kasus'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} kasus</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: data
            });
        }
    </script>
@endsection
