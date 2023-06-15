 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
@extends('layouts.master')
@section('content')
<script type='text/javascript'>
    $(window).load(function(){
    $("#keperluan").change(function() {
                console.log($("#keperluan option:selected").val());
                if ($("#keperluan option:selected").val() == 5) {
                    $('#message_admin').prop('hidden', false);
                    $('#message_admin').prop('required', 'true');
                    $('#message').prop('hidden', false);
                    

                }else if ($("#keperluan option:selected").val() == 3) {
                    $('#message_admin').prop('hidden', 'true');
                    $('#message').prop('hidden', 'true');
                    
                }else {
                    $('#message_admin').prop('hidden', 'true');
                    $('#message').prop('hidden', 'true');
                    
                }
            });
    });
    </script>
            
<div class="main">
    <div class="main-content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading">
                <section class="section">
                  <div class="section-header">
                    <h2>Transaksi</h2>
                  </div>
               
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
                 
              <div class="modal-body">
                <form action="/transaksi/{{$transaksi->id}}/update" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{$transaksi->id}}">
              <input type="hidden" name="id_company" value="{{$transaksi->id_company}}">
              <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea name="description" class="form-control">{{$transaksi->description}}</textarea>

              </div>
              @if(auth()->user()->role == 4)
              @if($transaksi->status == 1)
               <div class="form-group">
                <label>Jumlah Ticket</label>
                <input type="number" name="jumlah_ticket" value="{{$transaksi->jumlah_ticket}}" class="form-control" readonly="">
              </div>
              <div class="form-group">
                <label>Message</label>
                <textarea name="message_client" class="form-control" id="mc" required=""></textarea>
              </div>
              
              @endif
              @endif
              @if(auth()->user()->role == 2)
               <div class="form-group">
                <label>Jumlah Ticket</label>
                <input type="number" name="jumlah_ticket" value="{{$transaksi->jumlah_ticket}}" class="form-control" readonly="">
              </div>
              @endif
              
              
            @if(auth()->user()->role == 2)
              @if($transaksi->status == 2)
                <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" id="keperluan" required="">
                  <option value="pilih" disabled="disabled" selected="selected">Pilih Status</option> 
                  <option value="3">Done</option>
                  <option value="5">Close</option>
                </select>
              </div>
              <div class="form-group">
                <label hidden="" id="message">Message</label>
                <textarea name="message_admin" class="form-control" id="message_admin" hidden=""></textarea>
              </div>
              <input type="hidden" name="email" value="{{$transaksi->email}}">
              
              @endif
            @endif
              
                            
              
              <input type="hidden" name="activedate" value="{{$transaksi->activedate}}">
             
              <div class="modal-footer">
              @if(auth()->user()->role == 2)
              @if($transaksi->status == 1)
              <a href="/transaksi" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-primary">Progress</button>
              @elseif($transaksi->status == 2)
              <a href="/transaksi" class="btn btn-danger">Kembali</a>
              <button type="submit" name="done" class="btn btn-warning">Update Status</button>
              
              @elseif($transaksi->status == 3)
              <a href="/transaksi" class="btn btn-danger">Kembali</a>
              <button type="submit" class="btn btn-dark" onclick="return confirm('Yakin Akan Meng-close Transaksi Ticket Tersebut?');">Close</button>
              
              @endif
              @endif

              @if(auth()->user()->role == 4)
              @if($transaksi->status == 1)
                <a href="/transaksi" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-warning">Cancel</button>
              @endif
              @endif


            </form>

          </div> <!-- container / end -->

 </section>
</body>
@stop