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
       <li class="breadcrumb-item active">ShortTermReports</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">ShortTermReports</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	

		   @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif
					  <div class="col-md-2" style="float:left">
		
		          <select class="form-control" name="shortermname" id="shortermname">
					
					<option value="">Select Short Term Name</option>
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
					<br><br>
		<div class="ajaxPart" >
    		  <table style="width:100%" class="table table-bordered" id="atten_table">
			    
					
	         
					
				<thead>
				       <tr>
							<th>Upload Utiltization Certificate</th>
							<th>Upload Audited Statement Of Expenditure</th>
							<th>Upload the Programme Completion Report</th>
							<th>Impact of trainning</th>
					  </tr>
					  </thead>
					  <tbody>
		                  <?php if(!empty($data->utilization_cetificate_doc)) { ?>
					  <tr>
					  	<td>Upload Utiltization Certificate</td>
						
						<td><a href="{{ URL::route('download-content',[1]) }}">Download</a></td>
	         <td><a href="<?php echo URL::asset('public/uploads/report/utilize/'.$data->utilization_cetificate_doc);?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					  </tr>
                     <?php }   ?>
                     <?php if(!empty($data->audited_statement_doc)) { ?>
                      <tr>
					  	<td>Upload Audited Statement Of Expenditure</td>
						
						<td><a href="{{ URL::route('download-content',[2]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/report/practical/'.$data->audited_statement_doc); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					  </tr><?php }  ?>	

						<?php if(!empty($data->programme_completion_doc)) { ?>
					       <tr>
					  	<td>Upload the Programme Completion Report</td>
					
						<td><a href="{{ URL::route('download-content',[3]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/report/program/'.$data->programme_completion_doc); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					  </tr>
                        <?php }  ?>
					    <?php if(!empty($data->impact_tranning)) { ?>
					     <tr>
					  	<td>Impact of training</td>
						
						<td><a href="{{ URL::route('download-content',[4]) }}">Download</a></td>
						<td><a href="<?php echo URL::asset('public/uploads/report/training/'.$data->impact_tranning); ?>" target="__blank" ><i class="fa fa-eye"></i></a></td>
					 
					  </tr>					  
					 <?php }  ?>
					  </tbody>
				</table> 
				</div>
        </div>
		
    </div>
</div>





</div>
<script>
 var getadminshorttermreport= "{{ url('getadminshorttermreport') }}";
</script>
<script>




$(document).ready(function() {
	$("#filterSearch").click(function() { 
       var shortermname=$("#shortermname").val();
	   var _token = $('input[name="_token"]').val();
	
		if(shortermname=="")
		{
			alert("Please Select Short Term");
			$("#shortermname").focus();
			return false;
		}
	else {
		
		$('#atten_table').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':getadminshorttermreport,
					'data': { shortermname,_token }
                },

                'columns': [
				    { data: 'utilization_cetificate_doc' },
                    { data: 'audited_statement_doc' },
					{ data: 'programme_completion_doc' },
					{ data: 'impact_tranning' },
                ]
            });
	
	
	}

	
	});
});

</script>
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
	.has-error .form-control {
    border-color: #a94442;
}
</style>


<!-- /.container-fluid-->

@endsection
	
	