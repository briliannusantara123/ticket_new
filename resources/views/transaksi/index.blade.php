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
                if ($("#keperluan option:selected").val() == 3) {
                    $('#jumlah_ticket').prop('readonly', false);
                    $('#harga').prop('readonly', 'true');
                    $('#activedate').prop('readonly', 'true');

                }else {
                    $('#jumlah_ticket').prop('readonly', 'true');
                    $('#harga').prop('readonly', 'true');
                    $('#activedate').prop('readonly', 'true');
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
                </section>
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
                  @if(auth()->user()->role == 2)
                  <a href="" class="btn fa fa-plus btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="for "></i>Tambahkan Transaksi</a> 
                  @endif
                                    
                                </div>
              </div>
                                <br>
                                    <table id="myTable" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Company</th>
                                            <th>Project</th>
                                            <th>Description</th>
                                            <th>Nama Paket</th>
                                            <th>Jumlah Ticket</th>
                                            <th>Harga</th>
                                            <th>Active Date</th>
                                            <th>Status</th>
                                            <th>Support</th>
                                            <th>Invoice</th>
                                            <th>Message Admin</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                    
                                        <tbody>
                                            @foreach( $transaksi as $transaksi )
                                            <tr>
                        <td>{{$transaksi->code}}</td>
                        <td>{{$transaksi->nama}}</td>
                        <td>{{$transaksi->nama_projects}}</td>
                        <td>{{$transaksi->description}}</td>
                        <td>{{$transaksi->nama_paket}}</td>
                        <td>{{$transaksi->jumlah_ticket}}</td>
                        <td>{{$transaksi->harga}}</td>
                        <td>{{$transaksi->activedate}} Hari</td>
                        @if($transaksi->status == 1)
                          <td><p style="background-color: yellow; text-align: center;border-radius: 50px;">Request</p></td>
                        @endif
                        @if($transaksi->status == 2)
                          <td><p style="background-color: lightblue; text-align: center;border-radius: 50px;">Progress</p></td>
                        @endif
                        @if($transaksi->status == 3)
                          <td><p style="background-color: lightgreen; text-align: center;border-radius: 50px;">Done</p></td>
                        @endif
                        @if($transaksi->status == 4)
                          <td><p style="background-color: red; text-align: center;border-radius: 20px; color: white;">Cancel By Client</p></td>
                        @endif
                        @if($transaksi->status == 5)
                          <td><p style="background-color: red; text-align: center;border-radius: 20px; color: white;">Cancel By Admin</p></td>
                        @endif
                        @if($transaksi->status == 6)
                          <td><p style="background-color: black; text-align: center;border-radius: 50px; color: white;">Close</p></td>
                        @endif
                        <td>{{$transaksi->nama_support}}</td>
                        <td>{{$transaksi->invoice}}</td>
                        <td>{{$transaksi->message_admin}}</td>
                                                <td>
                          @if(auth()->user()->role == 4)
                           @if($transaksi->status == 1)
                           <a href="/transaksi/{{$transaksi->id}}/edit" class="btn btn-warning mt-3">Edit</a>
                           @endif
                          @endif
                          @if(auth()->user()->role == 2)
                           @if($transaksi->status == 6)
                            <p style="background-color: red;color: white;border-radius: 50px;text-align: center;">Close</p>
                           @else
                                                    <a href="/transaksi/{{$transaksi->id}}/edit" class="btn btn-warning mt-3">View</a>
                          @endif
                                                    @endif
                        
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form action="/transaksi/create" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
  <div class="form-group">
    <input name="code"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$nomer}}">

  </div>
  <div class="form-group">

                <strong>Company</strong>
                 <select name="id_company" class="form-control"class="form-control form-control-md" onchange='companyValue()' required="required" required="" id="company">

                            <option value="" disabled="disabled" selected="selected">Pilih Company</option>
                            
                            @foreach($company as $company)
                              <option value="{{$company->idc}}">{{$company->nama}}</option>
                            @endforeach
                </select>
            </div>
  <div class="form-group">
                    <label for="exampleFormControlSelect1">Projects</label>
                    <select name="id_project" class="form-control" id="projectrelation" required="required" onchange='emailValue(this.value)'>

                                      <option value="" disabled="disabled" selected="selected">Pilih Projects</option>
                                   <?php
                                $con = mysqli_connect("localhost", "root","", "ticket");
                                $query=mysqli_query($con, "select * from projects order by id asc");
                                $result = mysqli_query($con, "select * from projects");
                                $jsArrayCompany = "var prdNameCompany = new Array();\n";
                                
                                while ($row = mysqli_fetch_array($result)) {
                               echo '<option name="id_project"  value="' . $row['id'] . '">' .$row['nama_projects']. '</option>';
                                 $jsArrayCompany .= "prdNameCompany['" . $row['id'] . "'] = {id:'".addslashes($row['id'])."'};\n";
                                }
                            ?>
                       </select>
                    </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea name="description" class="form-control"></textarea>

  </div>
  <div class="form-group">
    
      @foreach($paket as $paket)
      <input type="hidden" name="">
      @endforeach
    
  </div>
  <div class="form-group">
                <strong>Paket</strong>
                 <select name="id_paket" class="form-control"class="form-control form-control-md" id="keperluan" onchange='changeValue(this.value)' required="required" required="">

                            <option value="" disabled="disabled" selected="selected">Pilih Paket</option>
                            
                            <?php
                                $con = mysqli_connect("localhost", "root","", "ticket");
                                $query=mysqli_query($con, "select * from paket order by id asc");
                                $result = mysqli_query($con, "select * from paket");
                                $jsArray = "var prdName = new Array();\n";
                                
                                while ($row = mysqli_fetch_array($result)) {
                               echo '<option name="id_paket"  value="' . $row['id'] . '">' .$row['nama_paket']. '</option>';
                                 $jsArray .= "prdName['" . $row['id'] . "'] = {ticket:'" . addslashes($row['ticket'])."',harga:'".addslashes($row['harga'])."',activedate:'".addslashes($row['activedate'])."',activedates:'".addslashes($row['activedate'])."'};\n";
                                }
                            ?>
                </select>
            </div>
    
  <div class="form-group">
    <strong>Jumlah Ticket </strong>
      <input  type="number" class="form-control" name="jumlah_ticket" id="jumlah_ticket" onkeyup="suma();"/>
  </div>

  <div class="form-group">
    <label for="harga">Harga</label>
    <input name="harga"type="number" class="form-control" id="harga" aria-describedby="emailHelp" required="">

  </div>
  <div class="form-group">
    <label for="activedate">Active Date</label>
    <input name="activedate"type="number" class="form-control" id="activedate" aria-describedby="emailHelp" required="">
    <input name=""type="hidden" class="form-control" id="activedates" aria-describedby="emailHelp" required="">
  </div>
  <div class="form-group">
    <input name=""type="hidden" class="form-control" id="harga_paket" aria-describedby="emailHelp" >

  </div>
  <div class="form-group">
    <input name="status"type="hidden" class="form-control" id="status" aria-describedby="emailHelp" value="1">

  </div>
  <!-- <div class="form-group">
    <label for="exampleInputEmail1">Status</label>
    <select name="status" class="form-control">
      <option value="1">Request</option>
      <option value="2">Progress</option>
      <option value="3">Done</option>
      <option value="4">Cancel By Client</option>
      <option value="5">Cancel By Admin</option>
      <option value="6">Close</option>
    </select>

  </div> -->
  <div class="form-group">
    <label for="exampleFormControlSelect1">Support</label>
    <select name="id_support" class="form-control"  id="company_id">
      @foreach($support as $support)
      <option value="{{$support->id}}">{{$support->nama_support}}</option>
      @endforeach
    </select>
  </div>
  <input type="hidden" name="email_company" id="emailcompany">
  <input type="hidden" name="companys" id="companys">
  <input type="hidden" name="invoice" value="INV/{{$ldate}}-{{$nomer}}-{{$aid}}">
  
  
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Submit</button>


</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

 <script type="text/javascript">
         
        <?php echo $jsArray; ?>
        function changeValue(id){
            console.log(id);
            document.getElementById('jumlah_ticket').value = prdName[id].ticket;
            document.getElementById('harga').value = prdName[id].harga;
            document.getElementById('activedate').value = prdName[id].activedate;
            document.getElementById('activedates').value = prdName[id].activedates;
            document.getElementById('harga_paket').value = prdName[id].harga;
        }
        </script> 
    <script type="text/javascript">
       function suma(){
            var FirstNumberValue = document.getElementById('harga_paket').value;
            var SecondNumberValue = document.getElementById('jumlah_ticket').value;
            var activedates = document.getElementById('activedates').value;
            var hari = SecondNumberValue * activedates;
            var result =SecondNumberValue*FirstNumberValue ;
            document.getElementById('harga'). value= result;
            document.getElementById('activedate'). value= hari;
        }
    </script>
    <script type="text/javascript">
      <?php echo $jsArrayCompany; ?>
        function emailValue(idc){
            console.log(idc);
            document.getElementById('emailcompany').value = prdNameCompany[id].id;
        }
    </script>
  <script type="text/javascript">
    function companyValue() {
      let company = $("#company").val()
      $("#projectrelation").children().remove()
      $("#projectrelation").append('<option value="" selected = "selected" disabled = "disabled">Pilih Project</option>')
      $("#projectrelation").prop('disabled',true)
      if (company!='' && company!=null) {
        $.ajax({
        url:"{{url('')}}/company/"+company,
        success:function(res){
          $("#projectrelation").prop('disabled',false)
          $.each(res,function(index,data) {
            $("#projectrelation").append(`<option value="${data.id}">${data.nama_projects}</option>`)
          })
        }
      });
      }

    }
  </script>



@stop