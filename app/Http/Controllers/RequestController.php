<?php

namespace App\Http\Controllers;
use App\Category;
use App\Borrowerinformation;
use App\BorrowerAttachment;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use RealRashid\SweetAlert\Facades\Alert;

class RequestController extends Controller
{
    //

    public function viewRequests()
    {

        $requests = Borrowerinformation::with('attachments','category')->where('status','Pending')->get();
        return view('requests',
        
        array(
            'subheader' => '',
            'header' => "Requests",
            'requests' => $requests,
            )
        );
    }
    public function borrow()
    {
        $categories = Category::where('status','Active')->get();
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

        $dataDepartments = $client->request('get', 'departments', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $key,
                    'Accept' => 'application/json'
                ],
            ]);
        $responseDepartment = json_decode((string) $dataDepartments->getBody());
        $departments = $responseDepartment->data;
        

        dd($departments);
        return view('borrow',
        
        array(
            'subheader' => '',
            'header' => "Requests",
            'categories' => $categories,
            'departments' => $departments,
            )
        );
    }
    public function BorrowInformation(Request $request)
    {
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
        // dd($departments);
        $categories = Category::where('status','Active')->get();
        return view('borrowInformation',
        array(
            'subheader' => '',
            'header' => "Requests",
            'categories' => $categories,
            'companies' => $companies,
            'departments' => $departments,
            )
        );
    }
    public function borrowSubmit(Request $request)
    {
        $borrower =  new Borrowerinformation;
        $borrower->company = $request->company;
        $borrower->category_id = $request->category;
        $borrower->department = $request->department;
        $borrower->name = $request->name;
        $borrower->email = $request->email;
        $borrower->position = $request->position;
        $borrower->details = $request->details;
        $borrower->status = "Pending";
        $borrower->save();

        if($request->hasFile('attachment'))
        {
            foreach($request->file('attachment') as $attachment)
            {
                $original_name = $attachment->getClientOriginalName();
                $name = time().'_'.$attachment->getClientOriginalName();
                $attachment->move(public_path().'/borrow_attachments/', $name);
                $file_name = '/borrow_attachments/'.$name;

                $borrower_attachment = new BorrowerAttachment;
                $borrower_attachment->borrower_informations_id = $borrower->id;
                $borrower_attachment->attachment_url = $file_name;
                $borrower_attachment->attachment_title = $original_name;
                $borrower_attachment->save();
            }
        }
        $idReferenceNumber = "RN-".str_pad($borrower->id, 8, '0', STR_PAD_LEFT);
        Alert::success('Your request has been submitted successfully.', ' Your Reference Number is '.$idReferenceNumber)->persistent('Dismiss');
        return back();
    }
    public function trackStatus(Request $request)
    {
        $trackNumber = "";
        $email =  "";
        $result = "";
        if($request->reference_number)
        {
            $trackNumber = $request->reference_number;
            $email = $request->email;
            $explodeData = explode("-", $trackNumber);
            $Tracknum = intval($explodeData[1]);
            $result = Borrowerinformation::with('attachments','category')->where('id',$Tracknum)->where('email',$email)->first();
            
        }
        // dd($result);
        return view('trackstatus',
        array(
            'subheader' => '',
            'header' => "Requests",
            'trackNumber' => $trackNumber,
            'email' => $email,
            'result' => $result,
            )
        );
    }
}
