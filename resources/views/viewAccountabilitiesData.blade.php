  
  
@extends('layouts.header_borrow')
@section('content')
<div id="app">
    <section class="section">
        <div class="container">
          <div class="page-error">
            <div class="page-inner">
              <img alt="image"  src="{{asset('login_css/images/logo.png')}}" style='width:50px;'><br>
              <h6 class='mt-2'>Accountabilities Update</h6>
              <div class="page-description">
                {{-- Be right back. --}}
              </div>
            
            </div>
          </div>
     
          <span style='font-size: 8px;'>Name :  {{$employee->lastname}}, {{$employee->firstname}}<Br>
            Department : {{$employee->department}} <br>
            Position :{{$employee->position}} </span>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover border border-dark " style=' font-size: 8px; '>
                <thead>
                  <tr class='border border-dark'>
                    <th  class='border border-dark'>Code</th>
                    <th class='border border-dark'>Category</th>
                    <th class='border border-dark'>Brand</th>
                    <th class='border border-dark'>Model</th>
                    <th class='border border-dark'>Serial Number</th>
                    <th class='border border-dark'>Description</th>
                    <th class='border border-dark'>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($employeeInventories as $accountability)
                  <tr class='border border-dark'>
                    <td class='border border-dark'>OBN-{{$accountability->inventoryData->category->code}}-{{str_pad($accountability->inventoryData->id, 4, '0', STR_PAD_LEFT)}}</td>
                    <td class='border border-dark'>{{$accountability->inventoryData->category->category_name}}</td>
                    <td class='border border-dark'>{{$accountability->inventoryData->brand}}</td>
                    <td class='border border-dark'>{{$accountability->inventoryData->model}}</td>
                    <td class='border border-dark'>{{$accountability->inventoryData->serial_number}}</td>
                    <td class='border border-dark'><small>{!! nl2br(e($accountability->inventoryData->description)) !!}</small></td>
                    <td class='border border-dark'>{{$accountability->status}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
          </div>
        </div>
      </section>
</div>
@endsection