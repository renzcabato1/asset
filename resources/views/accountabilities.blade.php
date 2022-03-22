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
                                <?php
                                $filtered = $employees->where('badgeno', $accountability->emp_code);
                                // dd( $filtered->all());
                                ?>
                                @foreach($filtered->all() as $filt)
                                {{$filt->lastname}}, {{$filt->firstname}} {{$filt->middlename}} - {{$accountability->emp_code}}
                                @endforeach
                                </td>
                              <td>OBN-{{$accountability->inventoryData->category->code}}-{{str_pad($accountability->inventoryData->id, 5, '0', STR_PAD_LEFT)}}</td>
                              <td>{{$accountability->inventoryData->category->name}}</td>
                              <td>{{$accountability->inventoryData->brand}}</td>
                              <td>{{$accountability->inventoryData->model}}</td>
                              <td>{{$accountability->inventoryData->serial_number}}</td>
                              <td><small>{!! nl2br(e($accountability->inventoryData->description)) !!}</small></td>
                              <td><a onclick="getData({{$accountability->id}})" data-toggle="modal" data-target="#return_unit"href="#" class="btn btn-icon btn-sm icon-left btn-primary" title='Return Unit'><i class="far fa-paper-plane"></i> Return</a></td>
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
    document.getElementById("idAccountability").value = accountabilityId;
    document.getElementById("status").value = "";
    document.getElementById("description").value = "";
  }

  function setHeight(fieldId)
    {

        document.getElementById(fieldId).style.height = document.getElementById(fieldId).scrollHeight+'px';
        
    }
    // setHeight('description');
 
</script>
@endsection

