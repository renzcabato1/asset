@extends('layouts.header')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                      <h4>Pending Requests</h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-hover" id="employees-table" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Code</th>
                              <th>Company</th>
                              <th>Department</th>
                              <th>Position</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($requests as $request)
                              <tr class='pointer' data-toggle="modal" data-target="#viewRequest" onclick='viewRequest({{$request}});'>
                                <td>RN-{{str_pad($request->id, 8, '0', STR_PAD_LEFT)}}</td>
                                <td>{{$request->company}}</td>
                                <td>{{$request->department}}</td>
                                <td>{{$request->position}}</td>
                                <td>@if($request->status == "Pending")<div class="badge badge-success">New</div>@elseif($request->status == "Viewed")<div class="badge badge-warning">Viewed</div>@endif</td>
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
@include('viewRequest')

<script type="text/javascript">

  function viewRequest(data)
  {
      console.log(data);
      document.getElementById("requestItem").innerHTML = data.category.category_name;
      document.getElementById("name").innerHTML = data.name;
      document.getElementById("company").innerHTML = data.company;
      document.getElementById("company_email").innerHTML = data.email;
      document.getElementById("department").innerHTML = data.department;
      document.getElementById("position").innerHTML = data.position;
      document.getElementById("details").innerHTML = nl2br(data.details);
      document.getElementById("reference_code").innerHTML ="RN-"+pad('00000000',data.id,true);;
  }
  function pad(pad, str, padLeft) {
    if (typeof str === 'undefined') 
        return pad;
    if (padLeft) {
        return (pad + str).slice(-pad.length);
    } else {
        return (str + pad).substring(0, pad.length);
    }
   }
   function nl2br (str, is_xhtml) {
    if (typeof str === 'undefined' || str === null) {
        return '';
    }
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}
</script>
@endsection

