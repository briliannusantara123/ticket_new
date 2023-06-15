<?php 
  $previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
 ?>
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
										<h2>Message Testing</h2>
									</div>
								</section>
											<div class="col-md-12">
											<div class="panel">
											<div class="panel-heading">
											<section class="section">
												<div class="section-header">
													<h2>{{$rl->message_testing}}</h2>
												</div>
								</section>
								
					         				</div>
										</div>
									</div>
								</div>
					         </div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
              <a href="<?= $previous ?>" class="btn btn-danger">Kembali</a>
          </div> <!-- container / end -->
	</div>
@stop