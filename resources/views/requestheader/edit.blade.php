
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
                    <h2>Request Header</h2>
                  </div>
               
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
                 
              <div class="modal-body">
                <form action="/requestheader/{{$rh->id}}/update" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
             
               <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" class="form-control">{{$rh->description}}</textarea>

                  </div>             
               <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                  <label for="priority" class="col-md-4 control-label">priority</label>
                  <select class="form-control" name="priority" required="">
                      <option value="low" {{$rh->priority === "low" ? "selected" : ""}}>Low</option>
                      <option value="middle" {{$rh->priority === "middle" ? "selected" : ""}}>Middle</option>
                      <option value="high" {{$rh->priority === "high" ? "selected" : ""}}>High</option>
                      <option value="critical" {{$rh->priority === "critical" ? "selected" : ""}}>Critical</option>
                  </select>
              </div>
                  
                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Deadline</label>
                    <input type="date" name="dead_line" class="form-control" value="{{$rh->dead_line}}">
                </div>
                <input type="hidden" name="email_client" value="{{auth()->user()->email}}">
                <input type="hidden" name="status" value="1">
                  
                <div class="modal-footer">
                  <a href="/requestheader" class="btn btn-danger">Kembali</a>
                  <button type="submit" class="btn btn-primary">Submit</button>


                </form>
          </div> <!-- container / end -->

 </section>
 
</body>
@stop