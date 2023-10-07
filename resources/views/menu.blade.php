@extends('home')

@section('content')
    <div style="background-color: #ffffff80; padding:20px;">
        <h3>Kasus</h3>
        <hr />
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box">
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
                <div class="info-box">
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
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus') }}" class="stretched-link">
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
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus') }}" class="stretched-link">
                                <h5>LAPORAN PJN & PTP</h5>
                            </a>
                        </span>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus') }}" class="stretched-link">
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
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus') }}" class="stretched-link">
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
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus') }}" class="stretched-link">
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
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">
                            <a href="{{ route('kasus') }}" class="stretched-link">
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
