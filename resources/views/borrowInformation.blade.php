  
  
@extends('layouts.header_borrow')
@section('content')
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <img alt="image"  src="{{asset('login_css/images/logo.png')}}" style='width:135px;'>
                </div>
            </div>
            <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                <div class="card card-primary">
                <div class="card-header">
                    <h4>Borrower Information</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                    <div class="row">
                        <div class="form-group col-12">
                        <label for="frist_name">Name</label>
                        <input id="frist_name" type="text" class="form-control" name="frist_name" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Company</label>
                        <input id="email" type="email" class="form-control" name="email">
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Save
                        </button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>
@endsection