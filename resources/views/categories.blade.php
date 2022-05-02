@extends('layouts.header')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-3 col-md-3 col-lg-3">
                <form method='post' action='new-category' onsubmit='show();'  enctype="multipart/form-data">
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
                        <h4>New Category</h4>
                        </div>
                        <div class="card-body">
                            {{-- <label >Image</label>
                            <input type="file" class="form-control form-control mb-2 mr-sm-2" name='image' required> --}}
                            <label >Category Name</label>
                            <input type="text" name='category_name' class="form-control mb-2 mr-sm-2" value="{{ old('category_name') }}" placeholder="Category Name" required>
                            <label >Category Code</label>
                            <input type="text" class="form-control mb-2 mr-sm-2" name='code' value="{{ old('code') }}"  placeholder="Category Code"  required>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-9 col-md-9 col-lg-9">
                <div class="card">
                    <div class="card-header">
                      <h4>Categories</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover" id="employees-table" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Category Code</th>
                              <th>Category Name</th>
                              <th>Status</th>
                              {{-- <th>Image</th> --}}
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                             @foreach($categories as $category)
                                <tr>
                                    
                                    <td>{{$category->code}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>@if($category->status == "Active") <small>Active</small> @else <small class='label label-danger'>Inactive</small>  @endif</td>
                                    {{-- <td>
                                        <figure>
                                            <img src="{{URL::asset($category->image_path)}}" class=" avatar avatar-lg zoom "   style='background-color:white;'>
                                        </figure>
                                    </td> --}}
                                    <td data-id='{{$category->id}}'>
                                        @if($category->status == "Active")
                                        <a href="#" class="btn btn-icon btn-primary btn-sm" data-toggle="modal" data-target="#editCategory"><i class="far fa-edit"></i></a> 
                                        <a href="#" class="btn btn-icon btn-sm btn-danger deactivate-category" title='Inactive'><i class="fas fa-times"></i></a>
                                        @else
                                        <a href="#" class="btn btn-icon btn-success btn-sm activate-category"><i class="fas fa-check"></i></a>
                                        @endif
                                    </td>
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
@include('edit_category')
@endsection

