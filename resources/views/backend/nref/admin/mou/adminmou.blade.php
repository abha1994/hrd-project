@extends('layouts.master')

@section('container')
<script>
  var page_url = "{{ url('getinsmou') }}";
</script>
<br />



 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Admin MOU</li>
      </ol>

        <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">Admin MOU</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	
		
		<div class="col-md-2" style="float:left">
		
		          <select class="form-control" name="insname" id="insname">
					
					<option value="">Select Institute</option>
					@if(isset($data['institute_data'])) 
					@foreach($data['institute_data'] as $inst)
					<option value="{{$inst->user_id}}"><?php echo $inst->institute_name; ?></option>					@endforeach
					@endif
					</select>
					</div>
					
					<div class="form-group" >
					<input type="submit" id="filterSearch" class="btn btn-primary "  value= "Search" />
					</div>
			
    	
		
					<br><br>
		<div class="ajaxPart" >
    		  <table id="adminmou" style="width:100%" class="table table-striped table-bordered dt-responsive nowrap" >
			    
				<thead>
				       <tr>
					        <th id="sort">S. No.</th>
							<th>Institute Name</th>
							<th>Generate University MOU</th>
							<th>Upload Admin MOU</th>
							
					  </tr>
					  </thead>
					  
					  
					  <tbody>
					  
					 
					 <?php $i=1; foreach($data['institute_data'] as $v){?>
					  <tr>
					  <td><?php echo $i; ?></td>
					  	<td><?php echo $v->name;?></td>
						
						<?php if($v->mou){?>
						<td><a href="{{asset('public/uploads/nref/mou/'.$v->mou)}}" target="_blank" download>Click Here to download</a></td>
						<?php } else {?>
						<td>MOU Not Uploaded</td>
						<?php } ?>
				  
				  <?php if($v->admin_mou_user_id){?>
                         <td><a href="{{asset('public/uploads/nref/mou/admin/'.$v->admin_mou)}}" target="_blank" download>Click Here to download</a></td>
				  <?php } else {?>
				  <?php if(!empty($v->mou)){?>
						<td><button type="button"  userID="<?php echo $v->user_id;?>" style="border: 1px solid red;padding: 4px 4px;background: red;color: white;" data-toggle="modal" data-target="#myModal" class="uploadValue1">Upload</button>
						</td>
				  <?php }else{ ?><td> <?php echo "---";} ?></td>
						<?php } ?>
                  
						
					  </tr>
					 <?php $i++; } ?>
					  
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
	  <h4 class="modal-title">Upload Admin MOU</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
	  
	  <form enctype="multipart/form-data" action="{{ url('admin-mou-form-post') }}" autocomplete="off" id="mou_form" method="POST" >
			{!! csrf_field() !!}
			
			<input type="hidden" name="user_id" id="User_id" />
			
		
					<div class="form-group" >
					<label>Upload Admin File</label>
					
					<input type="file" name="fileadminmou" class="form-control"  />
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


<script>
$(document).on('click', ".uploadValue1", function(){
	
var curVal= $(this).attr('userID');
	
$("#User_id").val(curVal);


});  

$(document).ready(function() {
$("#filterSearch").click(function(){
	var v1= $('#insname').val();
	
var _token = $('input[name="_token"]').val();

if(v1=="")
		{
			alert("Please Select Institute");
			$("#insname").focus();
			return false;
		}
	else {
	$('#adminmou').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { v1,_token }
                },

                'columns': [
				    { data: 'srn' },
				    { data: 'institute_name' },
                    { data: 'mou' },
					{ data: 'admin_mou' },
					
                ]
            });
	}

	
});
});
 


</script>

@endsection
	
	