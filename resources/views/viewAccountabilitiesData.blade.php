  
  
@extends('layouts.header_borrow')
@section('content')
<div id="app">
    <section class="section">
        <div class="container">
          <div class="page-error">
            <div class="page-inner">
              <img alt="image"  src="{{asset('login_css/images/logo.png')}}" style='width:135px;'><br>
              <h2 class='mt-2'>Accountabilities Update</h2>
              <div class="page-description">
                {{-- Be right back. --}}
              </div>
            
            </div>
          </div>
        </div>
        <div class="row m-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-left">
                    <h4>Name :  @foreach($filtered->all() as $filt)
                        {{$filt->lastname}}, {{$filt->firstname}} {{$filt->middlename}} - {{$filt->badgeno}}
                        @endforeach <Br>
                     Department : {{$filt->department}}<br>
                     Position : {{$filt->position}}</h4><br>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover" id="employees-table" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Code </th>
                              <th>Category</th>
                              <th>Brand</th>
                              <th>Model</th>
                              <th>Serial Number</th>
                              <th>Description</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($employeeInventories as $accountability)
                            <tr>
                              <td>OBN-{{$accountability->inventoryData->category->code}}-{{str_pad($accountability->inventoryData->id, 5, '0', STR_PAD_LEFT)}}</td>
                              <td>{{$accountability->inventoryData->category->category_name}}</td>
                              <td>{{$accountability->inventoryData->brand}}</td>
                              <td>{{$accountability->inventoryData->model}}</td>
                              <td>{{$accountability->inventoryData->serial_number}}</td>
                              <td><small>{!! nl2br(e($accountability->inventoryData->description)) !!}</small></td>
                              <td>{{$accountability->status}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
          </div>
      </section>
</div>
@endsection