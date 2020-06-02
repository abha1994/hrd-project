@extends('layouts.master')
@section('container')

<script>
  var page_url = "{{ url('getadminbankdata') }}";
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
			  
			    <div class="col-md-2" style="float:left">
		
		          <select class="form-control" name="shortermname" id="shortermname">
					
					<option value="">Select Short Term Name</option>
					@if(isset($shortTerm)) 
					@foreach($shortTerm as $termName)
					<option value="{{$termName->short_term_id}}">{{$termName->coordinator_name}}</option>
					@endforeach
					@endif
					</select>
					</div>
					
					<div class="form-group" >
					<input type="submit" id="filterSearch" class="btn btn-primary "  value= "Search" />
					</div>
			
			
			<br />
			
			<br />
           <div class="table-responsive card-box">
                <table id="bankdata" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                
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
											
<a href="{{ url('nrest-bankdetails-show/'.$bank->id) }}"><i class="fa fa-eye"></i></a>

										 
										
												 
											
										
										   
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
	var v1= $('#shortermname').val();
	
var _token = $('input[name="_token"]').val();

if(v1=="")
		{
			alert("Please Select Short Term");
			$("#shortermname").focus();
			return false;
		}
	else {
	$('#bankdata').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
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
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection