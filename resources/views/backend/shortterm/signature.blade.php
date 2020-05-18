@extends('layouts.master')
@section('container')
<script type="text/javascript" src="{{asset('public/jquery-validation/dist/jquery.validate.js')}}"></script>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Registration</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="container-fluid" id="app">   
      <div class="card card-primary card-outline">
          <div class="card-body">  
    <form action="{{url('uploadsignature/'.$insertedID)}}" method="post" enctype="multipart/form-data" id="signaturedoc">
      @csrf()
      
        <!-- <div  style="float: right; padding-bottom: 10px;">
        
            <a class="btn btn-success" href="{{route('short-term-program.create')}}"> New</a>
           
        </div>                 
        @include('includes/flashmessage') -->
        <input type="file" name="signature_doc" id="signature_doc" required="required">
        @if ($errors->has('signature_doc'))
                  <span class="help-block">
                      <strong>{{ $errors->first('signature_doc') }}</strong>
                  </span>
                 @endif
        <br /><br />
        <label style="color:#FF0000; font-size:11px;"> (File Format accepts: PDF &amp; Maximum Size: 5MB) <br>
        <span  style="font-size: 12px;" id="signature_doc_error"> </span>
        <br >
        <a href="{{ url('pdfview/'.$insertedID) }}" class="btn btn-primary">Download PDF</a>
       
        <input type="submit" name="uploadsignature" value="Upload Signature" class="btn btn-success">
        <a href="{{ route('short-term-program.edit',$insertedID) }}" class="btn btn-secondary">Back</a>
</form>   
        </div> 
    </div>
     </div> 
    </div>
<script type="text/javascript">
  $( document ).ready(function() {
    $('#signature_doc').bind('change', function() {
        var a=(this.files[0].size);
      if(a > 5000000) {
        $('#signature_doc').val('');
         $('#signature_doc').html('Maximum allowed size for file is "5MB" ');
         $('#signature_doc').css('color','red');
         return false;
      }else{
         $('#signature_doc').html('');
      };
      
      var fileExtension = ['pdf'];
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
        $('#signature_doc_error').html('Only pdf files allow');
         $('#signature_doc_error').css('color','red');
         $('#signature_doc').val('');
         return false;
      }
    
  });
    $("#signaturedoc").validate();
    $("#signaturedoc").validate({
      rules: {
        signature_doc:true
      }
    })
  });
</script>
@endsection

 
	
	