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
                        <h4>Assign to Employee / Department </h4>
                        </div>
                        <div class="card-body">
                          <label class="mt-2">
                            <input type="checkbox" id='accept'  name="custom-switch-checkbox" class="custom-switch-input" onclick="change_department();">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Department</span>
                          </label><br>
                          <div id='department'>
                          </div>
                            <label>Assets</label>
                            <select class="form-control select2" name='asset[]' style='width:100%' required multiple >
                                {{-- <option value=''>Select assets</option> --}}
                                @foreach($inventories as $inventory)
                                    <option value='{{$inventory->id}}'>OBN-{{$inventory->category->code}}-{{str_pad($inventory->equipment_code, 4, '0', STR_PAD_LEFT)}}</option>
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
                        <table class="table table-hover" id="employees-table" style="width:100%;">
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
                                <td>{{$inventory->category->code}}-{{str_pad($inventory->equipment_code, 4, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$inventory->category->category_name}}</td>
                                <td>{{$inventory->brand}}</td>
                                <td>{{$inventory->model}}</td>
                                <td>{{$inventory->serial_number}}</td>
                                <td><small>{!! nl2br(e($inventory->description)) !!}</small></td>
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

<script>
  
      function change_department()
      {
      
     
          // var element = document.getElementById("depart");
          // element.remove();

          var cb = document.querySelector('#accept');
          console.log(cb.checked); // false
          if(cb.checked == true)
          {
          
          var data = "<div id='depart'><label>Department</label><select id='department_select' class='form-control select3' name='department' style='width:100%' required >";
             data += "<option value=''></option>";
             data += "@foreach($departments as $department)";
             data += "<option value='{{$department->code}}'>{{$department->descs}} - {{$department->code}}</option>";
             data += "@endforeach";
             data += "</select></div>";
             $('#department').append(data);
             $(".select3").select2();

               
          }
          else
          {
            var element = document.getElementById("depart");
            element.remove();
            
          }
        
     
     }
</script>
@endsection

