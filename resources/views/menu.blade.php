@extends('home')

@section('content')
<div style="background-color: #ffffff80; padding:20px;">
    <h3>Kasus</h3>
    <hr/>
    <div class="row">
        <div class="col-6 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text"> 
                    <a href="{{route('kasus.tambah')}}" class="stretched-link">Tambah Kasus</a>
                </span>
              <div class="progress">
                <div class="progress-bar bg-danger" style="width: 70%"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                  <span class="info-box-text"> 
                      <a href="{{route('kasus')}}" class="stretched-link">Telusur Kasus</a>
                  </span>
                <div class="progress">
                  <div class="progress-bar bg-info" style="width: 70%"></div>
                </div>
              </div>
            </div>
        </div>
    </div>
    
    <h3>Laporan</h3>
    <hr/>
    <div class="row">
        <div class="col-6 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">
                10
                <small>%</small>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-6 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-6 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-6 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New Members</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
  </div>
@endsection