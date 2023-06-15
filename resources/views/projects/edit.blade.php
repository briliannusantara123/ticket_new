
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
                    <h2>Edit Data Project</h2>
                  </div>
               
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
                 
              <div class="modal-body">
                <form action="/projects/{{$projects->id}}/update" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="form-group">
                  <label for="exampleFormControlSelect1">Company</label>
                  <select name="id_company" class="form-control" id="exampleFormControlSelect1">
                   @foreach($company as $company)
                    <option value="{{$company->idc}}"
                      @if($projects->id_company == $company->idc)
                      selected
                      @endif>
                      {{$company->nama}}
                    </option>
                    @endforeach
                  </select>
                </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Nama Projects</label>
                <input name="nama_projects"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$projects->nama_projects}}" required="">

              </div>
              
              <div class="modal-footer">
              <a href="/projects" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-warning">Update</button>


            </form>

          </div> <!-- container / end -->

 </section>
</body>
@stop