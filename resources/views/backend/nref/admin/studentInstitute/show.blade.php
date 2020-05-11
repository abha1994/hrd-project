@extends('layouts.master')
@section('container')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registered Student </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('registerd-student')}}">Home</a></li>
              <li class="breadcrumb-item active">Registerd Student </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>  
    <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">      
        <div  style="float: right; padding-bottom: 10px;"> 
            <a class="btn btn-primary" data-toggle="modal" data-target="#consider" style="color:white" href="#">Consider</a>
            <a class="btn btn-danger" data-toggle="modal" data-target="#nonConsider" style="color:white">Non Consider</a>      
            <a class="btn btn-secondary" href="{{url('get-instituteId/'.$ids)}}">Back</a>
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
<!----------------------- Consider Modal ----------------------------------->
<div class="modal fade" id="consider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Consider Sudent : NREI/2020/{{$recorde->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
        <form method="post" action="{{url('consider')}}" name="consider">
          @csrf
        <input type="hidden" name="backPage" value="{{ $ids }}">
        <input type="hidden" name="studentId" value="{{ $recorde->id }}">
         
        <div class="form-group">
          <label for="condier">Remarks</label>
          <textarea name="remarks" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="consider">Save changes</button>
      </div>
       </form>
    </div>
  </div>
</div>
<!----------------------- End of Consider modal-------------------->

<!----------------------- Consider Modal ----------------------------------->
<div class="modal fade" id="nonConsider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Non Consider Sudent : NREI/2020/{{$recorde->id}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
        <form method="post" action="{{url('nonconsider')}}" name="nonconsider">
          @csrf
        <input type="hidden" name="backPage" value="{{ $ids }}">
        <input type="hidden" name="studentId" value="{{ $recorde->id }}">
         
         <div class="form-group">
          <label for>Select the reason for not considered:</label>
          <select class="form-control" name="reason" id="reason" required>
            <option value="">Select</option>
            <option value="Id Proof is not Valid">Id Proof is not Valid</option>
            <option value="Experience not matches">Experience not matches</option>
            <option value="Qualification not matches">Qualification not matches</option>
            <option value="Desired Internship place is already fulfil">Desired Internship place is already fulfil</option>
            <option value="Others">Others</option>
          </select>
         </div>
        <div class="form-group">
          <label for="condier">Remarks</label>
          <textarea name="remarks" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="nonconsider">Save changes</button>
      </div>
       </form>
    </div>
  </div>
</div>
<!----------------------- End of Consider modal-------------------->
<script type="text/javascript">
$(document).ready(function () {
  $(".nav-link").removeClass('active');
  $("#listudent").addClass('active');
});
</script>
@endsection
