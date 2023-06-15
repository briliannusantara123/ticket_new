 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 


@extends('layouts.master');
@section('content');
	<div class="main">
		<div class="main-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="panel">
							<div class="panel-heading">
								<section class="section">
									<div class="section-header">
										<h2>Request Header </h2>
									</div>
								</section>
								@if( $message = Session::get('success'))
									<div class="alert alert-success">
										<strong>{{$message}}</strong>
									</div>
								@endif
								<div class="modal-body">
								      <form action="/requestheader/create" method="POST" enctype="multipart/form-data">
								              {{csrf_field()}}
								 
								  <div class="form-group">
								    <input name="code"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$nomer}}">

								  </div>
								  <div class="form-group">
								    @if(auth()->user()->role == 4)
								    	<input type="hidden" name="id_company" value="{{auth()->user()->id_company}}">
								    	<input type="hidden" name="company" value="{{auth()->user()->company->nama}}">
								    @else
								    <div class="form-group">
								    <label for="company">Company</label>
								    <select name="id_company" class="form-control"  id="company" onchange='updateCompany()'required="required">
								    	<option value="" disabled="disabled" selected="selected">Pilih Company</option>
								      @foreach($company as $company)
								     
								      <option value="{{$company->idc}}">{{$company->nama}}</option>
								      
								      @endforeach
								    </select>
								  </div>
								    @endif
								    <div class="form-group">
								    <label for="exampleFormControlSelect1">Projects</label>
								    <select name="id_project" class="form-control" id="projectrelation" onchange='updateProjectRelation()' required="required">

					                            <option value="" disabled="disabled" selected="selected">Pilih Projects</option>
					                         @foreach($projects as $projects)
													     
										      <option value="{{$projects->id}}">{{$projects->nama_projects}}</option>
										      
										      @endforeach
										   </select>
										</div>
								    <div class="form-group">
									<label for="exampleInputEmail1">Priority</label>
									<select name="priority" class="form-control">
									<option disabled="disabled" selected="selected">Pilih Priority</option>
									 <option value="low">Low</option>
									 <option value="middle">Middle</option>
									 <option value="high">High</option>
									 <option value="critical">Critical</option>
									 </select>
								</div>
								<div class="form-group">
								    <input type="hidden" name="ticket" class="form-control" value="1" readonly="">
								</div>
								  <div class="form-group">
								    <label for="exampleInputEmail1">Description</label>
								    <textarea name="description" class="form-control"></textarea>

								  </div>
								  <div class="form-group">
								    <label for="exampleFormControlSelect1">Deadline</label>
								    <input type="date" name="dead_line" class="form-control" >
								</div>
								<div class="form-group">
								    <label for="exampleFormControlSelect1">Consultant</label>
								    <select name="user_id" class="form-control" required="required" id="user" disabled="disabled">

                            <option value="" disabled="disabled" selected="selected">Pilih Consultant</option>

								   </select>
								   <select name="user_id" class="form-control" required="required" id="c" hidden="" readonly="">

								   </select>
								</div>
		            <input type="hidden" name="email_client" value="{{auth()->user()->email}}">
		            <input type="hidden" name="status" value="1">
								  
								<div class="modal-footer">
								  <a href="/requestheader" class="btn btn-danger">Kembali</a>
								  <button type="button" class="btn btn-success" onclick="submit()">Submit</button>


								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    	<script type="text/javascript">
		function updateProjectRelation(){
			let projectrelation = $("#projectrelation").val()
			$("#user").children().remove()
			$("#user").append('<option value="" selected = "selected" disabled = "disabled">Pilih Consultant</option>')
			$("#user").prop('disabled',true)
			if (projectrelation!='' && projectrelation!=null) {
				$.ajax({
				url:"{{url('')}}/projectrelation/"+projectrelation,
				success:function(res){
					
					$.each(res,function(index,data){
						if (data.default_consultant == 1) {
							$("#user").prop('hidden',true)
							$("#c").prop('hidden',false)
						 if (data.id_jabatan == 3) {
							
							$("#c").append(`<option value="${data.id}">${data.username}</option>`)	
						 }
						}
						if (data.default_consultant == null) {
							if (data.default_consultant == 1) {
								$("#user").prop('hidden',true)		
							}else{
								
								$("#user").prop('disabled',false)
							}
						
						if (data.id_jabatan == 3) {
							$("#user").append(`<option value="${data.id}">${data.username}</option>`)	
						}
						}
					})
				}
			});
			}
			
		}
		
		function submit(){
        var url;
        var type;
        var result;
            url = 'http://localhost/belajar-laravel/public/pegawai';
            type = 'post';

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : type,
            url : url,
            data : {
                code : $('[name=code]').val(),
                id_company : $('[name=id_company]').val(),
                id_project : $('[name=id_project]').val(),
                priority : $('[name=priority]').val(),
                ticket : $('[name=ticket]').val(),
                description : $('[name=description]').val(),
                dead_line : $('[name=dead_line]').val(),
                user_id : $('[name=user_id]').val(),
                email_client : $('[name=email_client]').val(),
                status : $('[name=status]').val(),
            },
        });
    }
	</script>
	<script type="text/javascript">
		function updateCompany() {
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