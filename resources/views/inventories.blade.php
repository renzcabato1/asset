@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-4 col-md-4 col-lg-4">
                <form method='post' action='new-inventory' onsubmit='show();'  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @if(session()->has('status'))
                        <div class="alert alert-success alert-dismissable">
                            {{-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> --}}
                            {{session()->get('status')}}
                        </div>
                    @endif
                    @include('error')
                    <div class="card">
                        <div class="card-header">
                        <h4>New </h4>
                        </div>
                        <div class="card-body">
                            <label>Category</label>
                            <select class="form-control select2" name='category' style='width:100%' required>
                                <option value=''>Select category</option>
                                @foreach($categories as $category)
                                    <option value='{{$category->id}}'>{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            <label>Brand</label>
                            <input type="text" name='brand' class="form-control mb-2 mr-sm-2" value="{{ old('brand') }}" placeholder="Brand" required>
                            <label>Model</label>
                            <input type="text" name='model' class="form-control mb-2 mr-sm-2" value="{{ old('model') }}" placeholder="Model" required>
                            <label>Serial Number</label>
                            <input type="text" name='serial_number' class="form-control mb-2 mr-sm-2" value="{{ old('serial_number') }}" placeholder="Serial Number" required>
                            <label>Description</label>
                            <textarea onkeyup="setHeight('description');" style="height: 78px;" onkeydown="setHeight('description');" id='description' name='description' class="form-control" placeholder="Description" required>{{ old('description') }}</textarea>
                            <label>Date Purchased</label>
                            <input type="date" name='date_purchased' max='{{date('Y-m-d')}}' class="form-control mb-2 mr-sm-2" value="{{ old('date_purchased') }}" placeholder="Date Purchased" >
                            <label>Amount</label>
                            <input type="number" name='amount' max='{{date('Y-m-d')}}' class="form-control mb-2 mr-sm-2" value="{{ old('amount') }}" step='0.01' min='0.01' placeholder="Amount" >
                            <label>Employee Assigned(optional)</label>
                            <select class="form-control select2" name='employee' style='width:100%' >
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
                    </div>
                </form>
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
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($inventories as $inventory)
                              <tr>
                                <td>OBN-{{$inventory->category->code}}-{{str_pad($inventory->equipment_code, 4, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$inventory->category->category_name}}</td>
                                <td>{{$inventory->brand}}</td>
                                <td>{{$inventory->model}}</td>
                                <td>{{$inventory->serial_number}}</td>
                                <td><small>{!! nl2br(e($inventory->description)) !!}</small></td>
                                <td>{{$inventory->status}}</td>
                                <td></td>
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
<script type="text/javascript">
    setHeight('description');
    function setHeight(fieldId)
    {
        document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight+'px';
       
    }
</script>
@endsection

