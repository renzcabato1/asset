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
    </style>
</head>
<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr >
            <td  align='center' > 
                <img src='{{asset('images/front-logo.png')}}' width='150px' >
            </td>
        </tr>
        <tr>
            <td >
                <br>
                    <strong> OBANANA CORP.</strong><br>
                   <br>
            </td>
        </tr>
    </table>
    <hr>
  
</body>
</html>