@extends('layouts.master')
@section('container')

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs--><br>
      <ol class="breadcrumb" >
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">List Of Student</li>
      </ol>
  <div class="card card-login mx-auto mt-5 " style="max-width: 65rem; margin-bottom: 28px;">     
   <div class="card-header text-center"><h4 style="    color: #2384c6;">List Of Student</h4></div>
      <div class="card-body">
       <a class="btn btn-success" style="float:right" href="{{ route('student-registration.create')  }}"> <i class="nav-icon fas fa-plus"></i> Student Registration</a>
            
        </div>                 
        @include('includes/flashmessage')
        <br />
            <table class="table table-bordered">
                <tr>
                    <th>S. No.</th>
                    <th>Student Name</th>
                    <th>Gender</th>
                    <th>Email ID</th>
                    <th>Mobile</th>
                    <th width="100px">Action</th>
                </tr>
                @foreach($students as $student)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$student->firstname}} {{ $student->middlename}} {{$student->lastname}}</td>
                    <td>{{$student->gender}}</td>
                    <td>{{$student->email_id}}</td>
                    <td>{{$student->mobile}}</td>
                    <td>
                    <a class="btn btn-info" href="{{ url('student-registration/'.$student->id) }}" style="color: white">Show</a>
                        
                            <a class="btn btn-primary" href="{{ url('student-registration/'.$student->id.'/edit') }}">Edit</a>
                        
                            {!! Form::open(['method' => 'DELETE','route' => ['student-registration.destroy', $student->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger confirmation','id'=>'delete']) !!}
                             
                            {!! Form::close() !!}   
                       
                    </td>
                </tr>
                @endforeach
            </table>

        </div> 
    </div>   </div>   
 <script type="text/javascript">
    $('#delete').on('click', function () {
        return confirm('Are you sure want to delete?');
    });
</script>
<!-- <script src="{{ asset('js/app.js') }}"></script>  -->
<script type="text/javascript">
 $(document).ready(function () {
      $(".nav-link").removeClass('active');
      $("#listudent").addClass('active');
    });
</script>
@endsection

 
	
	