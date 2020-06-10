@extends('layouts.master')
@section('container')
<script>
  var pageurl = "{{ url('getinbanknref') }}";
</script>
 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
           <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Bank Details
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">Bank Details</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   

              @include('includes/flashmessage')
			  <div class="col-md-4" style="float:left">
		
		               <select class="form-control commoanPara" name="insname" id="insname">
						<option value="">Select University</option>
						<?php foreach($institute_data as $inst) { ?>
						<option value="<?php echo $inst->institute_id; ?>"><?php echo $inst->institute_name; ?></option>
						<?php } ?>
						</select> 
						
		</div>
		<div class="form-group" >
					<input type="submit" id="filterSearch" class="btn btn-primary "  value= "Search" />
					</div>

			
			<br />
			
			<br />
         <div class="ajaxPart" >
    		  <table id="adminbank" style="width:100%" class="table table-striped table-bordered dt-responsive nowrap" >
                                
                                <thead>
                                    <tr>
                                        <th>S. No.</th>
										<th>Candidate Name</th>
										<th>Bank Name</th>
										<th>A/C Number</th>
										<th>Aadhar No</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                              <?php //dd($roles); ?>  
                                <tbody> 
								<?php $i =1; ?>
								   @foreach($banks as $bank)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>
										 <?php foreach($student_name as $v){
											if($v->id == $bank->student_id){
												 echo ucwords($v->firstname.' '.$v->lastname);
											}
										 }?> </td>
										<td>{{$bank->bank_name}} </td>
										<td>{{$bank->account_number}}</td>
										<td>{{$bank->aadhar_no}}</td>
										<td>
											
<a href="{{ url('nref-bankdetails-show/'.$bank->id) }}"><i class="fa fa-eye"></i></a>

										 
										
												 
											
										
										   
										</td>
									</tr>
                              <?php     $i++;   ?>  @endforeach
                                
                                </tbody>
                            </table>
						</div>
        </div> 
    </div></div></div>
     <script type="text/javascript">






$(document).ready(function() {
$("#filterSearch").click(function(){
	var v1= $('#insname').val();
;
var _token = $('input[name="_token"]').val();

if(v1=="")
		{
			alert("Please Select Institute");
			$("#insname").focus();
			return false;
		}
	else {
	$('#adminbank').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':pageurl,
					'data': { v1,_token }
                },

                'columns': [
				    { data: 'srn' },
				    { data: 'candidate_name' },
                    { data: 'bank_name' },
					{ data: 'accno' },
					{ data: 'aadhar' },
					{ data: 'view' },
					
                ]
            });
	}

	
});
});
 


</script>


@endsection