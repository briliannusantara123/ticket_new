@extends('layouts.master')
@section('content')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          @if(auth()->user()->role == 4)
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Ticket</h4>
                  </div>
                  <div class="card-body">
                    
                    <h2>{{$project - $ts}}</h2>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Request</h4>
                  </div>
                  <div class="card-body">
                    <h2>{{$rh}}</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Requestlines</h4>
                  </div>
                  <div class="card-body">
                    <h2>{{$rl}}</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Requestlines in Progress</h4>
                  </div>
                  <div class="card-body">
                    <h2>{{$r}}</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
            
            
          @endif
          @if(auth()->user()->role == 2 )
          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Company</h4>
                  </div>
                  <div class="card-body">
                    {{$proj}}
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Paket</h4>
                  </div>
                  <div class="card-body">
                    {{$paket}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Projects</h4>
                  </div>
                  <div class="card-body">
                    {{$projects}}
                  </div>
                </div>
              </div>
            </div>
             <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Type Support</h4>
                  </div>
                  <div class="card-body">
                    {{$typesupport}}
                  </div>
                </div>
              </div>
            </div>
             <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>User Login</h4>
                  </div>
                  <div class="card-body">
                    {{$userlogin}}
                  </div>
                </div>
              </div>
            </div><div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4><a href="/dashboardtransaksi">Transaksi</a></h4>
                  </div>
                  <div class="card-body">
                    {{$transaksi}}
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if(auth()->user()->role == 1)
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Projectlines</h4>
                  </div>
                  <div class="card-body">
                    <h2>{{$pa}}</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Requestlines In Progress</h4>
                  </div>
                  <div class="card-body">
                    <h2>{{$ppt}}</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
           @if(auth()->user()->role == 3)
          <div class="row">
             <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Request</h4>
                  </div>
                  <div class="card-body">
                    <h2>{{$rhw}}</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Requestlines</h4>
                  </div>
                  <div class="card-body">
                    <h2>{{$rls}}</h2>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Requestlines In Progress</h4>
                  </div>
                  <div class="card-body">
                    <h2>{{$rlt}}</h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif

        @stop