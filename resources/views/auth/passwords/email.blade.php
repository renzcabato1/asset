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
              @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
              @endif
              <form method="POST" action="{{ route('password.email') }}"  aria-label="{{ __('Login') }}" onsubmit='show()' >
                @csrf
                  <div class="form-group">
                      <input id="email" autocomplete="off" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
                  </div>
            
                @if($errors->any())
                    <div class="form-group alert alert-danger alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <strong>{{$errors->first()}}</strong>
                    </div>
                @endif
                
            <div class="form-group">
                <button type="submit" class="form-control btn btn-primary submit px-3">{{ __('Send Password Reset Link') }}</button>
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

@endsection
