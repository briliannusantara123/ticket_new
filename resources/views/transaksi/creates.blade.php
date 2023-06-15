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
										<h2>Pembelian Ticket </h2>
									</div>
								</section>
								@if( $message = Session::get('success'))
									<div class="alert alert-success">
										<strong>{{$message}}</strong>
									</div>
								@endif
								<div class="panel-body">
									<form action="/transaksi/create" method="POST" enctype="multipart/form-data">
				              {{csrf_field()}}
				  <div class="form-group">
				    <input name="code"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$nomer}}">

				  </div>
				  <div class="form-group">
				    
				    <input type="hidden" name="id_company" value="{{auth()->user()->id_company}}">
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
                 <select name="id_paket" class="form-control"class="form-control form-control-md" id="keperluan" onchange='changeValue(this.value)' required="required">

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
						      <input  type="number" class="form-control" name="jumlah_ticket" id="jumlah_ticket"onkeyup="suma();" />
						  </div>

						  <div class="form-group">
						    <label for="harga">Harga</label>
						    <input name="harga"type="number" class="form-control" id="harga" aria-describedby="emailHelp" required="" >

						  </div>
						  <div class="form-group">
						    <label for="activedate">Active Date</label>
						    <input name="activedate"type="number" class="form-control" id="activedate" aria-describedby="emailHelp" required=""  >
						    <input name=""type="hidden" class="form-control" id="activedates" aria-describedby="emailHelp" required="">
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
						    
						    <input type="hidden" name="id_support" value="1">
						  </div>
						  <input type="hidden" name="email_client" value="{{auth()->user()->email}}">
						  <input type="hidden" name="invoice" value="INV/{{$ldate}}-{{$nomer}}-{{$aid}}">
						  
						<div class="modal-footer">
						  <a href="/transaksi" class="btn btn-danger">Kembali</a>
						  <button type="submit" class="btn btn-primary">Submit</button>


						</form>

						 <script type="text/javascript">
						         <?php echo $jsArray; ?>
						        function changeValue(id){
						            console.log(id);
						            document.getElementById('jumlah_ticket').value = prdName[id].ticket;
						            document.getElementById('harga').value = prdName[id].harga;
						            document.getElementById('activedates').value = prdName[id].activedates;
						            document.getElementById('activedate').value = prdName[id].activedate;
						        }
						        </script> 
								<script type="text/javascript">
							       function suma(){
							            var FirstNumberValue = 2500;
							            var SecondNumberValue = document.getElementById('jumlah_ticket').value;
							            var activedates = document.getElementById('activedates').value;
           								 var hari = SecondNumberValue * activedates;
							            var result =SecondNumberValue*FirstNumberValue ;
							            document.getElementById('harga'). value= result;
							            document.getElementById('activedate'). value= hari;
							        }
							    </script>
									</div>
								</div>
							</div>
@stop