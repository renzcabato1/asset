<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Alert;
use App\EmployeeInventories;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function employees()
    {
        $employeeInventories = EmployeeInventories::with('inventoryData.category')->get();


        //employee API
        $client = new Client([
            'base_uri' => 'http://192.168.50.119:4200/HRAPI/public/',
            'cookies' => true,
            ]);

        $data = $client->request('POST', 'oauth/token', [
            'json' => [
                'username' => 'rccabato@premiummegastructures.com',
                'password' => 'P@ssw0rd',
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'rVI1kVh07yb4TBw8JiY8J32rmDniEQNQayf3sEyO',
                ]
        ]);

        $response = json_decode((string) $data->getBody());
        $key = $response->access_token;

        $dataEmployee = $client->request('get', 'employees', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $key,
                    'Accept' => 'application/json'
                ],
            ]);
        $responseEmployee = json_decode((string) $dataEmployee->getBody());
        $employees = $responseEmployee->data;
       
        return view('employees',
        
        array(
        'subheader' => '',
        'header' => "Employees",
        'employees' => $employees,
        'employeeInventories' => $employeeInventories
        )
    );
    }
}
