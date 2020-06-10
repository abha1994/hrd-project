@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
           <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Bank details</li>
      </ol>

  <div class="card card-login mx-auto mt-5 " style="">     
   <div class="card-header text-center"><h4 class="mt-2">View Bank details of  <?php 
			// dd($student_name);
			foreach($student_name as $v){
				if($v->id == $recorde->student_id){
					 echo ucwords($v->firstname.' '.$v->lastname);
				}
			 }?> </h4></div>
      
        <div class="container-fluid border-top bg-white card-footer text-muted text-left " id="app">        
         <table id="example1" class="table table-bordered " role="grid" aria-describedby="example1_info">
        <tbody>
           
          <tr>
            <td>Candidate Name : </td>
			
            <td>  <?php 
			// dd($student_name);
			foreach($student_name as $v){
				if($v->id == $recorde->student_id){
					 echo ucwords($v->firstname.' '.$v->lastname);
				}
			 }?> 
		    </td>
          </tr>
		   <tr>
            <td>Bank Phone : </td>
            <td>{{$recorde->candidate_phone}}</td>
          </tr>
		   <tr>
            <td>Pan Number : </td>
            <td>{{$recorde->pan}}</td>
          </tr>
           <tr>
            <td>Aadhar Number : </td>
            <td>{{$recorde->aadhar_no}}</td>
          </tr>
		  <tr>
            <td>Address : </td>
            <td>{{$recorde->participant_address}}</td>
          </tr>
           <tr>
            <td>Bank Name : </td>
            <td>{{$recorde->bank_name}}</td>
          </tr>
           <tr>
            <td>Branch Name : </td>
            <td>{{$recorde->branch_name}}</td>
          </tr>
		   <tr>
            <td>Branch Address : </td>
            <td>{{$recorde->bank_address}}</td>
          </tr>
           <tr>
            <td>Acount Number : </td>
            <td>{{$recorde->account_number}}</td>
          </tr>
           <tr>
            <td>RTGS Enable : </td>
            <td>
			    @if($recorde->rtgs == "Y" )
			       YES 
					@else 
				   NO 
				@endif
			</td>
          </tr>
           <tr>
            <td>NEFT Enable : </td>
            <td>
			    @if($recorde->neft == "Y" )
			       YES 
					@else 
				   NO 
				@endif
			</td>
          </tr>
          
           <tr>
            <td>Account Type : </td>
            <td>{{$recorde->account_type}}</td>
          </tr>
           
           <tr>
            <td>Bank  Mobile : </td>
            <td>{{$recorde->bank_mobile}}</td>
          </tr>
          <tr>
            <td>Bank Email Id : </td>
            <td>{{$recorde->bank_email}}</td>
          </tr> 
          <tr>
            <td>PFMS Code : </td>
            <td>{{$recorde->pfms_code}}</td>
          </tr>		  
		   
		  <?php if(!empty($recorde->bank_mandate_form)){ ?>
		  <tr>
            <td>Bank Mandate Form : </td>
            <td><a href="{{asset('public/uploads/shortterm/BankMandateForm/'.$recorde->bank_mandate_form)}}">Download</a></td>
          </tr> 
		  <?php } ?>
		  
           
        
        </tbody>
      </table>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<a class="btn btn-secondary" href="{{ url('st-bank-details') }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
			</div>
        </div>
        </div> 
    </div></div>
<!--     <script src="{{ asset('js/app.js') }}"></script>  -->
<script type="text/javascript">
  
    $(document).ready(function () {
        
        $(".nav-link").removeClass('active');
        $("#libank").addClass('active');
    });

</script>
@endsection

