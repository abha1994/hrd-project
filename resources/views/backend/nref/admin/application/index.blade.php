
@extends('layouts.master')
@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
           <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Processed Application
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">Processed Application</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   

              @include('includes/flashmessage')
	        <br />
            <table class="table table-bordered">
                <tr>
                    <!-- <th>No</th> -->
                    <!-- <th>Institute</th> -->
                    <!-- <th>Application</th> -->
                    <th>Name</th>
                    <!-- <th>Email</th> -->
                    <th>Mobile</th>
                    
                    <th>Course Amount</th>
                    <th>Bank </th>
                    <th>Pocessed By</th>
                    <th>Pocessed Date</th>
                     
                     
                </tr>
                @foreach ($data as  $d)
                <tr>

                   <!--  <td>{{ $loop->iteration }}</td> -->
 
                    <td>{{ $d->full_name }} </td>
                    <td>{{ $d->mobile_no }} </td> 
                    <td>{{ $d->payment_amount }} </td> 
                    <td>{{ $d->bank_name }} </td> 
                    
                    <td><span class="badge badge-success">{{ $prcessedBy }} </span></td> 
                    <td>{{ $diff = Carbon\Carbon::parse($d->created_date)->diffForHumans(Carbon\Carbon::now()) }}</td> 
                </tr>
                @endforeach
            </table>
            
        </div> 
    </div> </div> </div>
  
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection