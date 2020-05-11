@extends('layouts.master')
@section('container')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registered Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('registerd-student')}}">Home</a></li>
              <li class="breadcrumb-item active">Registered Student</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
       @include('includes/flashmessage')
     
    
       <div class="container-fluid border-top bg-white card-footer text-muted text-left" id="app">        
        <div>
            <table>
                <tr>
                    <td><form name="find" action="{{route('get-institute')}}" method="post">
                        @csrf
                         <select name="findStudentInst" id="findStudentInst"  class="form-control" required>
                            <option value="">Select Institute</option>
                            @foreach($inst as $val)
                            <option value="{{ $val->institute_id }}">{{$val->department_name}}</option>
                             @endforeach
                        </select>

                    </td>
                    <td>
                        <button class="btn btn-primary">Go</button>
                    </td>
                    </form>
                </tr>
            </table>
            
            
        </div>                 
        
        <br />
           

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

 
	
	