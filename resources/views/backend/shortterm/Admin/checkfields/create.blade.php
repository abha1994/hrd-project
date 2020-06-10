@extends('layouts.master')

@section('container')
<br />

  @php if (isset($data)) $chkvalue=json_decode($data->value);  
     $req= request()->get('user_id')  @endphp

  <style type="text/css">
 
   tr #hdr {
   text-align:center;
  }

  </style>


 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="{{ url('home')}}">Dashboard</a>
        </li>
       <li class="breadcrumb-item active">Check Fields</li>
      </ol>

    <!-- Icon Cards-->
    <div class="card card-login mx-auto mt-5">
	<div class="card-header text-center"><h4 class="mt-2">Check Fields</h4></div>
	 <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">  
		@include('includes/flashmessage')	

		   @if ($message = Session::get('success'))
        <div class="alert alert-primary">
          <p>{{ $message }}</p>
        </div>
      @endif
					
					<br><br>
		  <form action="{{route('report-check.store')}}" autocomplete="off" id="checkfield_form" method="POST" >
			{{csrf_field()}}	

			 <table style="width:100%" class="table table-striped" >
    <tr>

  <td>
  	<select class="form-control" name="officerid" id="officer_id" onchange="JavaScript:ck_location(this.value);">
    <option value="">Please Select</option>

    @foreach($dvalue as $ky=>$val)
    
    <option value="{{$val->id}}" @php if(isset($data->officer_id) && $data->officer_id== $val->id || $req==$val->id) { @endphp Selected @php } @endphp >{{$val->name}}</option>
    @endforeach

</select>
										@if ($errors->has('officer_id'))
											<span class="invalid-feedback " role="alert">
												<strong>{{ $errors->first('officer_id') }}</strong>
											</span>
										@endif
  </td>
    </tr>		
		<div class="ajaxPart" >

    		  <table style="width:100%" class="table table-striped" >
			    
				<thead>
				       <tr id="hdr" class="table-success"  >
				       	   <th>Sr.No</th>
							<th>Items</th>
							<th>Checkbox</th>
					  </tr>
					  </thead>
					  <tbody>
		
					  <tr>
					  	<td>1</td>
					  	<td>Utilization Certificate</td>
						<td>
						<div class="custom-control custom-checkbox">
  <input type="checkbox" name="checklist[]" class="custom-control-input" id="customCheck1" 
   @php  if(isset($chkvalue) && in_array(0, $chkvalue)) {  @endphp checked @php } @endphp value="0">
  <label class="custom-control-label" for="customCheck1"></label>
</div>
						</td>
							
						
					  </tr>

					   <tr>
					   	<td>2</td>
					  	<td>Statement of Audited Expenditure</td>
					  	<td>
				<div class="custom-control custom-checkbox">
  <input type="checkbox" name="checklist[]" class="custom-control-input" id="customCheck2" 
   @php  if( isset($chkvalue) && in_array(1, $chkvalue)) {  @endphp checked @php } @endphp value="1">
  <label class="custom-control-label" for="customCheck2"></label>
</div>
						</td>
												
					  </tr>

					  <tr>
					  	<td>3</td>
					  	<td>Participant List</td>
					  	<td>
					<div class="custom-control custom-checkbox">
  <input type="checkbox" name="checklist[]" class="custom-control-input" id="customCheck3" 
    @php  if( isset($chkvalue) && in_array(2, $chkvalue)) {  @endphp checked @php } @endphp value="2">
  <label class="custom-control-label" for="customCheck3" ></label>
</div>
						</td>
						
						
						
					  </tr>


					       <tr>
                             <td>4</td>					       	
					  	<td>Participant Attendance</td>
					  	<td>
					      <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="checklist[]" class="custom-control-input" id="customCheck4" @php  if( isset($chkvalue) && in_array(3, $chkvalue)) {  @endphp checked @php } @endphp value="3">
                          <label class="custom-control-label" for="customCheck4"></label>
                           </div>
						</td>
						
					  </tr>

					     <tr>
					     	<td>5</td>
					  	<td>Completion Report</td>
					  	<td>
					<div class="custom-control custom-checkbox">
  <input type="checkbox" name="checklist[]" class="custom-control-input" id="customCheck5"  @php  if( isset($chkvalue) && in_array(4, $chkvalue)) {  @endphp checked @php } @endphp value="4">
  <label class="custom-control-label" for="customCheck5"></label>
</div>
						</td>
						</tr>		

 <tr>
 	                    <td>6</td>
					  	<td>Impact Of Training</td>
					  	<td>
					  	<div class="custom-control custom-checkbox">
  <input type="checkbox" name="checklist[]" class="custom-control-input" id="customCheck6" 
    @php  if(isset($chkvalue) && in_array(5, $chkvalue)) {  @endphp checked @php } @endphp value="5">
  <label class="custom-control-label" for="customCheck6"></label>
</div>
						</td>
						
					  </tr>			

         <tr>
         	            <td>7</td>
					  	<td>Participant Feedback</td>
					  	<td>
					<div class="custom-control custom-checkbox">
  <input type="checkbox" name="checklist[]" class="custom-control-input" id="customCheck7" 
    @php  if( isset($chkvalue) && in_array(6, $chkvalue)) {  @endphp checked @php } @endphp value="6">
  <label class="custom-control-label" for="customCheck7"></label>
</div>
						</td>
					  </tr>	
		</table>			  
  
	
    @php if (isset($chkvalue) &&  is_array($chkvalue)) { @endphp
		 <tr>
		  
		    <td><input type="text" name="update" value="1" style="display:none;"></td>

		 </tr>			  									  

	@php  }  @endphp		  </tbody>
				</table> 
				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
				 <button type="submit" class="btn btn-primary" @php if(empty($req) ) {  @endphp disabled @php  }  @endphp><i class="fa fa-check" aria-hidden="true"></i>&nbsp; Submit</button>
				<a class="btn btn-secondary" href="{{ url('report-check') }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Cancel</a>
			</div>
		</form>
				</div>
        </div>
		
    </div>
</div>


  <script type="text/javascript">


   function ck_location(val) {

     if(val=='') {

     	document.location.href="{!! route('report-check.index'); !!}";

     	return false;
     }

    url=document.location.href="{!! route('report-check.index', ":id"); !!}"

    url = url.replace(':id', "user_id="+val);

    document.location.href=url;


   }

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
	
	