@extends('home')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="info-box mb-3 bg-danger elevation-2">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Jumlah Kasus</span>
                    <span class="info-box-number">999</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="info-box mb-3 bg-danger elevation-2">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kasus Belum Varif</span>
                    <span class="info-box-number">999</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="info-box mb-3 bg-danger elevation-2">
                <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kasus Belum PE</span>
                    <span class="info-box-number">999</span>
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
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus') }}" class="stretched-link">
                                <h5>TELUSUR KASUS</h5>
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
                            <a href="{{ route('pe') }}" class="stretched-link">
                                <h5>PENYELIDIKAN EPIDEMIOLOGI</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 70%"></div>
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
