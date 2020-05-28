@extends('layouts.master')
@section('container')

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
			
			
			<br />
			
			<br />
           <div class="table-responsive card-box">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                
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

</script>
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection