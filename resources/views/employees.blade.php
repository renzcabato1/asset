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
                        <table class="table table-hover " id="employees-table" style="width:100%;">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Emp Code</th>
                              <th>Department</th>
                              <th>Position</th>
                              <th>Emplooyee Type</th>
                              {{-- <th>Approver</th> --}}
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($employees as $employee)
                              @php
                                $name = '"'.$employee->firstname." ".$employee->middlename." ".$employee->lastname.'"';
                              @endphp
                                <tr>
                                    <td>{{$employee->lastname}}, {{$employee->firstname}} {{$employee->middlename}}</td>
                                    <td>{{$employee->badgeno}}</td>
                                    <td>{{$employee->department}}</td>
                                    <td>{{$employee->position}}</td>
                                    <td>{{$employee->emp_type}}</td>
                                    {{-- <td>@if($employee->reporting_to) {{$employee->reporting_to}}, {{$employee->reporting_to}}@endif</td> --}}
                                    <td>{{$employee->emp_status}}</td>
                                    <td>
                                      <a href="#" onclick='viewAccountabilities({{$employee->badgeno}});' title='View Accountabilities' class="btn btn-icon btn-primary" data-toggle="modal" data-target="#viewAccountability"><i class="far fa-eye"></i></a>
                                      {{-- <a href="#" title='Generate QR Code' class="btn btn-icon btn-warning" data-toggle="modal" data-target="#generateQrCode{{$employee->badgeno}}"><i class="fas fa-qrcode"></i></a> --}}
                                      <a href="#" onclick='viewQRCode({{$employee->badgeno}},{{$name}});' title='Generate QR Code Second' class="btn btn-icon btn-warning" data-toggle="modal" data-target="#generateQrCodeSecond"><i class="fas fa-qrcode"></i></a>
                                      
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

@include('generateQrCodeSecond');
{{-- @foreach($employees as $employee)
  @include('generateQrCode');
@endforeach --}}
@include('view_accountabilities');
<script type="text/template" id="qrcodeTpl">
  <div class="imgblock">
      
      <div class="qr" id="qrcode_{i}"></div>
      <div class="title">{title}</div>
  </div>
</script>
<script>
    var employeeInventories = {!! json_encode($employeeInventories->toArray()) !!};
    function viewAccountabilities(Data)
    {
      $("#AccountabilitiesData" ).empty();
        var count = 0;
        for(var i=0;i<employeeInventories.length;i++)
        {
          if(Data == employeeInventories[i].emp_code)
          {
            
            count = count +1;
            var tableTd = "<tr>";
                tableTd += "<td>OBN-"+employeeInventories[i].inventory_data.category.code+"-"+pad("00000",employeeInventories[i].inventory_data.equipment_code,true)+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.category.category_name+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.brand+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.model+"</td>";
                tableTd += "<td>"+employeeInventories[i].inventory_data.serial_number+"</td>";
                tableTd += "<td><small>"+nl2br (employeeInventories[i].inventory_data.description)+"</small></td>";
                tableTd += "<td>"+employeeInventories[i].status+"</td>";
                tableTd += "</tr>";

            $("#AccountabilitiesData" ).append(tableTd);
            console.log(employeeInventories[i].inventory_data);

          }
        }
        if(count == 0)
        {
            var tableTd = "<tr>";
                tableTd += "<td colspan='6' class='text-center'>--No Data Found--</td>";
                tableTd += "</tr>";
                $("#AccountabilitiesData" ).append(tableTd);
        }
       
       
    }
    function viewQRCode(code,name)
    {
      $("#qr_code_second" ).empty();
      var demoParams = [
        {
            title: name,
            config: {
                text: "http://192.168.50.119:6060/getDataAccountability?emp_id="+code, 
                width: 450, 
                height: 450, 
                colorDark: "#000000",
              id: "qrcodeData",
                colorLight: "#ffffff",
                // correctLevel : QRCode.CorrectLevel.L, // L, M, Q, H
                logo: "data:image/png;base64,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",
                logoBackgroundTransparent: false, 
                dotScale: 1
            }
        
        },

    ]



    var qrcodeTpl = document.getElementById("qrcodeTpl").innerHTML;
    var container = document.getElementById('qr_code_second');

    for (var i = 0; i < demoParams.length; i++) {
        var qrcodeHTML = qrcodeTpl.replace(/\{title\}/, demoParams[i].title).replace(/{i}/, i);
        container.innerHTML+=qrcodeHTML;
    }
    for (var i = 0; i < demoParams.length; i++) {
         var t=new QRCode(document.getElementById("qrcode_"+i), demoParams[i].config);
    }
    
    }

    function nl2br (str, is_xhtml) 
    {
      var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>';
      return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }
    function pad(pad, str, padLeft) 
    {
      if (typeof str === 'undefined') 
          return pad;
      if (padLeft) {
          return (pad + str).slice(-pad.length);
      } else {
          return (str + pad).substring(0, pad.length);
      }
    }
    function printDiv() 
        {
            var divToPrint=document.getElementById('generateQrCodeSecond');
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
        }   
        
</script>
@endsection

