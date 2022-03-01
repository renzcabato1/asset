@extends('layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <img alt="image"  src="{{asset('login_css/images/logo.png')}}" style='width:135px;'>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
              <h3 class="mb-4 text-center">{{ __('Reset Password') }}</h3>
              <form method="POST" action="{{ route('password.update') }}"  aria-label="{{ __('Reset Password') }}" onsubmit='show()' >
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                  <div class="form-group">
                      <input id="email" autocomplete="off" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
                  </div>
            <div class="form-group">
              <input id="password-field" type="password" class="form-control" name="password" placeholder="Password" required >
              <span toggle="#password-field" id='no-password' onclick='show_password();' class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="form-group">
              <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required >
              <span toggle="#password-confirm" id='no-password-confirm' onclick='show_password_confirm();' class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            @if($errors->any())
                <div class="form-group alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>{{$errors->first()}}</strong>
                </div>
            @endif
            <div class="form-group">
                <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
            </div>
            <div class="form-group d-md-flex">
                <div class="w-50">
                   
                </div>
                <div class="w-50 text-md-right">
                    <a href="{{ route('login') }}" onclick='show()'  style="color: #fff">Back to login page</a>
                </div>
            </div>
          </form>
        
          </div>
            </div>
        </div>
    </div>
</section>

<script>
    function show_password()
    {
        $("#no-password").toggleClass("fa-eye fa-eye-slash");
        var input = $($("#no-password").attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    }
    function show_password_confirm()
    {
        $("#no-password-confirm").toggleClass("fa-eye fa-eye-slash");
        var input = $($("#no-password-confirm").attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    }
</script>
@endsection
