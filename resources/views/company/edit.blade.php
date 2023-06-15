
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
                    <h2>Edit Data Company</h2>
                  </div>
               
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
                 
              <div class="modal-body">
                <form action="/company/{{$company->idc}}/update" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
  
              <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input name="nama"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$company->nama}}" required="">

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="email"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$company->email}}" required="">

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nomer Telepon</label>
                <input name="telp"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$company->telp}}" required="">

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Alamat</label>
                <textarea name="alamat" class="form-control" required="">{{$company->alamat}}</textarea>

              </div>
              
              <div class="modal-footer">
              <a href="/company" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-warning">Update</button>


            </form>

          </div> <!-- container / end -->

 </section>
</body>
@stop