@extends('layouts.header')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                      <h4>Accountabilities</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover" id="employees-table" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Name</th>
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
                            @foreach($employeeInventories as $accountability)
                            <tr>
                              <td>
                                {{$accountability->transactions->name}}
                              </td>
                              <td>OBN-{{$accountability->inventoryData->category->code}}-{{str_pad($accountability->inventoryData->equipment_code, 4, '0', STR_PAD_LEFT)}}</td>
                              <td>{{$accountability->inventoryData->category->category_name}}</td>
                              <td>{{$accountability->inventoryData->brand}}</td>
                              <td>{{$accountability->inventoryData->model}}</td>
                              <td>{{$accountability->inventoryData->serial_number}}</td>
                              <td><small>{!! nl2br(e($accountability->inventoryData->description)) !!}</small></td>
                              <td><a onclick="getData({{$accountability}})" data-toggle="modal" data-target="#return_unit"href="#" class="btn btn-icon btn-sm icon-left btn-primary" title='Return Unit'><i class="far fa-paper-plane"></i> Return</a></td>
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
@include('return_unit');
<script type="text/javascript">
  function getData(accountabilityId)
  {
    // console.log(accountabilityId);
    document.getElementById("idAccountability").value = accountabilityId.id;
    document.getElementById("status").value = "";
    document.getElementById("description").value = "";
    document.getElementById("asset_code").value = accountabilityId.transactions.asset_code;
    document.getElementById("emp_code").value = accountabilityId.transactions.emp_code;
    document.getElementById("name").value = accountabilityId.transactions.name;
    document.getElementById("position").value = accountabilityId.transactions.position;
    document.getElementById("department").value = accountabilityId.transactions.department;
    document.getElementById("email").value = accountabilityId.transactions.email;
  }

  function setHeight(fieldId)
  {

      document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight+'px';
      
  }
    // setHeight('description');
 
</script>
@endsection

