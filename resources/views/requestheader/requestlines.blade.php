<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
										<h2>Request Lines</h2>
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
											
											<h3>Nomer Ticket : {{$rh->code}}</h3>
											<h3>Company : {{$rh->company->nama}}</h3>
											<h3>Description : {{$rh->description}}</h3>
											<h3>Status : @if($rh->status == 1)
						                          Request
						                        @endif
						                        @if($rh->status == 2)
						                         Progress
						                        @endif
						                        @if($rh->status == 3)
						                         Done
						                        @endif
						                        @if($rh->status == 4)
						                         Cancel By Client
						                        @endif
						                        @if($rh->status == 5)
						                         Cancel By Admin
						                        @endif
						                        @if($rh->status == 6)
						                         Close
						                        @endif
						                        
						                       {{$rh->message_client}}
						                       {{$rh->message_admin}}</h3>
											
										</ol>
									</ul>
									@if($rh->status == 6)
									<a href="/requestheader" class="btn btn-danger">Kembali</a>
									@else	
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-a">
									  Tambahkan Masalah
									</button>
									<a href="/requestheader" class="btn btn-danger">Kembali</a>
									@endif
									
									
									<br>
									<br>
									<table class="table table-hover" id="myTable">
										<thead>
										<tr>
										  
                 			<th>No</th>
											<th>Company</th>
											<th>Project</th>
					            <th>Description</th>
					            <th>Status</th>
					            <th>Developer</th>
					            <th>Gambar</th>
					            <th>Laps Time</th>
					            <th>Solve By</th>
					            <th>Date Solve</th>
					            <th>Date Close</th>
					            <th>Date Cancel</th>
										  <th>Action</th>
										</tr>
										</thead>
									
										<tbody>
										@if($rl->count())
											@foreach($rl as $key => $rl)
											 
											<tr>
												
												<td>{{++$key}}</td>
												<td>{{$rl->nama}}</td>
												<td>{{$rl->nama_projects}}</td>
						                        <td>{{$rl->description}}</td>
						                        @if(auth()->user()->role == 4)
						                        	@if($rl->status == 1)
						                          <td><p style="background-color: yellow; border-radius: 50px;text-align:center;">Request</p></td>
						                        @endif
						                        @if($rl->status == 2)
						                          <td><p style="background-color: yellow; border-radius: 50px;text-align:center;">Analysis</p></td>
						                        @endif
						                        @if($rl->status == 3)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Waiting Feedback</p></td>
						                        @endif
						                        @if($rl->status == 4)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Feedback Accepted</p></td>
						                        @endif
						                        @if($rl->status == 5)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Progress</p></td>
						                        @endif
						                        @if($rl->status == 6)
						                          <!-- <td><a href="" type="button"  data-toggle="modal" data-target="#modal-b"><p style="background-color: lightgreen; border-radius: 50px;text-align:center;">Testing</p></a></td> -->
						                          <td><a href="/requestlines/{{$rl->idl}}/mtesting"><p style="background-color: lightgreen; border-radius: 50px;text-align:center;">Testing</p></a></td>
						                        @endif
						                        @if($rl->status == 7)
						                          <td><p style="background-color: lightgreen; border-radius: 50px;text-align:center;">Solve</p></td>
						                        @endif
						                        @if($rl->status == 8)
						                          <td><p style="background-color: red;color: white; border-radius: 50px;text-align:center;">Cancel</p></td>
						                        @endif
						                        @if($rl->status == 9)
						                          <td><p style="background-color: black;color: white; border-radius: 50px;text-align:center;">Close</p></td>
						                        @endif
						                        @if($rl->status == 10)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Progress</p></td>
						                        @endif
						                        @if($rl->status == 11)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Progress</p></td>
						                        @endif
						                        @if($rl->status == 12)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Progress</p></td>
						                        @endif
						                        @else
						                        @if($rl->status == 1)
						                          <td><p style="background-color: yellow; border-radius: 50px;text-align:center;">Request</p></td>
						                        @endif
						                        @if($rl->status == 2)
						                          <td><p style="background-color: yellow; border-radius: 50px;text-align:center;">Analysis</p></td>
						                        @endif
						                        @if($rl->status == 3)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Waiting Feedback</p></td>
						                        @endif
						                        @if($rl->status == 4)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Feedback Accepted</p></td>
						                        @endif
						                        @if($rl->status == 5)
						                          <td><p style="background-color: lightblue; border-radius: 50px;text-align:center;">Progress</p></td>
						                        @endif
						                        @if($rl->status == 6)
						                          <!-- <td><a href="" type="button"  data-toggle="modal" data-target="#modal-b"><p style="background-color: lightgreen; border-radius: 50px;text-align:center;">Testing</p></a></td> -->
						                          <td><a href="/requestlines/{{$rl->idl}}/mtesting"><p style="background-color: lightgreen; border-radius: 50px;text-align:center;">Testing</p></a></td>
						                        @endif
						                        @if($rl->status == 7)
						                          <td><p style="background-color: lightgreen; border-radius: 50px;text-align:center;">Solve</p></td>
						                        @endif
						                        @if($rl->status == 8)
						                          <td><p style="background-color: red;color: white; border-radius: 50px;text-align:center;">Cancel</p></td>
						                        @endif
						                        @if($rl->status == 9)
						                          <td><p style="background-color: black;color: white; border-radius: 50px;text-align:center;">Close</p></td>
						                        @endif
						                        @if($rl->status == 10)
						                          <td><p style="background-color: green;color: white; border-radius: 50px;text-align:center;">Done Developer</p></td>
						                        @endif
						                        @if($rl->status == 11)
						                          <td><p style="background-color: green;color: white; border-radius: 50px;text-align:center;">On Develope</p></td>
						                        @endif
						                        @if($rl->status == 12)
						                          <td><p style="background-color: green;color: white; border-radius: 50px;text-align:center;">Done Consultant</p></td>
						                        @endif
						                        @endif
						                        
						                        <td>{{$rl->username}}</td>
						                        @if($rl->gambar == !NULL)
						                         <td><img src="{{ asset($rl->gambar) }}" class="img-fluid" style="width: 100px"></td>
						                        @else
						                        <td></td>
						                        @endif
						                        @if($rl->date_solve == !NULL)
						                        <td>{{$hari - date('d', strtotime($rl->date_solve))}} Hari</td>
						                        @else
						                        @if($rl->status == 9)
						                        <h1>-</h1>
						                        @endif
						                        <td></td>
						                        @endif
						                        <td>{{$rl->solve_by}}</td>
						                        @if($rl->date_solve == !NULL)
						                        <td>{{ date('d F Y',strtotime($rl->date_solve)) }}</td>
						                        @else
						                        <td></td>
						                        @endif
						                        @if($rl->date_close == !NULL)
						                        <td>{{ date('d F Y',strtotime($rl->date_close)) }}</td>
						                        @else
						                        <td></td>
						                        @endif
						                        @if($rl->date_cancel == !NULL)
						                        <td>{{ date('d F Y',strtotime($rl->date_cancel)) }}</td>
						                        @else
						                        <td></td>
						                        @endif
												<td>
													@if($rl->status == 9)

													@else
													<a href="/requestlines/{{$rl->idl}}/edit" class="btn btn-warning mt-3">View</a>
													@endif
														
														@if(auth()->user()->role == 2)
														@if($rl->status == 1)
														<a href="/requestlines/{{$rl->idl}}/analysis" class="btn btn-primary mt-3" onclick="return confirm('Yakin Akan Menganalysis Data Requestlines Tersebut?');">Analysis</a>
														@endif
														@endif
														@if(auth()->user()->role == 3)
														@if($rl->status == 1)
														<a href="/requestlines/{{$rl->idl}}/analysis" class="btn btn-primary mt-3" onclick="return confirm('Yakin Akan Menganalysis Data Requestlines Tersebut?');">Analysis</a>
														@endif
														@if($rl->status == 5)
														 @if($rl->id_developer == Null)
															<a href="/requestlines/{{$rl->idl}}/done" class="btn btn-success mt-3" onclick="return confirm('Yakin Akan Mengubah Status Requestlines Tersebut Menjadi Done?');">Done Consultant</a>
														 @endif
														@endif
														@endif
														@if(auth()->user()->role == 4)
														@if($rl->status == 1)
														<a href="/requestlines/{{$rl->idl}}/delete" class="btn btn-danger mt-3" onclick="return confirm('Yakin Akan Mengcancel Data Requestlines Tersebut?');">Cancel</a>
														@endif
														@if($rl->status == 2)
														<a href="/requestlines/{{$rl->idl}}/delete" class="btn btn-danger mt-3" onclick="return confirm('Yakin Akan Mengcancel Data Requestlines Tersebut?');">Cancel</a>
														@endif
														@endif
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
	<div class="modal fade" id="modal-a" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Masalah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form action="requestlines/post" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
  <div class="form-group">
    <input name="code"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$nomer}}">

  </div>
  <div class="form-group">
    <input name="id_header"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$rh->id}}">

  </div>
  @if(auth()->user()->role == 4)
  <input type="hidden" name="email_client" value="{{auth()->user()->email}}">
  <input type="hidden" name="email_consultant" value="{{$rh->email_consultant}}">
  @endif
  @if(auth()->user()->role == 2)
  <div class="form-group">
    <input type="hidden" name="id_company" value="{{$rh->company->idc}}">
  </div>
  @else
  <div class="form-group">
    <input type="hidden" name="id_company" class="form-control" value="{{$rh->company->idc}}" readonly="">
  </div>
  @endif
  <input type="hidden" name="id_project" value="{{$rh->id_project}}">
  <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea name="description" class="form-control" required=""></textarea>

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Upload File</label>
    <input type="file" name="gambar" class="form-control" required="">

  </div>
  <div class="form-group">
	<label for="exampleInputEmail1">Priority</label>
	<select name="priority" class="form-control">
		<option value="" selected="" disabled="disabled">Pilih Priority</option>
	 <option value="low">Low</option>
	 <option value="middle">Middle</option>
	 <option value="high">High</option>
	 <option value="critical">Critical</option>
	 </select>
</div>
<div class="form-group">
    <input type="hidden" name="ticket" class="form-control" value="0" readonly="">
</div>
<div class="form-group">
	<input type="hidden" name="status" value="1">
	<input type="hidden" name="user_id" value="{{$rh->user_id}}">
</div>


<div class="form-group">
    <label for="exampleFormControlSelect1">Deadline</label>
    <input type="date" name="dead_line" class="form-control" required="">
</div>

<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Submit</button>

</div>
</form>
</div>
</div>
</div>
</div>


<div class="modal fade" id="modal-b" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message Testing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop