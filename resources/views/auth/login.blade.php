@extends('layouts.app')

@section('content')
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
 <!--script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script-->

<section class="register-cust">
<div class="container">
    <div class="row justify-content-center" style="width:60%;margin-left:22%">
        <div class="col-md-10">
            @if(Session::has('message'))
                <div class="alert alert-success"><i class="fa fa-check mr-2" aria-hidden="true"></i>{{Session::get('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="login_form">
                        @csrf

                        <div class="form-group row">
                            <!--label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} / Username</label>-->

                            <div class="col-md-12">
                                 <input id="login" type="text"
                                   class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="login" value="{{ old('username') ?: old('email') }}" required autofocus placeholder="{{ __('E-Mail Address') }} / Username">
                                @if ($errors->has('username') || $errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <!--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>-->

                            <div class="col-md-12">
                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        {!! captcha_image_html('LoginCaptcha') !!}
                    </div>
					</div>
				</div>
                <div class="form-group">
                <div class="row">  
                    <div class="col-md-12">
                        <input class="form-control" type="text" value="{{old('CaptchaCode')}}" id="CaptchaCode" name="CaptchaCode" placeholder="Enter your captcha here..*"  required >
                        @if ($errors->has('CaptchaCode'))
                            <span class="help-block">
                                <strong style="color:red; font-size: 10px;">{{ $errors->first('CaptchaCode') }}</strong>
                            </span>
                        @endif
                         
                    </div>
                </div> 
            </div>





 




                       <!-- <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                           -->
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <input class="btn btn-primary btn-block" type="submit"  name="submit" value="Login">

                               
                            </div>
                        </div>
						
                    </form>
					<br>
					<div class="text-center">
							<a class="head" href="{{URL('login') }}">Login</a> | 
							<a class="head" href="{{URL('register') }}">Register</a> | 
							<a class="head" href="{{URL('forgetpassword') }}">Forgot Password</a> |
							<a class="head" href="{{URL('forgetuser') }}">Forgot Username</a> |
							<a class="head" href="{{URL('stuLogin') }}">Student Login</a>
						</div>
                </div>
            </div>
        </div>
    </div>
</div></section>
<style type="text/css">
 .head{
 	   font-size: 18px;
      font-weight: bold;
   }
    .help-block{
        color: red;
    }
	.register-cust{
		    padding: 100px 0px 90px;
    }
</style>
<script>
$(document).ready(function(){
 
    $("a[title ~= 'BotDetect']").removeAttr("style");
    $("a[title ~= 'BotDetect']").removeAttr("href");
    $("a[title ~= 'BotDetect']").css('visibility', 'hidden');

});
</script>

@endsection