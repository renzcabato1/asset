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
                              <th>Accountability</th>
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
                                    <td>
                                      <a href="#" onclick='viewAccountabilities({{$employee->badgeno}});' title='View Accountabilities' class="btn btn-icon btn-primary" data-toggle="modal" data-target="#viewAccountability"><i class="far fa-eye"></i></a>
                                      <a href="#" title='Generate QR Code' onclick="qrGenerateData('{{$employee->badgeno}}');" class="btn btn-icon btn-warning" data-toggle="modal" data-target="#generateQrCode{{$employee->badgeno}}"><i class="fas fa-qrcode"></i></a>
                                      
                                      {{-- <a href="#" class="btn btn-icon btn-success"><i class="fas fa-print"></i></a> --}}
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
@foreach($employees as $employee)
  @include('generateQrCode');
@endforeach
@include('view_accountabilities');
<script>
    var employeeInventories = {!! json_encode($employeeInventories->toArray()) !!};
    function viewAccountabilities(Data)
    {
        
        for(var i=0;i<employeeInventories.length;i++)
        {
          if(Data == employeeInventories[i].emp_code)
          {
            var tableTd = "<tr>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.id+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.category_id+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.brand+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.model+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.serial_number+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.description+"</td>";
                tableTd += "</tr>";

            $("#AccountabilitiesData" ).append(tableTd);
            console.log(employeeInventories[i].inventory_data);

          }
        }
    }
</script>
@endsection

