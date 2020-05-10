@extends('layouts.master')

@section('container')

  <script src="{{ asset('public/js/institute_validation.js') }}"></script>
  
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Institute Details Form</li>
      </ol>
	    <!-- Icon Cards-->
	   <div class="card card-login mx-auto mt-5 " id="modalCont">
	     @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block" style="">
	        <button type="button" class="close" data-dismiss="alert">×</button>	
			<strong style="color: #343a40;font-size: 12px;">{{ $message }}</strong>
		</div>
		@endif


		@if ($message = Session::get('error'))
		<div class="alert alert-danger alert-block">
	        <button type="button" class="close" data-dismiss="alert">×</button>	
			<strong>{{ $message }}</strong>
		</div>
		@endif
							

     <div class="card-header text-center"><h4 class="mt-2">Institute Details Form</h4></div>
      <div class="card-body">
							
	<form enctype="multipart/form-data" action="{{ route('institute-form-post-final') }}" autocomplete="off" id="institute_formFinal" method="POST" >
			{!! csrf_field() !!}
			
			                    <div class="row">
								
								<div class="col-md-4">
								
								<a href="{{ route('pdfview',['download'=>'pdf']) }}">
								<input class="btn btn-primary " type="button" value="Download PDF"></a>
								</a>
								
								</div>
								
			                    <div class="col-md-6">
										<label for="name"  style="font-size: 12px;" class="control-label">Upload With Signature( <span style="color:red">Note- You need to download form first then upload</span>)</label> 
										<input name="file_upload_signature" type="file" class="form-control" id="file_upload_signature" value="{{ old('file_upload_signature')}}" required >
										<label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style="font-size: 12px;"id="file_upload_signature_error"> </span>		
										@if ($errors->has('file_upload_signature'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('file_upload_signature') }}</strong>
											</span>
										@endif
										@if ($file_upload_signature_error = Session::get('ex_error'))
										 <div class="alert" style="color:red">
										   <strong>{{ $file_upload_signature_error }}</strong>
										 </div>
									   @endif
										
									</div>
								
									</div>
									<hr>
								
							<center>
								<div class="form-group" >
								<button type="submit" value="Final Save" class="btn btn-primary">
		                        <i class="fa fa-check" aria-hidden="true"></i>&nbsp; Save</button>	
								<a href="{{url('/institute')}}" class="btn btn-primary buttonEvent"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp; Back</a>
								</div> 
							</center>
							
							 </form>
					
							
                
            
     </div>
	</div> 
 </div> </div>

 <!-- Modal Form -->
	 
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body" id="modalContent">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
	 

	 <style>
	   .error{
		   color: red;
		   font-size: 12px;
	    }
	</style>
	

    <!-- /.container-fluid-->
@endsection
	
	