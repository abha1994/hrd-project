@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Payment Process</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Payment Process</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   <br />
        
        @include('includes/flashmessage')
        <br />
            <table class="table table-bordered">
                <tr>
                    <!-- <th>No</th> -->
                    <th>Institute</th>
                    <th>Application</th>
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
                    <td>{{ $d->application_cd}}</td>
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
    </div>
     <script type="text/javascript">
 $(document).ready(function () {
      $(".nav-link").removeClass('active');
      $("#liRole").addClass('active');
    });
</script>
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection