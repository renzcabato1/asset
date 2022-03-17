@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
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
                              <th>Action</th>
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
                                <td>
                                    <a href="#" title='Tag to Employee' class="btn btn-icon btn-primary" data-toggle="modal" data-target="#AssignToEmployee"><i class="fas fa-user-tag"></i></a></td>
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
@include('assign_employee')
@endsection

