@extends('layouts.master')
@section('container')

 <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
           <a href="{{ url('home')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Payment Process
		 </li>
      </ol>
	 
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	    <div class="card-header text-center"><h4 class="mt-2">Payment Process</h4></div>
	       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   

              @include('includes/flashmessage')
			
		
        <br />
            <table class="table table-bordered">
                <tr>
                    <!-- <th>No</th> -->
                    <th>Institute</th>
                    <!--th>Application</th-->
                    <th>Name</th>
                    <!-- <th>Email</th> -->
                    <th>Mobile</th>
                    <th>Course </th>
                    <th>Course Amount</th>
                    <th>Bank </th>
                    <th>Branch </th>
                    <th>A/C </th>
                    <th width="80px">Action</th>
                </tr>
                @foreach ($data as  $d)
                <tr>

                   <!--  <td>{{ $loop->iteration }}</td> -->
                    <td>{{ $d->department_name}}</td>
                    <td>{{ $d->firstname }} {{ $d->middlename }} {{ $d->lastname }}</td>
                    <td> {{ $d->mobile }} </td>
                    <!-- <td>{{ $d->email_id }}</td> -->
                    <td>{{ $d->course_name }}</td>
                    <td>{{ $d->amount }}</td>
                    <td>{{ $d->bank_name }}</td>
                    <td>{{ $d->branch_name }}</td>
                    <td>{{ $d->account_number }}</td>
                    <td><a href="{{url('fund-transfer/'. $d->id)}}" class="btn btn-primary">Process</a></td>
                </tr>
                @endforeach
            </table>
            
        </div> 
    </div>   </div>   </div>
     <script type="text/javascript">

 // $(document).ready(function () {
 	
      // $(".nav-link").removeClass('active');
      // $("#lifund").addClass('active');
    // });
</script>
</script>
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection