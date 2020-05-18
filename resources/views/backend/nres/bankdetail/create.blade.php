@extends('layouts.master')
@section('container')
<body onload="showfield('Y')">
  <script src="{{ asset('public/js/fellow_solar_validation.js') }}"></script>
<div class="content-wrapper">

    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Add Bank Details</li>
      </ol>
  <div class="card card-login mx-auto mt-5 " >     
   <div class="card-header text-center"><h4 class="mt-2">Add Bank Details</h4></div>
      <div class="card-body">     
                    
        @include('includes/flashmessage')
        <div class="container-fluid border-top bg-white card-footer text-muted text-left " id="app">  
            
        <br />
            <form action="{{route('bank-details.store')}}" autocomplete="off" id="bankdetails_form" method="POST" >
			{{csrf_field()}}
			
			<h5><b>Student Details In Bank :</b></h5><hr>
            <div class="form-group">
			
                <div class="row">
				<?php $scheme_code =  Auth::user()->scheme_code; if($scheme_code == "3"){?>
				<div class="col-md-3">
						<select name="student_id" id="student_id" class="form-control">
						   <option value="">Select Student*</option>
						   <?php foreach($student_name as $k=>$v){  ?>
						      <option value="<?php echo $v->id;?>"><?php echo $v->firstname.' '.$v->lastname?></option>
						   <?php } ?>
						</select>
						@if ($errors->has('student_id'))
							<span class="invalid-feedback " role="alert">
								<strong>{{ $errors->first('student_id') }}</strong>
							</span>
						@endif
					</div>
				<?php } ?>
				
					<div class="col-md-3">
					<input type="text" readonly class="form-control phoneStartingWith6 numericOnly"  value="{{old('candidate_phone')}}" id="candidate_phone" placeholder="Phone No*" name="candidate_phone" maxlength="10">
							@if ($errors->has('candidate_phone'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('candidate_phone') }}</strong>
								</span>
							@endif
					</div>
					
					<div class="col-md-3">
						<input name="aadhar_no" readonly  value="{{old('aadhar_no')}}" class="form-control numericOnly" type="text" id="aadhar_no"  class="form-control" placeholder="Adhar No*"  data-type="adhaar-number" maxlength="14" >
						@if ($errors->has('aadhar_no'))
							<span class="invalid-feedback " role="alert">
								<strong>{{ $errors->first('aadhar_no') }}</strong>
							</span>
						@endif 
					</div>
				    
					<div class="col-md-3">
					<input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();"   value="{{old('pan')}}" id="pan_no" placeholder="Pan Number*" name="pan" maxlength="10" >
					@if ($errors->has('pan'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('pan') }}</strong>
						</span>
					@endif
				</div>	
					
                </div> 
    	    </div>
       
<h5><b>Student Bank Details :</b></h5><hr>
      	<div class="form-group">			
            <div class="row">
			       <div class="col-md-<?php if($scheme_code == "3"){ echo "3";}else{echo "6";}?>">
						<select name="bank_name" class="form-control" required>
							<option value="">Select Bank*</option>
							@foreach($bankdetils as $bankdetail)
							<option>{{ucfirst($bankdetail->bank)}}</option>
							@endforeach
						</select>
						@if ($errors->has('bank_name'))
							<span class="invalid-feedback " role="alert">
								<strong>{{ $errors->first('bank_name') }}</strong>
							</span>
						@endif
					</div>
					
			        <div class="col-md-3">
						<input name="branch_name"  value="{{old('branch_name')}}"  class="form-control onlyalpha" type="text" id="branch_name"  class="form-control onlyalpha" placeholder="Branch Name*" maxlength="15" > 
					@if ($errors->has('branch_name'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('branch_name') }}</strong>
						</span>
					@endif
					</div>
					
					 <div class="col-md-3">
						<input type="text" class="form-control  required numericOnly"   value="{{old('account_number')}}" id="account_no" placeholder="Account Number*" name="account_number" maxlength="12">
						@if ($errors->has('account_number'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('account_number') }}</strong>
						</span>
						@endif
					</div>
					
		        <div class="col-md-3">
					<input name="micr_code"  value="{{old('micr_code')}}" type="text" id="micr_code"  class="form-control  numericOnly" placeholder="MICR Code*" maxlength="9" > 
                    @if ($errors->has('micr_code'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('micr_code') }}</strong>
						</span>
					@endif
				</div>
                
            </div> 
	  	</div>
 		<div class="form-group">
			<div class="row">
			<div class="col-md-4">
					<b>NEFT Enable*</b><br/>
					<input type="radio" onclick="" name="neft" id="neft_n" value="Y" checked="checked"> <strong> Yes</strong>
					<input type="radio" onclick="" name="neft" id="neft_y" value="N"><strong> No</strong>
					@if ($errors->has('neft'))
					    <span class="invalid-feedback " role="alert">
						    <strong>{{ $errors->first('neft') }}</strong>
			  	        </span>
					@endif
				</div>	
			    <div class="col-md-4">			
			    	<b>RTGS Enable?*</b><br/>
					<input type="radio"  name="rtgs" onclick="showfield(this.value)"   value="Y" checked="checked"><strong> Yes</strong>
					<input type="radio"  name="rtgs" onclick="showfield(this.value)"   value="N"><strong> No</strong>
					@if ($errors->has('rtgs'))
				    	<span class="invalid-feedback " role="alert">
				        	<strong>{{ $errors->first('rtgs') }}</strong>
						</span>
					@endif
				</div>
				<div class="col-md-4" id="ifsc">
					
					 
				</div>
			</div> 
		</div>
        <div class="form-group">
            <div class="row">
	      		<div class="col-md-4">
				    <?php $categories_arr = array( 'Saving' ,'Current')?>
						<select name="account_type" id="account_type" class="form-control"  value="{{ old('account_type') }}">
						    <option value="">Saving/Current*</option>
							@foreach($categories_arr as $val)
								<option value="{{ $val }}" >{{ $val }}</option>
							@endforeach
						</select>
						 
					</div>
			        <div class="col-md-4">
					<input type="text" class="form-control"  value="{{old('bank_email')}}" id="bank_email" placeholder="Bank Email*" name="bank_email">
					@if ($errors->has('bank_email'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('bank_email') }}</strong>
						</span>
					@endif
					</div>	
					<div class="col-md-4">
						<input type="text" class="form-control phoneStartingWith6 numericOnly"  value="{{old('bank_mobile')}}" id="bank_mobile" placeholder="Bank Mobile No*" name="bank_mobile" maxlength="10">
							@if ($errors->has('bank_mobile'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('bank_mobile') }}</strong>
								</span>
							@endif
					</div>	
			    </div> 
			</div>
       
     
			<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				 <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Submit</button>
				<a class="btn btn-secondary" href="{{ url('bank-details') }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
			</div>
	
			<!--input class="btn btn-primary btn-block" type="submit"  name="submit"  value="<?php 
			//if(!empty($data['bank_details']->bank_id)) { ?>Update<?php //} else { ?>Submit<?php // }  ?>"-->
        </form> 
    </div>
    </div> </div>
</div></div>

</body>
	<style>
   strong{
       color: red;
       font-size: 11px;
   }
   .error{
       color: red;
      font-size: 12px;
   }
   </style>
   <script type="text/javascript">
   
   $("#student_id").on('change',function(){
    var getstudentData=$(this).val();
	// alert(getValue);
	  if(getstudentData){
       $.ajax({
          type:"GET",
          url:"{{url('api/get-student-adhaar-number')}}?getstudentData="+getstudentData,
          success:function(res){  
		  // alert(res);
		   var myObj = JSON.parse(res);
	       $('#candidate_phone').val(myObj.mobile);
           $('#aadhar_no').val(myObj.aadhar);
          }
       });
    } 
   });
   
   	 function showfield(name){   
  	 
	if(name == 'Y') {
		document.getElementById('ifsc').innerHTML = '<input type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();"   value="{{old("ifsc_code")}}" id="ifsc_code" placeholder="IFCS Code*" name="ifsc_code" maxlength="11">';
	}else{
		document.getElementById('ifsc').innerHTML='';
	}
}
   </script>
   <!-- <script src="{{ asset('js/app.js') }}"></script>  -->
   
<script>
  
 $(document).ready(function() { 

    });
</script>
@endsection
