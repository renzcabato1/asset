<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function employees()
    {
        $response = file_get_contents('http://203.177.143.61:8080/HRAPI/public/get-employees-all');
        $employees = json_decode($response);
       
        return view('employees',
        
        array(
        'subheader' => '',
        'header' => "Employees",
        'employees' => $employees
        )
    );
    }
}
