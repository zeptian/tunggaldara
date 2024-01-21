<div class="card rd-20" id="user">
    <div class="card-body box-profile">
        <div class="row">
            <div class="col-4 col-md-12">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('assets/img/user1-128x128.jpg') }}"
                        alt="User profile picture">
                </div>
            </div>
            <div class="col-8  col-md-12">
                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                <p class="text-muted text-center">{{ Auth::user()->faskes }}</p>
            </div>
        </div>
        <div class="d-block d-md-none">
            <div class="dropdown show">
                <a class="btn-block btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    MENU
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>
        </div>
        <div id="accordion">
            <div class="card bg-primary m-0">
                <div class="card-header" style="padding: 0.5rem 0.75rem;">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100 text-white" href="{{ route('menu') }}">Home</a>
                    </h4>
                </div>
            </div>
            <div class="card bg-danger m-0">
                <div class="card-header" style="padding: 0.5rem 0.75rem;">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100 text-white" data-toggle="collapse" href="#collapseOne"
                            aria-expanded="true">Kasus</a>
                    </h4>
                </div>
                <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{ route('kasus.create') }}" class="stretched-link">
                                Tambah Kasus
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('kasus') }}" class="stretched-link">
                                Telusur Kasus
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('pe') }}" class="stretched-link">
                                Penyelidikan Epidemiologi
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="card card-warning m-0">
                <div class="card-header" style="padding: 0.5rem 0.75rem;">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo"
                            aria-expanded="false">Pemantauan Jentik</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion" style="">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{ route('pjr') }}" class="stretched-link">
                                PJR
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('pjb') }}" class="stretched-link">
                                PJB
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('pjn') }}" class="stretched-link">
                                PJN
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('psn_sekolah') }}" class="stretched-link">
                                PSN Sekolah
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('sicentik') }}" class="stretched-link">
                                Sicentik
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('monev_pjn') }}" class="stretched-link">
                                Monev PJN
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('srsj') }}" class="stretched-link">
                                SRSJ
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card card-success">
                <div class="card-header" style="padding: 0.5rem 0.75rem;">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                            Laporan
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{ route('kasus.rekapAngka') }}" class="stretched-link">
                                Rekap Kasus
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('kasus.rekapKecepatan') }}" class="stretched-link">
                                Kecepatan Pelaporan
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('pe.kecepatan') }}" class="stretched-link">
                                Kecepatan PE
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">

        <a class="btn btn-warning btn-block" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <a href="http://dinkes.semarangkota.go.id">Dinas Kesehatan Kota Semarang</a>
    </div>
</div>
