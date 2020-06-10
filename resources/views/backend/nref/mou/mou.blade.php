@extends('layouts.master')

@section('container')
<br />



 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">MOU</li>
      </ol>

        <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">MOU</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	
			
    	
		<div class="col-md-4" style="float:left">
					
					
					</div>
					<br><br>
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="acknow_slip">
			    
				<thead>
				       <tr>
							
							<th>Generate MOU</th>
							<th>Upload MOU</th>
							<th>Upload MOU By MNRE</th>
							
					  </tr>
					  </thead>
					  
					  
					  <tbody>
					  
					 
					 
					  <tr>
					  	
						<td><a href="resources\views\backend\nref\Mouformat.pdf" target="_blank" download>Download</a></td>
						
						<?php if($ins->mou){?>
						<td><a href="{{asset('public/uploads/nref/mou/'.$ins->mou)}}" target="_blank" download>Click Here to download</a></td>
						<?php } else {?>
						<td>
						<button type="button"  style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal" class="uploadValue">Upload</button>
						</td>
						<?php } ?>
						
						<?php if(!empty($ins->admin_mou)){?>
						<td><a href="{{asset('public/uploads/nref/mou/admin/'.$ins->admin_mou)}}" target="_blank" download>Click Here to download</a></td>
						<?php } else {?>
						<td>--</td>
						<?php }?>
						
					  </tr>
					 
					  
					  </tbody>
					 
				</table> 
				</div>
				
				
        </div>
		
    </div>

</div>


</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	  <h4 class="modal-title">Upload MOU</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ url('mou-form-post') }}" autocomplete="off" id="mou_form" method="POST" >
			{!! csrf_field() !!}
			
			<input type="hidden" name="student_id" id="Std_id" />
			<input type="hidden" name="month" id="mnth_id" />
			<input type="hidden" name="year" id="yr_id" />
		
					<div class="form-group" >
					<label>Upload File</label>
					<input type="file" name="filemou" class="form-control"  />
					</div>
		
		
					<div class="form-group" >
					<input type="submit" name="upload" id="uploadSubmit" class="btn btn-primary " />
					</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection
	
	