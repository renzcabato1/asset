  
  
@extends('layouts.header_borrow')
@section('content')
<div id="app">
  
  <section class="section">
    <div class="container mt-5">
      <div class="page-error">
        <div class="page-inner">
          <img alt="image"  src="{{asset('login_css/images/logo.png')}}" style='width:135px;'><br>
          <h2 class='mt-5'>Borrow Asset</h2>
          <div class="page-description">
            {{-- Be right back. --}}
          </div>
          <div class="row">
            <div class="col-md-12">
                <input class="form-control" id="Search" onkeyup="myFunction()" width="100%;" type="text" placeholder="Search" aria-label="Search">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="page-error">
        <div class="page-inner">
          <div class='row'>
            @foreach($categories as $category)
              <div class='col-sm-2 col-sm text-center target'>
                  <a href="{{ url('BorrowInformation/'.$category->id) }}" onclick='show()' >
                    <img src="{{URL::asset($category->image_path)}}" class="img-fluid img-bordered-sm mb-2"  style='background-color:white;'>
                  </a>
                  <h5 class="display-5" >{{$category->category_name}}</h5>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection