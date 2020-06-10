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
			
			<?php $scheme_code =  Auth::user()->scheme_code; if($scheme_code == "3"){ ?>
				<div  style="float: right; padding-bottom: 10px;">
				   <a class="btn btn-success" href="{{ route('bank-details.create') }}"> <i class="nav-icon fas fa-plus"></i> Add Bank Details</a>
				</div>                 
			<?php } ?>  
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
											
<a href="{{url('bank-details/'.$bank->id)}}"><i class="fa fa-eye"></i></a>
<?php if($bank->is_final_submit == "0"){ ?>
<a href="{{url('bank-details/'.$bank->id.'/edit')}}"><i class="fa fa-edit"></i></a>
<?php } ?>
										 
										<?php //if($bank->bank_mandate_uploaded != "1") {?>
										   <!--a  class="btn btn-primary" href="{{url('bank-details/'.$bank->id.'/edit')}}">Edit</a-->
										   <?php //} ?>
										
										
												<!-- <a class="btn btn-sm btn-outline-secondary btn-sml mr-2" href="{{url('bank-details-registers/'.$bank->id)}}">Register </a> -->
												 
											
										
										   
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