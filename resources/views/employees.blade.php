@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                      <h4>Employee</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped table-hover" id="employees-table" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Emp Code</th>
                              <th>Department</th>
                              <th>Position</th>
                              <th>Emplooyee Type</th>
                              <th>Approver</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->lastname}}, {{$employee->firstname}} {{$employee->middlename}}</td>
                                    <td>{{$employee->badgeno}}</td>
                                    <td>{{$employee->department}}</td>
                                    <td>{{$employee->position}}</td>
                                    <td>{{$employee->emp_type}}</td>
                                    <td>@if($employee->approver_info) {{$employee->approver_info->lastname}}, {{$employee->approver_info->firstname}}@endif</td>
                                    <td>{{$employee->emp_status}}</td>
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

