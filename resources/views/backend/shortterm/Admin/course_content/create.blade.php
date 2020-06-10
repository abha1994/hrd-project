@extends('layouts.master')

@section('container')

<script>
  var page_url = "{{ url('coursecontentfilter') }}";
</script>

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Uploaded Course and Practical Content</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">Uploaded Course and Practical Content</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	
		
		
		
		 <div class="col-md-2" style="float:left">
				          <select class="form-control" name="shortermname" id="shortermname">
					
					<option value="">Select Short Term</option>
					@if(isset($shortTerm)) 
					@foreach($shortTerm as $termName)
					<option value="{{$termName->user_id}}">{{$termName->institute_name}}</option>
					@endforeach
					@endif
					</select>
					</div>
					
					<div class="form-group" >
					<input type="submit" id="filterSearch" class="btn btn-primary "  value= "Search" />
					</div>
			
			
    	
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="content">
			    
				<thead>
				       <tr>
					        <th>Sr. No.</th>
							<th>Short Term Coordinator</th>
							<th>Course Content</th>
							<th>Pedagogy</th>
							<th>Practical Content</th>
							
					  </tr>
					  </thead>
					  
					  
					  <tbody>
					  
					 
					        <?php $i =1; ?>
								   @foreach($short_term_data as $std)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$std->coordinator_name}}</td>
										<td><?php if($std->course_content_doc != null){ ?>
							    <a href="<?php echo URL::asset('public/uploads/shortterm/course/'.$std->course_content_doc);?>" target="_blank">Click Here</a>
							<?php } else{?>
							 Not Uploaded
							<?php } ?></td>
										<td><?php if($std->padaggogy_doc != null){ ?>
							   <a href="<?php echo URL::asset('public/uploads/shortterm/padaggogy/'.$std->padaggogy_doc);?>" target="_blank">Click Here</a>
							<?php } else{?>
							Not Uploaded
							<?php } ?></td>
										<td><?php if($std->practical_content_doc != null){ ?>
							   <a href="<?php echo URL::asset('public/uploads/shortterm/practical/'.$std->practical_content_doc);?>" target="_blank">Click Here</a>
							<?php } else{?>
                             Not Uploaded
							<?php } ?></td>
										
									</tr>
                              <?php     $i++;   ?>  @endforeach
					 
					  
					  </tbody>
					 
				</table> 
				</div>
				
				
				<!--   -->
        </div>
		
    </div>
</div>

</div>

<script>

$(document).ready(function() {
$("#filterSearch").click(function(){
	var v1= $('#shortermname').val();
	
var _token = $('input[name="_token"]').val();

if(v1=="")
		{
			alert("Please Select Short Term");
			$("#shortermname").focus();
			return false;
		}
	else {
	$('#content').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { v1,_token }
                },

                'columns': [
				    { data: 'srn' },
                    { data: 'coordinator_name' },
					{ data: 'course_content' },
				    { data: 'debagogy' },
					{ data: 'practical_content' },
                ]
            });
	}

	
});
});
 

 
	 
</script>

<!-- /.container-fluid-->

@endsection
	
	