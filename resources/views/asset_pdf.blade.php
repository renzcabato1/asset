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
                <span class='font-design' style='font-size:14px;padding-bottom:10px;' ><strong>ASSET ACCOUNTABILITY FORM</strong></span>
                
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
                TRANS CODE : TR-{{str_pad($transaction->id, 5, '0', STR_PAD_LEFT)}}
            </td>
        </tr>
        <tr  class='content' >
            <td >
                DEPARTMENT : {{$transaction->department}}
            </td>
            <td >
                ASSET CODE : {{$transaction->asset_code}}
            </td>
        </tr>
        <tr  class='content' align='center' style='padding-top:10px;'>
           <td colspan='2'>
                <b style='font-size:13px;'>
                    I recieved the following item(s) for use at Obanana Corp. (OBN) in good order and condition. As the user for this item(s) below, it is now under my accountability and will be held liable for any damage or lost property.
                </b>
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
        </tr>
        @foreach($transaction->inventories as $inventory)
        <tr align='center'>
            <td>
                {{$inventory->inventoriesData->category->category_name}}
            </td>
            <td>
                OBN-{{$inventory->inventoriesData->category->code}}-{{str_pad($inventory->inventoriesData->equipment_code, 4, '0', STR_PAD_LEFT)}}
            </td>
            <td>
                {{$inventory->inventoriesData->brand}}
            </td>
            <td>
                {{$inventory->inventoriesData->model}}
            </td>
            <td>
                {{$inventory->inventoriesData->serial_number}}
            </td>
        </tr>
        @endforeach
    </table>

    <table width="100%" cellspacing="0" border='0' >
        <tr align='center'>
            <td>
                <i style='font-size:14px;'>*** Nothing Follows ***</i>
                <br>
                <br>
            </td>
        </tr>
        <tr align='left'>
            <td>
                <span style='font-size:12px;'>Note: These items must be returned/surrendered to the company upon resigation/termination/transer of functions of the borrower. Failure to do so would compel the management to automatically charge the above-enumerated item(s). Likewise, any lost or damaged item(s) will be charged to the borrower.</span>
            </td>
        </tr>
    </table>
    <div id="footer">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr >
                <td  align='center'>
                    Issued by:  <br>
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