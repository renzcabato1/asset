  
  
@extends('layouts.header_borrow')
@section('content')
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <img alt="image"  src="{{asset('login_css/images/logo.png')}}" style='width:135px;'>
                    <h2 class='mt-2'>Track Status</h2>
                    <div class="page-description">
                      {{-- Be right back. --}}
                    </div>
                </div>
            </div>
            <form method='get' action='' onsubmit='show();'  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-5">
                        <input class="form-control" id="reference_number"  width="100%;" type="text" value='{{$trackNumber}}' placeholder="Reference Number" name='reference_number' aria-label="Search" required>
                    </div>
                    <div class="col-md-5">
                        <input class="form-control" id="email"  width="100%;" type="email" name='email' value='{{$email}}' placeholder="Email" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Search
                        </button>
                    </div>
                </div>
            </form>
            @if($trackNumber)
                @if($result != null)
                    <div class="row mt-5">
                        <div class="col-md-6 ">
                            <h4>
                                
                            <b>Request : {{$result->category->category_name}}</b></h4>
                            <br>
                            <h6>
                            Reference Number : {{$trackNumber}}    <br>
                            Name : {{$result->name}}<br>
                            Company : {{$result->position}}<br>
                            Department : {{$result->department}}<br>
                            Position : {{$result->position}}<br>
                            Details <br>
                            <small>{!! nl2br(e($result->details)) !!}</small>
                            <br>
                            <br>
                            Attachment/s <br>
                            @foreach($result->attachments as $attachment)
                                <small><a href='{{url($attachment->attachment_url)}}' target='_blank'>{{$attachment->attachment_title}}  </a>  </small>
                            <br>
                            @endforeach</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="activities">
                                <div class="activity">
                                  <div class="activity-icon bg-primary text-white">
                                    <i class="fas fa-file-import"></i>
                                  </div>
                                  <div class="activity-detail mb-5">
                                    <div class="mb-2">
                                        <span class="text-job">Pending</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="activity">
                                  <div class="activity-icon bg-primary text-white mb-5">
                                    <i class="fas fa-user-check"></i>
                                  </div>
                                  <div class="activity-detail mb-5">
                                    <div class="mb-2">
                                      <span class="text-job">Viewed</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="activity">
                                  <div class="activity-icon bg-primary text-white">
                                    <i class="fas fa-user-tag"></i>
                                  </div>
                                  <div class="activity-detail mb-5">
                                    <div class="mb-2">
                                      <span class="text-job">Ready for Pick Up</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="activity">
                                  <div class="activity-icon bg-primary text-white">
                                    <i class="fas fa-check"></i>
                                  </div>
                                  <div class="activity-detail">
                                    <div class="mb-2">
                                      <span class="text-job">Deployed</span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                           </div>  
                        </div>
                    </div>
                @else
                    <div class="row mt-5 text-center">
                        <div class="col-md-12">
                            <h1>No Result Found</h1>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>
</div>
@endsection