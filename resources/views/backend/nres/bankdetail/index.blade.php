@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Bank Details</li>
      </ol>
  <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">     
   <div class="card-header text-center"><h4 style="    color: #2384c6;">Bank Details</h4></div>
      <div class="card-body">    
        @include('includes/flashmessage')
        <br />

<?php $scheme_code =  Auth::user()->scheme_code; if($scheme_code == "3"){ ?>
        <div  style="float: right; padding-bottom: 10px;">
        <a class="btn btn-success" href="{{ route('bank-details.create') }}"> <i class="nav-icon fas fa-plus"></i> New</a>
        </div>                 
<?php } ?>    
            <table class="table table-bordered">
            
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Candidate Name</th>
                    <th>Bank Name</th>
                    <th>Branch</th>
                    <th>A/C Number</th>
                    <th>Aadhar No</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
           @foreach($banks as $bank)
            <tr>
                <td>{{$loop->iteration}}</td>
                 <td>{{$bank->bank_cname}} </td>
                <td>{{$bank->bank_name}} </td>
                <td>{{$bank->branch_name}}</td>
                <td>{{$bank->account_number}}</td>
                <td>{{$bank->aadhar_no}}</td>
                <td>
                    

                
                 
                   <a class="btn btn-info" href="{{url('bank-details/'.$bank->id)}}" style="color: white"> View </a>
                
                   <a  class="btn btn-primary" href="{{url('bank-details/'.$bank->id.'/edit')}}">Edit</a>
                
                
                        <!-- <a class="btn btn-sm btn-outline-secondary btn-sml mr-2" href="{{url('bank-details-registers/'.$bank->id)}}">Register </a> -->
                         
                    
                
                   
                </td>
            </tr>
            @endforeach
         </tbody>
        </table>

       
</div></div>
</div></div>

<script>
    $(document).ready(function () {
      
        $(".nav-link").removeClass('active');
        $("#libank").addClass('active');
    });
</script>

<!-- <script src="{{ asset('js/app.js') }}"></script>  -->
@endsection
	
	