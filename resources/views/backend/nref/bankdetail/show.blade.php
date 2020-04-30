@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Bank Detial</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Bank Detial</li>
            </ol>
              
               
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid" id="app">        
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
    </div>
@endsection

