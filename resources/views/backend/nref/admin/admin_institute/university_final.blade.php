@extends('layouts.master')

@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Edit Institute</li>
      </ol>
<div class="card card-login mx-auto mt-5 " style="max-width: 100rem;">
	
	
<?php //dd($data['institute_data']);?>
     <div class="card-header text-center"><h4 style="color: #2384c6;">Update Institute Details</h4></div>
      <div class="card-body">
     	<form  enctype="multipart/form-data"  action="{{ route('final-university-submit',$data['institute_data']->institute_id) }}" class=""   autocomplete="off" id="institute_form" method="POST" >
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
			
				           

							<div class="form-group">
								<div class="row">
								    
									<div class="col-md-4">
								<a href="{{ route('pdfviewAdmin',['download'=>'pdf','candiID'=>$data['institute_data']->candidate_id]) }}">
								<input class="btn btn-primary " type="button" value="Download PDF"></a>
								</a>

								</div>
								
								
								<div class="col-md-4">
									<label for="name"  style="font-size: 13px;" class="control-label">Upload With Signature</label>
										<input name="file_upload_signature" type="file" class="form-control" value="{{ old('file_upload_signature')}}" id="file_upload_signature" >
                                        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 1MB)</label><br><span  style=" font-size: 12px;"id="annual_report_error"> </span>										
									    @if ($errors->has('file_upload_signature'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('file_upload_signature') }}</strong>
											</span>
										@endif
										@if ($annual_report_error = Session::get('ex_error'))
										 <div class="alert" style="color:red">
										   <strong>{{ $annual_report_error }}</strong>
										 </div>
									   @endif
									   
									   @if(isset($data['institute_data']->file_upload_signature))
									   <a href="{{ asset('public/uploads/nref/'.$data['institute_data']->file_upload_signature) }}" download><?php if($data['institute_data']->file_upload_signature) { echo $data['institute_data']->file_upload_signature; } ?></a>
								      <input type="hidden" name="final_repo" id="final_repo" value="<?php echo $data['institute_data']->file_upload_signature;?>" />
								     @endif
									</div>
									
									
									
								</div> 
							</div>

							
							<hr>
							<center>
								<div class="form-group" >
								   <input class="btn btn-primary" type="submit"  name="submit" value="Submit">
								   <button class="btn btn-primary"style="background-color: #ffffff;" ><a href="{{ URL('university')}}">Cancel</a></button>
								</div> 
							</center>
							
				    </form>
                </div>
            </div>
         </div>
     </div>
	 
	 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	 <style>
	    .BDC_CaptchaIconsDiv{
		   margin-left: 241px;
           margin-top: -54px;
	    }
	    strong{
           color: red;
           font-size: 11px;
        }
	    .error{
		   color: red;
		   font-size: 12px;
	    }
		/*div.card-body {
			height: 450px;
			overflow: scroll;
		}*/
	</style>

@endsection
	
	