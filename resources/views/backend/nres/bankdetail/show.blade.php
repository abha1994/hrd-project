@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">View Bank details</li>
      </ol>
  <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">     
   <div class="card-header text-center"><h4 style="    color: #2384c6;">View Bank details</h4></div>
      <div class="card-body">      
        <div  style="float: right; padding-bottom: 10px;">
        
           <a href="{{ route('bank-details.index') }}" > Back  </a>
           
        </div>                 
        @include('includes/flashmessage')
        <br />
        <div class="container-fluid border-top bg-white card-footer text-muted text-left " id="app">        
         <table id="example1" class="table table-bordered " role="grid" aria-describedby="example1_info">
        <tbody>
           
          <tr>
            <td>Candidate Name : </td>
            <td>{{$recorde->bank_cname}} </td>
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
            <td>Acount Number : </td>
            <td>{{$recorde->account_number}}</td>
          </tr>
           <tr>
            <td>RTGS Enable : </td>
            <td>{{$recorde->rtgs}}</td>
          </tr>
           <tr>
            <td>NEFT Enable : </td>
            <td>{{$recorde->neft}}</td>
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
            <td>Account Type : </td>
            <td>{{$recorde->account_type}}</td>
          </tr>
            <tr>
            <td>Bank Phone : </td>
            <td>{{$recorde->bank_phone}}</td>
          </tr>
           <tr>
            <td>Bank  Mobile : </td>
            <td>{{$recorde->bank_mobile}}</td>
          </tr>
          <tr>
            <td>Bank Email Id : </td>
            <td>{{$recorde->bank_email}}</td>
          </tr>  
           
           
        </tbody>
      </table>

        </div>
        </div> 
    </div></div></div>
<!--     <script src="{{ asset('js/app.js') }}"></script>  -->
<script type="text/javascript">
  
    $(document).ready(function () {
        
        $(".nav-link").removeClass('active');
        $("#libank").addClass('active');
    });

</script>
@endsection

