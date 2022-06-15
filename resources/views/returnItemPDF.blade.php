<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   
    
    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        table { 
            border-spacing: 0;
            border-collapse: collapse;
        }
        body{
            font-family: Calibri;
            font-size : 12px;
        }
        .font-design
        {
            font-family: Arial, Helvetica, sans-serif;

        }
        @page { }
        #header { position: fixed; left: -550px; right: 0px; text-align: center; }
        .content td{
        padding-bottom: 10px;
        }
       
        #footer { position: fixed;  bottom: 70px; }
    </style>
</head>
<body class='font-design'>
    <div id="header">
        <h1><img src='{{asset('login_css/images/logo.png')}}' width='100px' ></h1>
    </div>
 
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr >
            <td>
                {{-- <img src='{{asset('login_css/images/logo.png')}}' width='150px' > --}}
                <p align='center' class='font-design'><span style='font-size:14px;padding-bottom:10px;' ><strong> OBANANA CORPORATION</strong></span><br>
                    {{-- <br> --}}
                    <span>PMI Tower Cabanillas Corner, 273 Pablo Ocampo Sr. Ext</span><br>
                    <span>Makati, 1203 Metro Manila, Makati, Philippines</span><br>
                    <span>Cel. No.: +63 945 729 5298 | Website: www.obanana.com</span>
                </p>
            </td>
        </tr>
    </table>
    <hr>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr >
            <td colspan='2' align='center'>
                <span class='font-design' style='font-size:14px;padding-bottom:10px;' ><strong>RETURNED IT ASSETS</strong></span>
                
        <br>
        
        <br>
        <br>
            </td>
        </tr>
        <tr class='content'>
            <td width='60%' >
                NAME : {{$transaction->name}}
               
            </td>
            <td width='30%'>
                DATE :   {{date('F d, Y',strtotime($transaction->created_at))}}
            </td>
        </tr>
        <tr   class='content'>
            <td >
                POSITION : {{$transaction->position}}
            </td>
            <td >
                TRX CODE : TR-{{str_pad($transaction->id, 5, '0', STR_PAD_LEFT)}}
            </td>
        </tr>
        <tr  class='content' >
            <td >
                DEPARTMENT : {{$transaction->department}}
            </td>
        </tr>
       
    </table>
    <table width="100%" cellspacing="0" border='1' >
        <tr align='center'>
            <th>
                <b>CATEGORY</b>
            </th>
            <th>
                <b>EQUIPMENT CODE</b>
            </th>
            <th>
                <b>BRAND</b>
            </th>
            <th>
                <b>MODEL</b>
            </th>
            <th>
                <b>SERIAL NUMBER</b>
            </th>
            <th>
              
                <b>REMARKS</b>
            </th>
            <th>
                <b>CONDITION</b>
            </th>
        </tr>
        @foreach($transaction->items as $inventory)
        <tr align='center'>
            <td>
                {{$inventory->employee_inventory_d->inventoryData->category->category_name}}
            </td>
            <td>
                OBN-{{$inventory->employee_inventory_d->inventoryData->category->code}}-{{str_pad($inventory->employee_inventory_d->inventoryData->equipment_code, 4, '0', STR_PAD_LEFT)}}
            </td>
            <td>
                {{$inventory->employee_inventory_d->inventoryData->brand}}
            </td>
            <td>
                {{$inventory->employee_inventory_d->inventoryData->model}}
            </td>
            <td>
                {{$inventory->employee_inventory_d->inventoryData->serial_number}}
            </td>
            <td>
                {{$inventory->employee_inventory_d->remarks}}
            </td>
            <td>
                {{$inventory->employee_inventory_d->returned_status}}
            </td>
        </tr>
        @endforeach
    </table>
    <div id="footer">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr >
                <td  align='center'>
                    Received by:  <br>
                    <br>
                    <br>
                    <br>
                    {{auth()->user()->name}}<br>
                    <span class='font-design' style='font-size:12px;padding-bottom:10px;text-decoration: overline;' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature over Printed Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </td>
                <td  align='center'>
                    Acknowledged by: <br>
                    <br>
                    <br>
                    <br>
                    {{$transaction->name}}<br>
                    <span class='font-design' style='font-size:12px;padding-bottom:10px;text-decoration: overline;' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature over Printed Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
             
                </td>
            </tr>
        </table>
    </div>
</body>
</html>