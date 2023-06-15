<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script> 
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

@extends('layouts.master');
@section('content');
    <script type='text/javascript'>
    $(window).load(function(){
    $("#keperluan").change(function() {
                console.log($("#keperluan option:selected").val());
                if ($("#keperluan option:selected").val()) {

                    $('#default').prop('hidden', false);
                    $('#text').prop('hidden', false);

                }else if ($("#keperluan option:selected").val() == '') {
                    $('#default').prop('hidden', 'true');
                    $('#text').prop('hidden', 'true');
                    	
                }else {
                    $('#default').prop('hidden', 'true');
                    $('#text').prop('hidden', 'true');
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
										<h2>Consultan,Developer</h2>
									</div>
								</section>
								@if( $message = Session::get('success'))
									<div class="alert alert-success">
										<strong>{{$message}}</strong>
									</div>
								@endif
								<div class="panel-body">
									<ul>
										<ol>
										  <h2>Code Project : {{$projects->code}}</h2>
										  <h2>Project : {{$projects->nama_projects}}</h2>
										  <h2>Company : {{$projects->nama}}</h2>
										</ol>
									</ul>
									
									<a href="" class="btn fa fa-plus btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="for "></i>Tambahkan</a> 
									<a href="/projects" class="btn btn-danger">Kembali</a>
									
									
									<br>
									<br>

									<table class="table table-hover" id="myTable">
										<thead>
										<tr>
										  
                      					  <th>No</th>
										  <th>Nama</th>
										  <th>Jabatan</th>
										  <th>Action</th>
										</tr>
										</thead>
									
										<tbody>
										@if($p_relation->count())
											@foreach($p_relation as $key => $pr)
											 
											<tr>
												
												<td>{{++$key}}</td>
												@if($pr->default_consultant == 1)
													<td>{{$pr->username}} <i class="fas fa-check" title="Default Consultant"></i></td>
												@else
												 <td>{{$pr->username}}</td>
												@endif
												
												<td>@if($pr->role == 1)
													Developer
													@else
													Consultant
													@endif</td>
						                        <td>
													<a href="/pr/{{$pr->id}}/delete_pr" class="btn btn-danger mt-3">Delete</a>
												</td>
											</tr>
											
											@endforeach
										</tbody>
									@endif
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
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Project PIC</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form action="/pr/post" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <input type="hidden" name="id_project" value="{{$projects->id}}">
  				<div class="form-group">
		                
		                 <select name="id_user" class="form-control"class="form-control form-control-md" id="keperluan" onchange='consultantValue(this.value)' required="required">

                             <option disabled="disabled" selected="selected" value="">Pilih Consultant</option>
                         
                            <?php
                                $con = mysqli_connect("localhost", "root","", "ticket");
                                $query=mysqli_query($con, "select * from users order by id asc");
                                $result = mysqli_query($con, "select * from users");
                                $jsArrayConsultant = "var prdNameConsultant = new Array();\n";
                                 

                                while ($row = mysqli_fetch_array($result)) {
                                	if ($row['role'] == 3) {
                                	echo '<option name="id_user_consultant" value="' . $row['id'] . '">' .$row['username']. '- Consultant'. '</option>';
                                 $jsArrayConsultant .= "prdNameConsultant['" . $row['id'] . "'] = {ticket:'" . addslashes($row['email'])."',email:'".addslashes($row['email'])."',role:'".addslashes($row['role'])."'};\n";
                                }
                           
                               
                                }
                            ?>
                            
		                </select>
		            </div>
		            <div class="form-group">
		            	<h5 hidden="" id="text">Ceklis Untuk Menjadikan Default Consultant</h5>
		            	<input hidden="" type="checkbox" name="default_consultant" value="1" class="form-control" id="default">
		            </div>
		            <div class="form-group">
		                
		                 <select name="id_user_developer" class="form-control"class="form-control form-control-md" id="developer" onchange='changeValues(this.value)' required="required">

                             <option disabled="disabled" selected="selected" value="">Pilih Developer</option>
                         
                            <?php
                                $con = mysqli_connect("localhost", "root","", "ticket");
                                $query=mysqli_query($con, "select * from users order by id asc");
                                $result = mysqli_query($con, "select * from users");
                                $jsArray = "var prdName = new Array();\n";
                                 

                                while ($row = mysqli_fetch_array($result)) {
                                if ($row['role'] == 1) {
                                	echo '<option name="id_user_developer"  value="' . $row['id'] . '">' .$row['username']. '- Developer'. '</option>';
                                 $jsArray .= "prdName['" . $row['id'] . "'] = {ticket:'" . addslashes($row['email'])."',email:'".addslashes($row['email'])."',role:'".addslashes($row['role'])."'};\n";
                                }
                               
                                }
                            ?>
                            
		                </select>
		            </div>
		            
		            <input type="hidden" name="email" id="email">
		            <input type="hidden" name="id_jabatan" id="role">

		            <input type="hidden" name="emails" id="emails">
		            <input type="hidden" name="id_jabatans" id="roles">

  
					<div class="modal-footer">
					  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					  <button type="submit" class="btn btn-primary">Submit</button>


					</form>
							<script type="text/javascript">
						         <?php echo $jsArrayConsultant; ?>
						        function consultantValue(id){
						            console.log(id);
						            document.getElementById('email').value = prdNameConsultant[id].email;
						            document.getElementById('role').value = prdNameConsultant[id].role;
						        }
						        </script>
						        <script type="text/javascript">
						         <?php echo $jsArray; ?>
						        function changeValues(id){
						            console.log(id);
						            document.getElementById('emails').value = prdName[id].email;
						            document.getElementById('roles').value = prdName[id].role;
						        }
						        </script>  
@stop