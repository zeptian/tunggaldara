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
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Monthly Average Rainfall'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4,
                    194.1, 95.6, 54.4
                ]

            }, {
                name: 'New York',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5,
                    106.6, 92.3
                ]

            }, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3,
                    51.2
                ]

            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8,
                    51.1
                ]

            }]
        });
    </script>
@endsection
