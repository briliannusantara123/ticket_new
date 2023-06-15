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
                    <h2>Company</h2>
                  </div>
                </section>
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
									<a href="" class="btn fa fa-plus btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="for "></i>Tambahkan Company</a> 
								</div>
              </div>
								<br>
									<table class="table table-hover" id="myTable">
										<thead>
										<tr>
                      <th>Code</th>
											<th>Nama</th>
											<th>Email</th>
											<th>Telepon</th>
                      <th>Alamat</th>
                      <th>Action</th>
										</tr>
										</thead>
									
										<tbody>
											@foreach( $company as $company )
											<tr>
                        <td>{{$company->code}}</td>
												<td>{{$company->nama}}</td>
												<td>{{$company->email}}</td>
												<td>{{$company->telp}}</td>
                        <td>{{$company->alamat}}</td>
                        <td>
                          
													<a href="/company/{{$company->idc}}/edit" class="btn btn-warning mt-3">View</a>
													<a href="/company/{{$company->idc}}/delete" class="btn btn-danger mt-3" onclick="return confirm('Yakin Akan Menghapus Data mcompany Tersebut?');">Hapus</a>
                        
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
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form action="/company/create" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
  <div class="form-group">
    <input name="code"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$nomer}}">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nama</label>
    <input name="nama"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required="">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input name="email"type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required="">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Nomer Telepon</label>
    <input name="telp"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required="">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Alamat</label>
    <textarea name="alamat" class="form-control" required=""></textarea>

  </div>
  <div class="form-group">
    <input name="ticket"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="0">

  </div>
  <div class="form-group">
    <input name="ticket_used"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="0">

  </div>
 
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Submit</button>


</form>
@stop