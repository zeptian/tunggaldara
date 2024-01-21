@extends('home')

@section('content')
    <h3>Tunggal Dara</h3>
    <hr />
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('img/tunggal dara.jpeg') }}" class="img-fluid" />
                    </div>
                    <div class="col-md-8">

                        <p> Demam Berdarah Dengue (DBD) merupakan penyakit infeksi yang disebabkan oleh virus Dengue yang
                            ditularkan
                            melalui gigitan nyamuk Aedes dan dapat menyebabkan kematian. DBD masih menjadi salah satu
                            permasalahan
                            kesehatan yang dihadapi oleh Kota Semarang. Tingginya kasus DBD dari tahun ke tahun menjadi
                            permasalahan
                            yang harus diselesaikan. Kota Semarang sering menduduki peringkat atas untuk angka kejadian DBD,
                            baik
                            tingkat nasional maupun Jawa Tengah. Dari tahun ke tahun Dinkes Kota Semarang mengidentifikasi
                            semakin
                            banyaknya wilayah kelurahan endemik DBD. </p>

                        <p>Upaya pengendalian DBD tidak lepas dari peran serta seluruh sektor yang ada di Kota Semarang.
                            Peran serta
                            seluruh sektor yang ada di Kota Semarang perlu dilakukan secara sinergi. Baik sektor pemerintah,
                            swasta,
                            dan masyarakat itu. Sebagai upaya untuk mendukung sinergitas seluruh sektor ini, maka dibuatlah
                            sistem
                            integrasi yang memungkinkan seluruh sektor dapat melaporkan dan menerima informasi yang
                            berkaitan dengan
                            DBD. Sistem integrasi ini dinamakan TUNGGAL DARA (Bersatu Tanggulangi Demam Berdarah). Melalui
                            TUNGGAL
                            DARA diharapkan sinergitas seluruh sektor meningkat sehingga dapat menekan angka kejadian DBD di
                            Kota
                            Semarang. </p>

                        <p>TUNGGAL DARA merupakan sistem integrasi yang bertujuan menjembatani hambatan yang muncul dalam
                            upaya
                            pengendalian kejadian DBD. Pelaporan pasien dilakukan secara online dan realtime. Pemberitahuan
                            kepada
                            petugas dan pemangku wilayah melalui sistem sms gateway, sehingga petugas dan pemangku wilayah
                            cepat
                            menggerakkan masyarakat untuk melakukan antisipasi penyebaran dengan melakukan PSN 3M secara
                            mandiri.
                            Masyarakat dan kader pun dengan mudah melaporkan hasil kegiatan PSN 3M nya melalui format sms
                            kepada
                            server, sehingga tidak harus bersusah payah mengirimkan ke Puskesmas. </p>

                        <p>TUNGGAL DARA memodifikasi kerjasama linsek dengan bantuan sistem informasi. Sehingga memberikan
                            kemudahan
                            dalam mendapatkan informasi dan analisa, dapat diakses kapan dan dimana saja. Cepatnya informasi
                            memungkinkan pengambil kebijakan juga cepat memutuskan cara penanggulangan. Sehingga kasus DBD
                            dapat
                            ditekan penyebarannya. </p>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <h2><a href="{{ route('menu') }}">MENU</a></h2>
            </div>
        </div>
    </div>
@endsection
