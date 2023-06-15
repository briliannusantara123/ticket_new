<?php 
  $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
 ?>
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
                    <h2>Request Lines</h2>
                  </div>
               
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
                 
              <div class="modal-body">
                <form action="/requestlines/{{$rl->idl}}/update" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
             <input type="hidden" name="" value="{{ url()->previous() }}">
               <input type="hidden" name="id_company" value="{{$rl->id_company}}">
               <input type="hidden" name="id_header" value="{{$rl->id_header}}">
               @if(auth()->user()->role == 4)
                @if($rl->status == 5)
                @if($rl->id_developer == !Null)
             <div class="form-group">
                  <label for="exampleFormControlSelect1">Developer</label>
                  <input type="text" name="id_developer" class="form-control" value="{{$rl->user->username}}" readonly="">
                </div>
                @endif
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" readonly="">{{$rl->description}}</textarea>
                </div>
                @endif
              @endif
              @if(auth()->user()->role == 3)
                @if($rl->status == 5)
                @if($rl->id_developer == Null)
             <div class="form-group">
                    <strong id="text">Developer</strong> 
                     <select name="id_developer" class="form-control"  id="id_developer">
                      <option value="" disabled="disabled" selected="selected">Pilih Developer</option>

                      @foreach($developer as $developer)
                       @if($developer->id_jabatan == 1)
                      <option value="{{$developer->id_user}}">{{$developer->username}} - {{$ppt}}</option>
                       @endif
                      @endforeach
                    </select>
                </div>

                @endif
                <div class="form-group">
                  <label>Descriptions</label>
                  <textarea class="form-control" name="description" readonly="">{{$rl->description}}</textarea>
                </div>
                @endif
              @endif
                @if($rl->status == 6)
             <div class="form-group">
                  
                  
                  @if($rl->id_developer == !Null)
             <div class="form-group">
                  
                  <input type="hidden" name="id_developer" class="form-control" value="{{$rl->id_developer}}" readonly="">
                </div>
                @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea name="description" class="form-control" readonly="">{{$rl->description}}</textarea>

                </div>
                @endif
                @if($rl->status == 7)
             <div class="form-group">
                  
                  @if($rl->id_developer == !Null)
             <div class="form-group">
                  
                  <input type="hidden" name="id_developer" class="form-control" value="{{$rl->id_developer}}" readonly="">
                </div>
                @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                 <textarea name="description" class="form-control" readonly="">{{$rl->description}}</textarea>

                </div>
                @endif
                
                @if(auth()->user()->role == 3)
                @if($rl->status == 10)
                <div class="form-group">
                  <label>Message Testing</label>
                  <textarea name="message_testing" class="form-control" required=""></textarea>
                </div>
                @endif 
               @if($rl->status == 12)
                <div class="form-group">
                  <label>Message Testing</label>
                  <textarea name="message_testing" class="form-control" required=""></textarea>
                </div>
                @endif 
                @if($rl->status == 2)
                <div class="form-group">
                    <strong>Keperluan</strong> 
                     <select name="" class="form-control"  id="keperluan" required>
                      <option disabled="disabled" selected="selected" value="">Pilih Keperluan</option>
                      <option value="pilih" >Pilih Developer</option>
                      <option value="tanpa" >Tanpa Developer</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <strong id="text" hidden="">Developer</strong> 
                     <select name="id_developer" class="form-control"  id="id_developer" hidden="">
                      <option value="" disabled="disabled" selected="selected">Pilih Developer</option>

                      @foreach($developer as $developer)
                       @if($developer->id_jabatan == 1)
                      <option value="{{$developer->id_user}}">{{$developer->username}} - {{$ppt}}</option>
                       @endif
                      @endforeach
                    </select>
                </div>
                @if($rh->ticket_paid == Null)
                <div class="form-group">
                  <h5>Ceklis Agar Tidak dikenakan Chas Ticket</h5>
                  <input type="checkbox" name="ticket_paid" value="1" style="width:50px;height:50px">
                </div>
                @endif
             
                @endif
                
                @endif
                @if(auth()->user()->role == 2)
                
                @if($rl->status == 2)
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Developer</label>
                  @if($rl->id_developer == !Null)
             <div class="form-group">
                  <label for="exampleFormControlSelect1">Developer</label>
                  <input type="text" name="id_developer" class="form-control" value="{{$rl->user->username}}" readonly="">
                </div>
                @endif
                </div>
             
                @endif
                @endif

              
              @if(auth()->user()->role == 4)
              @if($rl->status == 1)
              
             <div class="form-group">
                  <label for="exampleFormControlSelect1">Project</label>
                  <select name="id_project" class="form-control" id="exampleFormControlSelect1">
                   @foreach($projects as $projects)
                    <option value="{{$projects->id}}"
                      @if($rl->id_project == $projects->nama_projects)
                      selected
                      @endif>
                      {{$projects->nama_projects}}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea name="description" class="form-control" readonly="">{{$rl->description}}</textarea>

  </div>
  
  <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                  <label for="priority" class="col-md-4 control-label">priority</label>
                  <select class="form-control" name="priority" required="">
                      <option value="low" {{$rl->priority === "low" ? "selected" : ""}}>Low</option>
                      <option value="middle" {{$rl->priority === "middle" ? "selected" : ""}}>Middle</option>
                      <option value="high" {{$rl->priority === "high" ? "selected" : ""}}>High</option>
                      <option value="critical" {{$rl->priority === "critical" ? "selected" : ""}}>Critical</option>
                      
                  </select>
              </div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Deadline</label>
    <input type="date" name="dead_line" class="form-control" value="{{$rl->dead_line}}">
</div>
              @endif
              @if($rl->status == 2)
              
              <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" class="form-control" readonly="">{{$rl->description}}</textarea>
                </div>
              @endif
              @if($rl->status == 6)
              
              <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="7">Solve</option>
                    <option value="5">Re-Progress</option>
                  </select>
                </div>
              @endif
              @endif
              <img src="{{asset('/'.$rl->gambar)}}" alt="" style="width: 800px;height: 500px;"> 
              
              <div class="modal-footer">
             @if(auth()->user()->role == 2)
              @if($rl->status == 1)
              <a href="/requestheader" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-primary">Analysis</button>
              @elseif($rl->status == 2)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-success" onClick="return confirm('Apakah Anda Ingin Melakukan Negosiasi ??')">Progress</button>
              @elseif($rl->status == 10)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-info">Testing</button>
              @elseif($rl->status == 12)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-info">Testing</button>
              @elseif($rl->status == 6)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              @elseif($rl->status == 7)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
             
              <!-- <button type="submit" class="btn btn-danger">Close</button> -->
              @elseif($rl->status == 5)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-info">Testing</button>
              
              @endif

             @endif
             @if(auth()->user()->role == 3)
              @if($rl->status == 1)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              
              @elseif($rl->status == 2)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-success">Progress</button>
              @elseif($rl->status == 10)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-info">Testing</button>
              @elseif($rl->status == 12)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-info">Testing</button>
              @elseif($rl->status == 6)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-success">Solve by MSI</button>
              @elseif($rl->status == 5)
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
               @if($rl->id_developer == Null)
              <button type="submit" class="btn btn-warning">Update</button>
               @endif
              @endif
              
             @endif
             @if(auth()->user()->role == 4)
             <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
             @if($rl->status == 1)
              <button type="submit" class="btn btn-warning">Update</button>
              @endif
              
              @if($rl->status == 6)
              <button type="submit" class="btn btn-warning">Update Status</button>
              @endif
              @endif
              @if($rl->status == 7)
              
              <button type="submit" class="btn btn-dark">Close</button>
              
             @endif
             @if(auth()->user()->role == 1)
              @if($rl->status == 5)
               <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-success">On Develop</button>
              @elseif($rl->status == 11)
               <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-success">Done Develop</button>
              @else
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
              @endif
             @endif

            </form>

          </div> <!-- container / end -->

 </section>
</body>
 <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script> 
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type='text/javascript'>
    $(window).load(function(){
    $("#keperluan").change(function() {
                console.log($("#keperluan option:selected").val());
                if ($("#keperluan option:selected").val() == 'pilih') {

                    $('#id_developer').prop('hidden', false);
                    $('#text').prop('hidden', false);

                }else if ($("#keperluan option:selected").val() == 'tanpa') {
                    $('#id_developer').prop('hidden', 'true');
                    $('#text').prop('hidden', 'true');
                      
                }else {
                    $('#default').prop('hidden', 'true');
                    $('#text').prop('hidden', 'true');
                }
            });
    });
    </script>
@stop