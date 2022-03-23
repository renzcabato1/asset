<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class RequestController extends Controller
{
    //

    public function viewRequests()
    {
        return view('requests',
        
        array(
            'subheader' => '',
            'header' => "Requests",
            )
        );
    }
    public function borrow()
    {
        $categories = Category::where('status','Active')->get();
        
        return view('borrow',
        
        array(
            'subheader' => '',
            'header' => "Requests",
            'categories' => $categories,
            )
        );
    }
    public function BorrowInformation(Request $request,$id)
    {

        
        //employee API
        $client = new Client([
            'base_uri' => 'http://203.177.143.61:8080/HRAPI/public/',
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

        $dataDepartments = $client->request('get', 'departments', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $key,
                    'Accept' => 'application/json'
                ],
            ]);
        $dataCompanies = $client->request('get', 'companies', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $key,
                    'Accept' => 'application/json'
                ],
            ]);
        $responseDepartment = json_decode((string) $dataDepartments->getBody());
        $departments = collect($responseDepartment->data);
        $responseCompany = json_decode((string) $dataCompanies->getBody());
        $companies = collect($responseCompany->data);
        // dd($companies);
        

        $category = Category::where('id',$id)->first();
        return view('borrowInformation',
        array(
            'subheader' => '',
            'header' => "Requests",
            'category' => $category,
            'companies' => $companies,
            'departments' => $departments,
            )
        );
    }
}
