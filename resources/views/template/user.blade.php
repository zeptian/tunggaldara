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

        <div class="d-none d-md-block">

            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                </li>
                <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                </li>
                <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                </li>
            </ul>

            <a class="btn btn-warning btn-block" href="{{ route('logout') }}"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>


            <div class="row">
                <div class="col-12 col-sm-12 col-md-6">
                    <div class="info-box-sm">
                        <span class="info-box-icon-sm bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                <a href="#" class="stretched-link">Message</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="http://dinkes.semarangkota.go.id">Dinas Kesehatan Kota Semarang</a>
    </div>
</div>
