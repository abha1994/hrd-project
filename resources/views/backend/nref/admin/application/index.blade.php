@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Processed Application</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Processed Application</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">   
       
        <div  style="float: right; padding-bottom: 10px;"> 
             <a href="{{url('export-application')}}" class="btn btn-outline-secondary font-weight-normal"><i class="fa fa-download" aria-hidden="true"></i></a> 
        </div>   
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
    </div>
     <script type="text/javascript">
 $(document).ready(function () {
      $(".nav-link").removeClass('active');
      $("#liRole").addClass('active');
    });
</script>
    <!--  <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection