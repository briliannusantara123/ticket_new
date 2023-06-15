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
                    <h2>Jabatan</h2>
                  </div>
                </section>
                @if( $message = Session::get('success'))
                  <div class="alert alert-success">
                    <strong>{{$message}}</strong>
                  </div>
                @endif
                <div class="col-md-12">
                <div class="panel-body">
									<a href="" class="btn fa fa-plus btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="for "></i>Tambahkan Jabatan</a> 
								</div>
              </div>
								<br>
									<table class="table table-hover" id="myTable">
										<thead>
										<tr>
                      <th>Code</th>
											<th>Jabatan</th>
											<th>Action</th>
										</tr>
										</thead>
									
										<tbody>
											@foreach( $jabatan as $jabatan )
											<tr>
                        <td>{{$jabatan->code}}</td>
												<td>{{$jabatan->nama_jabatan}}</td>
                        
												<td>
                          
													<a href="/jabatan/{{$jabatan->id}}/edit" class="btn btn-warning mt-3">View</a>
													<a href="/jabatan/{{$jabatan->id}}/delete" class="btn btn-danger mt-3" onclick="return confirm('Yakin Akan Menghapus Data mjabatan Tersebut?');">Hapus</a>
                        
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
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form action="/jabatan/create" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
  <div class="form-group">
    <input name="code"type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$nomer}}">

  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Jabatan</label>
    <input name="nama_jabatan"type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required="">

  </div>
 
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Submit</button>


</form>
@stop