
@extends('layouts.master')
@section('content')
 
            
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <section class="section">
                  <div class="section-header">
                    <h2>Edit Data Paket</h2>
                  </div>
               
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
                 
              <div class="modal-body">
                <form action="/paket/{{$paket->idp}}/update" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
  
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Paket</label>
                <input name="nama_paket"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$paket->nama_paket}}" required="">

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Harga</label>
                <input name="harga"type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$paket->harga}}" required="">

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Ticket</label>
                <input name="ticket"type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$paket->ticket}}" required="">

              </div>
              
              <div class="modal-footer">
              <a href="/paket" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-warning">Update</button>


            </form>

          </div> <!-- container / end -->

 </section>
</body>
@stop