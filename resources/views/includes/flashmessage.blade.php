@if(Session::has('message'))
    <div class="alert alert-success"><i class="fa fa-check mr-2" aria-hidden="true"></i>{{Session::get('message')}}</div>
@endif
 
@if(Session::has('errors'))
@foreach($errors->all() as $error)
    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle mr-2" aria-hidden="true"></i>{{$error}}</div>
@endforeach

@if(Session::has('messagedanger'))
        <div class="alert alert-danger"><i class="fa fa-check" aria-hidden="true"></i> &nbsp;{{Session::get('messagedanger')}}</div>
        @endif



@endif