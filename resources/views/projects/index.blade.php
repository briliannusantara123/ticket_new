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
                    <h2>Projects</h2>
                  </div>
                </section>
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
									<a href="" class="btn fa fa-plus btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="for "></i>Tambahkan Projects</a> 
								</div>
              </div>
								<br>
									<table class="table table-hover" id="myTable">
										<thead>
										<tr>
                      <th>Code</th>
											<th>Company</th>
											<th>Nama Projects</th>
                      <th>Ticket</th>
                      <th>Ticket Used</th>
                      <th>Sisa Ticket</th>
                      <th>Ticket Active</th>
											<th>Action</th>
										</tr>
										</thead>
									
										<tbody>
											@foreach( $projects as $projects )
											<tr>
                        <td>{{$projects->code}}</td>
												<td>{{$projects->nama}}</td>
												<td><a href="/pr/{{$projects->id}}/p_relation">{{$projects->nama_projects}}</a></td>
                        <td>{{$projects->ticket}}</td>
                        <td>{{$projects->ticket_used}}</td>
                        <td>{{$projects->ticket - $projects->ticket_used}}</td>
                        @if($projects->ticket_active == null)
                        <td>{{$projects->ticket_active}}</td>
                        @endif
                        @if($projects->ticket_active == !null)
                        <td>{{ date('d F Y',strtotime($projects->ticket_active))}}</td>
                        @endif
                        
												<td>
                          
													<a href="/projects/{{$projects->id}}/edit" class="btn btn-warning mt-3">View</a>
													<a href="/projects/{{$projects->id}}/delete" class="btn btn-danger mt-3" onclick="return confirm('Yakin Akan Menghapus Data mprojects Tersebut?');">Hapus</a>
                        
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
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan projects</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form action="/projects/create" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
  <div class="form-group">
    <input name="code"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$nomer}}">

  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Company</label>
    <select name="id_company" class="form-control"  id="company_id">
      @foreach($company as $company)
      <option value="{{$company->idc}}">{{$company->nama}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nama Project</label>
    <input name="nama_projects"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required="">

  </div>
 
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Submit</button>


</form>
@stop