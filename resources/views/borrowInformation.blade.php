  
  
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
                    <div class="text-right">
                        <a href="{{ url('/trackStatus') }}" target='_blank' >Track Status</a>
                        {{-- <a href="auth-register.html">Create One</a> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Borrower Information</h4>
                        </div>
                        <div class="card-body">
                            <form method='post' action='borrow-submit' onsubmit='show();'  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="category">Request</label>
                                    <select class='form-control select2' name='category'  id='category' required>
                                        <option></option>
                                        @foreach($categories as $category)
                                        <option value='{{$category->id}}'>{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="company">Company</label>
                                    <select class='form-control select2' name='company'  id='company' required>
                                        <option></option>
                                        @foreach($companies as $company)
                                        <option value='{{$company->descs}}'>{{$company->descs}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="department">Department</label>
                                    <select class='form-control select2' name='department' id='department'  required>
                                        <option></option>
                                        @foreach($departments as $department)
                                        <option value='{{$department->descs}}'>{{$department->descs}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="email">Company Email</label>
                                    <input id="email" type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="position">Position</label>
                                    <input id="position" type="text" class="form-control" name="position" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="details">Details</label>
                                    <textarea name="details" style="min-height: 100px;"  id='details' class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="details">Attachments(optional)</label>
                                    <input id="attachment" type="file" class="form-control" name="attachment[]" multiple>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Submit
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