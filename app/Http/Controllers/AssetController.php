<?php

namespace App\Http\Controllers;
use App\Inventory;
use App\Category;
use PDF;
use App\EmployeeInventories;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    //
    public function assets()
    {
        $inventories = Inventory::with('category')->get();
        $categories = Category::where('status','=',"Active")->get();

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

        $dataEmployee = $client->request('get', 'employees', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $key,
                    'Accept' => 'application/json'
                ],
            ]);
        $responseEmployee = json_decode((string) $dataEmployee->getBody());
        $employees = $responseEmployee->data;
        return view('inventories',
        array(
            'subheader' => '',
            'header' => "Assets",
            'inventories' => $inventories,
            'categories' => $categories,
            'employees' => $employees
            )
        );
    }
    public function availableAssets()
    {
        $inventories = Inventory::with('category')->where('status','Active')->get();
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

        $dataEmployee = $client->request('get', 'employees', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $key,
                    'Accept' => 'application/json'
                ],
            ]);
        $responseEmployee = json_decode((string) $dataEmployee->getBody());
        $employees = $responseEmployee->data;

        return view('available_inventories',
        
        array(
            'subheader' => '',
            'header' => "Available Assets",
            'inventories' => $inventories,
            'employees' => $employees
            )
        );

    }
    public function newAssets(Request $request)
    {

        $this->validate($request, [
            'category' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'serial_number' => 'required|unique:inventories',
            'description' => 'required',
            'date_purchased' => 'required',
        ]);

        $oldest_data = Inventory::where('category_id',$request->category)->orderBy('id','desc')->first();
        $inventory_code = 0;
        if($oldest_data == null)
        {   
            $inventory_code = $inventory_code + 1;
        }
        else
        {
            $inventory_code =  $oldest_data->equipment_code + 1 ;
        }
        $invetory = new Inventory;
        $invetory->category_id = $request->category;
        $invetory->equipment_code = $inventory_code;
        $invetory->brand = $request->brand;
        $invetory->model = $request->model;
        $invetory->serial_number = $request->serial_number;
        $invetory->description = $request->description;
        
        if($request->employee)
        {
            $invetory->status = "Active";
        }
        else
        {
            $invetory->status = "Deployed";
        }
        $invetory->save();
        if($request->employee)
        {
            $employeeInventory = new EmployeeInventories;
            $employeeInventory->category_id = $invetory->id;
            $employeeInventory->emp_code = $request->employee;
            $employeeInventory->status = "Active";
            $employeeInventory->date_assigned = date('Y-m-d');
            $employeeInventory->assigned_by = auth()->user()->id;
            $employeeInventory->save();
        }
      
        $request->session()->flash('status','Successfully Created');
        return back();

    }
    public function assignAssets(Request $request)
    {

        foreach($request->asset as $asset)
        {
            $data = Inventory::where('id',$asset)->first();
            $data->status = "Deployed";
            $data->save();

            $employeeInventory = new EmployeeInventories;
            $employeeInventory->inventory_id = $asset;
            $employeeInventory->emp_code = $request->employee;
            $employeeInventory->status = "Active";
            $employeeInventory->date_assigned = date('Y-m-d');
            $employeeInventory->assigned_by = auth()->user()->id;
            $employeeInventory->save();
        }

        
        $request->session()->flash('status','Successfully Assigned');
        return back();
    }
    public function viewAccountabilityPdf()
    {
        $pdf = PDF::loadView('asset_pdf',array(
         
            
        ));
        return $pdf->stream('accountability.pdf');
    }
    
}
