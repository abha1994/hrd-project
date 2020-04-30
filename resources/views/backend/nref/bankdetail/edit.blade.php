@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bank Detail</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('bank-details')}}">Home</a></li>
              <li class="breadcrumb-item active">Bank Detail</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid" id="app">        
                    
        @include('includes/flashmessage')
        <br />
        <div class="container-fluid border-top bg-white card-footer text-muted text-left " id="app">        
        <form action="{{route('bank-details.update',$record->id)}}" autocomplete="off" id="bankdetails_form" method="POST" >
        	<input type="hidden" name="_method" value="PUT">
			{{csrf_field()}}
            <div class="form-group">
                <div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control onlyalpha required" value="{{$record->bank_cname}}" id="bank_cname" placeholder="Bank Candidate Name*" name="bank_cname" maxlength="15">
						@if ($errors->has('bank_cname'))
							<span class="invalid-feedback " role="alert">
								<strong>{{ $errors->first('bank_cname') }}</strong>
							</span>
						@endif
					</div>
                    <div class="col-md-6">
						   
						<select name="bank_name" class="form-control" required>
							<option value="0">Select Bank</option>
							@foreach($bankdetils as $bankdetail)
							<option value="{{$bankdetail->bank}}"  @if ($bankdetail->bank == $record->bank_name) {{ 'selected' }} @endif>{{ucfirst($bankdetail->bank)}}</option>
							@endforeach
						</select>
						@if ($errors->has('bank_name'))
							<span class="invalid-feedback " role="alert">
								<strong>{{ $errors->first('bank_name') }}</strong>
							</span>
						@endif
					</div>
                </div> 
    	    </div>
         	<div class="form-group">
			    <div class="row">
			        <div class="col-md-6">
						<input name="branch_name"  value="{{$record->branch_name}}"  class="form-control onlyalpha" type="text" id="branch_name"  class="form-control onlyalpha" placeholder="Branch Name" maxlength="15" > 
					@if ($errors->has('branch_name'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('branch_name') }}</strong>
						</span>
					@endif
					</div>
				    <div class="col-md-6">
						<input type="text" class="form-control  required" onkeypress="return isNumberKey(event)" value="{{$record->account_number}}" id="account_no" placeholder="Account Number*" name="account_number" maxlength="12">
						@if ($errors->has('account_number'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('account_number') }}</strong>
						</span>
						@endif
					</div>
				</div> 
			</div>

      	<div class="form-group">			
            <div class="row">
		        <div class="col-md-6">
					<input name="micr_code" onkeypress="return isNumberKey(event)"  value="{{$record->micr_code}}" type="text" id="micr_code"  class="form-control" placeholder="MICR Code" maxlength="9" > 
                    @if ($errors->has('micr_code'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('micr_code') }}</strong>
						</span>
					@endif
				</div>
                <div class="col-md-6">
					<b>NEFT Enable*</b>
					<input type="radio" onclick="" name="neft" id="neft_n" value="Y" {{ $record->neft == 'Y' ? 'checked' : ''}}> <strong> Yes</strong>
					<input type="radio" onclick="" name="neft" id="neft_y" value="N" {{ $record->neft == 'N' ? 'checked' : ''}} ><strong> No</strong>
					@if ($errors->has('neft'))
					    <span class="invalid-feedback " role="alert">
						    <strong>{{ $errors->first('neft') }}</strong>
			  	        </span>
					@endif
				</div>	
            </div> 
	  	</div>
 		<div class="form-group">
			<div class="row">
			    <div class="col-md-6">			
			    	<b>RTGS Enable?*</b>
					<input type="radio"  name="rtgs" onclick="showfield(this.value)" value="Y" {{ $record->rtgs == 'Y' ? 'checked' : ''}} ><strong> Yes</strong>
					<input type="radio"  name="rtgs" onclick="showfield(this.value)" value="N" {{ $record->rtgs == 'N' ? 'checked' : ''}}><strong> No</strong>
					@if ($errors->has('rtgs'))
				    	<span class="invalid-feedback " role="alert">
				        	<strong>{{ $errors->first('rtgs') }}</strong>
						</span>
					@endif
				</div>
				<div class="col-md-6" id="ifsc">
					<input type="text"  class="form-control" value="{{$record->ifsc_code}}" id="ifsc_code" placeholder="IFCS Code*" name="ifsc_code" maxlength="11">@if ($errors->has("ifsc_code"))<span class="help-block"><strong>{{ $errors->first("ifsc_code") }}</strong></span> @endif </span>
					 
				</div>
			</div> 
		</div>
        <div class="form-group">
            <div class="row">
	      		<div class="col-md-6">
				    <?php $categories_arr = array( 'Saving' ,'Current')?>
						<select name="account_type" id="account_type" class="form-control"  value="{{ old('account_type') }}">
						    <option value="">Saving/Current*</option>
							@foreach($categories_arr as $val)
								<option value="{{ $val }}" @if ($val == $record->account_type) {{ 'selected' }} @endif>{{ $val }}</option>
							@endforeach
						</select>
						 
					</div>
			        <div class="col-md-6">
						<input name="aadhar_no"  value="{{$record->aadhar_no}}" onkeypress="return isNumberKey(event)"  class="form-control" type="text" id="aadhar_no"  class="form-control" placeholder="Adhar No" maxlength="12" >
						@if ($errors->has('aadhar_no'))
							<span class="invalid-feedback " role="alert">
								<strong>{{ $errors->first('aadhar_no') }}</strong>
							</span>
						@endif 
					</div>
			    </div> 
			</div>
        <div class="form-group">
            <div class="row">
			 	<div class="col-md-6">
					<input type="text" class="form-control"  value="{{$record->pan}}" id="pan_no" placeholder="Pan Number*" name="pan" maxlength="10" >
					@if ($errors->has('pan'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('pan') }}</strong>
						</span>
					@endif
				</div>	
                <div class="col-md-6">
					<input type="text" class="form-control"  value="{{$record->bank_email}}" id="bank_email" placeholder="Bank Email*" name="bank_email">
					@if ($errors->has('bank_email'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('bank_email') }}</strong>
						</span>
					@endif
				</div>	
	        </div> 
	    </div>
        <div class="form-group">
            <div class="row">
			 	<div class="col-md-6">
					<input type="text" class="form-control phoneStartingWith6" onkeypress="return isNumberKey(event)" value="{{$record->bank_phone}}" id="bank_phone" placeholder="Bank Phone No*" name="bank_phone" maxlength="10">
							@if ($errors->has('bank_phone'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('bank_phone') }}</strong>
								</span>
							@endif
									</div>
					<div class="col-md-6">
						<input type="text" class="form-control phoneStartingWith6" onkeypress="return isNumberKey(event)"  value="{{$record->bank_mobile}}" id="bank_mobile" placeholder="Bank Mobile No*" name="bank_mobile" maxlength="10">
							@if ($errors->has('bank_mobile'))
								<span class="invalid-feedback " role="alert">
									<strong>{{ $errors->first('bank_mobile') }}</strong>
								</span>
							@endif
					</div>				    
				</div> 
			  </div>
 
			<input class="btn btn-primary btn-block" type="submit"  name="submit"  value="<?php 
			if(!empty($data['bank_details']->bank_id)) { ?>Update<?php } else { ?>Submit<?php }  ?>">
        </form> 
      </div>
        </div> 
    </div>
 
 
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
   	 function showfield(name){   
  	 
	if(name == 'Y') {
		document.getElementById('ifsc').innerHTML = '<input type="text"  class="form-control" value="" id="ifsc_code" placeholder="IFCS Code*" name="ifsc_code" maxlength="11">@if ($errors->has("ifsc_code"))<span class="help-block"><strong>{{ $errors->first("ifsc_code") }}</strong></span> @endif </span>';
	}else{
		document.getElementById('ifsc').innerHTML='';
	}
}
   </script>
@endsection
