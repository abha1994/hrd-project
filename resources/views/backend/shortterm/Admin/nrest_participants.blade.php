@extends('layouts.master')
@section('container')
<script>
  var page_url = "{{ url('getadminparticipantdata') }}";
</script>

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">NREST Participants
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">NREST Participants</h4></div>
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
                <table id="participant" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                
                                <thead>
                                    <tr>
                                       <th>Sr.No.</th>
										<th style="width:30%;">Participant Name</th>
										<th>Gender</th>
										<th>Address</th>
										<th>DOB</th>
										<th>Aadhar No.</th>
										<th>District</th>
										<th>State</th>
										
										<th>Country</th>
										<th>Pincode</th>
										<th>Mobile</th>
										<th>Category</th>
										<th>View Aadhar</th>
										<th>View</th>
                                        
                                    </tr>
                                </thead>
                              <?php ?>  
                                <tbody> 
								<?php $i =1; ?>
								   @foreach($students as $student)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td> <?php echo ucwords($student->firstname.' '.$student->middlename.' '.$student->lastname);?></td>
										<td><?php if($student->gender == "1"){echo "Male";}else if($student->gender == "2"){echo "Female";}else if($student->gender == "3"){echo "Others";} ?></td>
										<td>{{$student->address}}</td>
										<td><?php echo date('d-m-Y',strtotime($student->dob));?></td>
										<td>{{$student->aadhar}}</td>
									   <td>
										 @foreach($district_data as $dist)
										 <?php if($student->districtcd == $dist->districtcd){
											 echo strtolower($dist->district_name);}?>
										 @endforeach
										 </td>
										
										<td>@foreach($state_data as $stat)
							 <?php if($student->statecd == $stat->statecd){
								            echo strtolower($stat->state_name);}?>
							 @endforeach</td>
										<td>INDIA</td>
										<td>{{$student->pincode}}</td>
										<td>{{$student->mobile}}</td>
										<td> <?php $categories_arr = array( '1'=>'General' ,'2'=>'OBC','3'=>'SC','4'=>'ST');
			 foreach($categories_arr as $k=>$v){
			 if($k == $student->category){ echo  $v; } }?></td>
										<td><a href="{{asset('public/uploads/shortterm/student_registration/upload_aadhar/'.$student->upload_aadhar)}}" target="_blank">Download</td>
										
										<td>
										
										<a href="{{ url('nrest-participants-show/'.$student->id) }}"><i class="fa fa-eye"></i></a></td>
									</tr>
               
                              <?php     $i++;   ?>  @endforeach
                                
                                </tbody>
                            </table>
						</div>
        </div> 
    </div></div>
	
	


</div>
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
	$('#participant').DataTable({
                "bDestroy": true,
				"bLengthChange": false,
                'serverMethod': 'post',
                'ajax': {
                    'url':page_url,
					'data': { v1,_token }
                },

                'columns': [
				    { data: 'srn' },
				    { data: 'firstname' },
                    { data: 'gender' },
					{ data: 'address' },
					{ data: 'dob' },
					{ data: 'aadhar' },
					{ data: 'districtcd' },
					{ data: 'statecd' },
					{ data: 'countrycd' },
					{ data: 'pincode' },
					{ data: 'mobile' },
					{ data: 'category' },
					{ data: 'upload_aadhar' },
					{ data: 'view' },
                ]
            });
	}

	
});
});

 



</script>
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection