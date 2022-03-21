@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4">
              @if(session()->has('status'))
                  <div class="alert alert-success alert-dismissable">
                      {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> --}}
                      {{session()->get('status')}}
                  </div>
              @endif
              @include('error')
                <div class="card">
                    <form method='post' action='assign-asset' onsubmit='show();'  enctype="multipart/form-data">
                        {{ csrf_field() }}
                      
                        <div class="card-header">
                        <h4>Assignt to Employee </h4>
                        </div>
                        <div class="card-body">
                            <label>Assets</label>
                            <select class="form-control select2" name='asset[]' style='width:100%' required multiple >
                                {{-- <option value=''>Select assets</option> --}}
                                @foreach($inventories as $inventory)
                                    <option value='{{$inventory->id}}'>OBN-{{$inventory->category->code}}-{{str_pad($inventory->equipment_code, 5, '0', STR_PAD_LEFT)}}</option>
                                @endforeach
                            </select>
                            <label>Employee Assigned</label>
                            <select class="form-control select2" name='employee' style='width:100%' required >
                                <option value=''>Select employee</option>
                                @foreach($employees as $employee)
                                    @if($employee->emp_status == "Active")
                                        <option value='{{$employee->badgeno}}'>{{$employee->lastname}}, {{$employee->firstname}} {{$employee->middlename}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-8 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                      <h4>Inventories </h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover" id="employees-table" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>Category</th>
                              <th>Brand</th>
                              <th>Model</th>
                              <th>Serial Number</th>
                              <th>Description</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($inventories as $inventory)
                              <tr>
                                <td>{{$inventory->category->code}}-{{str_pad($inventory->equipment_code, 5, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$inventory->category->category_name}}</td>
                                <td>{{$inventory->brand}}</td>
                                <td>{{$inventory->model}}</td>
                                <td>{{$inventory->serial_number}}</td>
                                <td>{!! nl2br(e($inventory->description)) !!}</td>
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

