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
        
            <a class="btn btn-success" href="{{ route('student-registration.create')  }}"> <i class="nav-icon fas fa-plus"></i> Student Registration</a>
             
        </div>                 
        @include('includes/flashmessage')
        <br />
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <td style="width: 230px">
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
    </div>
 <script type="text/javascript">
    $('#delete').on('click', function () {
        alert('amresh');
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

 
	
	