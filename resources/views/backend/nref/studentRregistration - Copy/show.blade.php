@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Student Registration</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('student-registration')}}">Home</a></li>
              <li class="breadcrumb-item active">Student Registration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">        
        <div  style="float: right; padding-bottom: 10px;">
        
            <a class="btn btn-secondary" href="{{url('student-registration')}}">Back</a>
           
        </div>                 
        @include('includes/flashmessage')
        <br />
                   <table id="example1" class="table table-bordered " role="grid" aria-describedby="example1_info">
        <tbody>
           
          <tr>
            <td>Student Name : </td>
            <td>{{$recorde->firstname}} {{ $recorde->middlename}} {{$recorde->lastname}}</td>
          </tr>
           <tr>
            <td>Gender : </td>
            <td>{{$recorde->gender}}</td>
          </tr>
           <tr>
            <td>Address : </td>
            <td>{{$recorde->address}}</td>
          </tr>
           <tr>
            <td>Age : </td>
            <td>{{$recorde->dob}}</td>
          </tr>
           <tr>
            <td>Pincode : </td>
            <td>{{$recorde->pincode}}</td>
          </tr>
           <tr>
            <td>course : </td>
            <td>{{$recorde->course}}</td>
          </tr>
           <tr>
            <td>Country : </td>
            <td>{{$recorde->country}}</td>
          </tr>
           <tr>
            <td>State : </td>
            <td>{{$stateName[0]->state_name}}</td>
          </tr>
           <tr>
            <td>Destric : </td>
            <td>{{$disticName[0]->district_name}}</td>
          </tr>
          <!--  <tr>
            <td>Bank Name : </td>
            <td>{{$recorde->bankName}}</td>
          </tr>
           <tr>
            <td>Account Number : </td>
            <td>{{$recorde->accountNo}}</td>
          </tr>
          <tr>
            <td>ifscCode : </td>
            <td>{{$recorde->ifscCode}}</td>
          </tr> -->
          <tr>
            <td>Gate or NEET Score (in case of SRF & JRF)* : </td>
            <td><a href="{{asset('uploads/nref/student_registration/'.$recorde->gate_neet)}}" target="_blank">{{$recorde->gate_neet}}</a></td>
          </tr>
          <tr>
            <td>Highest Qualification : </td>
            <td><a href="{{asset('uploads/nref/student_registration/'.$recorde->highest_qulification)}}" target="_blank">{{$recorde->highest_qulification}}</a></td>
          </tr>
           <tr>
            <td> Aadhar Number of Student  : </td>
            <td>{{$recorde->aadhar}}</td>
          </tr>
           <tr>
            <td>Upload Bank Mandate Form  : </td>
            <td><a href="{{asset('uploads/nref/student_registration/'.$recorde->bankMandate)}}" target="_blank">{{$recorde->bankMandate}}</a></td>
          </tr>
          <tr>
            <td>Publication  : </td>
            <td><a href="{{asset('uploads/nref/student_registration/'.$recorde->publication)}}" target="_blank"> {{$recorde->publication}}</a></td>
          </tr>
           
        </tbody>
      </table>
        </div> 
    </div>
  <!--   <script src="{{ asset('js/app.js') }}"></script> -->
  <script type="text/javascript">
 $(document).ready(function () {
      $(".nav-link").removeClass('active');
      $("#listudent").addClass('active');
    });
</script>
@endsection
