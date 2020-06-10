@extends('layouts.master')
@section('container')
<script src="{{ asset('public/js/shortTerm_application_validation.js') }}"></script>
<script>
    var page_url = "{{ url('getPendingApp') }}";
</script>
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Final Selection Application
     </li>
      </ol>
   
      <!-- Example DataTables Card-->
      <div class="card mb-3">
      <div class="card-header text-center"><h4 class="mt-2">Final Selection Application</h4></div>
         <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
      @include('includes/flashmessage')
      
     <!-- Filter Code Start -->
	  
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
					
			   <div class="col-md-2" style="float:left">
			   <select class="form-control" name="stateId" id="stateId" >
			   <option value="">Select State</option>
			   @if(isset($stateList)) @foreach($stateList as $state)
			   <option value="{{$state->statecd}}">{{$state->state_name}}</option>
			   @endforeach
			   @endif
			   
			   </select>
			</div>
			
			<div class="col-md-2" style="float:left">
			   <input class="date form-control"  type="text"  value="" name="datepicker_search_from" id="datepicker_search_from" Placeholder="From Date">
			</div>
			
			<div class="col-md-2" style="float:left">
			   <input class="date form-control"  type="text" name="dt21" id="dt21" Placeholder="To Date">
			</div>
					
					<!--<div class="col-md-2" style="float:left">
					
					<select class="form-control" name="programnew" id="programnew">
					<option value="">Select Program</option>
					</select>
					</div> -->
					
					<div class="form-group" >
					<input type="submit" id="filterSearch" class="btn btn-primary "  value= "Search" />
					</div>
		<form action="{{ route('exportAppPdf') }}" class=""  autocomplete="off" method="POST">
		<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
		<input type="hidden" name="instpdf" value="" id="instpdf">
		<input type="hidden" name="statepdf" value="" id="statepdf">
		<input type="hidden" name="frmdatepdf" value="" id="frmdatepdf">
		<input type="hidden" name="todatepdf" value="" id="todatepdf">

		<input type="hidden" name="institutetype" id="institutetype" value="6" >

		<button class="btn btn-info btn-sm" type="submit"  value="2" name="type" ><i class="glyphicon glyphicon-export icon-share"></i> Export Pdf </button>

		<button class="btn btn-info btn-sm" type="submit"  value="1" name="type" ><i class="glyphicon glyphicon-export icon-share"></i> Export Excel</button> &nbsp;

		</form>
	  
	  <!-- Filter Code Ended -->
        <div class="table-responsive card-box">
          <table id="example" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="width:30%;">Program Name</th>
                <th style="width:30%;">Coordinator Name</th>
                <th style="width:30%;">Coordinator Mobile</th>
                <th class="text-right">Action</th>
              </tr>
            </thead>
            <?php //dd($roles); ?>  
            <tbody> 
              @foreach ($records as $record)
                <tr>
                  <td>{{ $record->name_proposed_training_program }}</td>
                  <td>{{ $record->coordinator_name }}</td>
                  <td>{{ $record->coordinator_mobile }}</td>
                   <td><a class="btn btn-info" href="{{ url('final-selection/'.$record->short_term_id) }}" style="color: white">Show</a>
                    @if(!empty($record->signature_doc))
                    <a class="btn btn-success" href="{{ route('short-term-application.edit',$record->short_term_id) }}">Edit</a>
                    @endif
                    {!! Form::open(['method' => 'DELETE','route' => ['short-term-application.destroy', $record->short_term_id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger confirmation','id'=>'delete']) !!}
                         
                        {!! Form::close() !!}  
                   </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 
    </div>
  </div>
</div>
<script type="text/javascript">
  
$(document).ready(function () {
 
        $(".sidebar-menu li").removeClass("menu-open");
        $(".sidebar-menu li").removeClass("active");        
        $("#lishortterm").addClass('menu-open');        
        $("#ulshortterm").css('display', 'block');
        $(".nav-link").removeClass('active');
       // $("#liJobCategory").addClass("false");
       // $("#liCountry").addClass("false");
        $("#finalsec").addClass("active");
      });
</script>


@endsection

 
	
	