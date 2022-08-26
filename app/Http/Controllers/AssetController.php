<?php

namespace App\Http\Controllers;
use App\Inventory;
use App\Category;
use PDF;
use App\Notifications\SignedContractNotification;
use App\Notifications\ReturnItemNotification;
use App\EmployeeInventories;
use App\Transaction;
use App\AssetCode;
use App\ReturnInventories;
use App\ReturnInventoryData;
use App\ReturnItem;
use App\InventoryTransaction;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

class AssetController extends Controller
{
    //
    public function assets()
    {
        $inventories = Inventory::with('category')->get();
        $categories = Category::where('status','=',"Active")->get();

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

            
        $dataDepartments = $client->request('get', 'departments', [
            'headers' => [
                'Authorization' => 'Bearer ' . $key,
                'Accept' => 'application/json'
            ],
        ]);
        $responseEmployee = json_decode((string) $dataEmployee->getBody());
        $responseDepartment = json_decode((string) $dataDepartments->getBody());
        $employees = $responseEmployee->data;
        $departments = collect($responseDepartment->data);
        // dd($departments);
        return view('available_inventories',
        
        array(
            'subheader' => '',
            'header' => "Available Assets",
            'inventories' => $inventories,
            'employees' => $employees,
            'departments' => $departments
            )
        );

    }
    public function newAssets(Request $request)
    {
        $def = "N/A";
        if(($request->category == 2) || ($request->category == 4))
        {

        }
        else
        {

            $this->validate($request, [
                'category' => 'required',
                'brand' => 'required',
                'model' => 'required',
                'serial_number' => 'required|unique:inventories,serial_number,'.$def.',serial_number',
                'description' => 'required',
                // 'date_purchased' => 'required',
            ]);
        }
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
        $invetory->amount = $request->amount;
        // dd($request->employee);
        if($request->employee == null)
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
            $employeeInventory->inventory_id = $invetory->id;
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
        // dd($request->all());
        foreach($request->asset as $asset)
        {
            $data = Inventory::where('id',$asset)->first();
            $data->status = "Deployed";
            $data->save();
            if($request->department != null)
            {
                $asset_code = AssetCode::where('department','=',$request->department)->first();
                $asset_codes = AssetCode::where('department','=',$request->department)->orderBy('id','desc')->first();
                $code = 0;
                if($asset_code == null)
                {
                    if($asset_codes == null)
                    {
                        $code = $code + 1;
                    }
                    else
                    {
                        $code =  $asset_codes->code + 1;
                    }
                    $newCode = new AssetCode;
                    $newCode->code = $code;
                    $newCode->employee_id = $request->employee;
                    $newCode->department = $request->department;
                    $newCode->encode_by = auth()->user()->id;
                    $newCode->save();
                }
            }
            else
            {
                $asset_code = AssetCode::where('employee_id',$request->employee)->where('department','=',null)->first();
                $asset_codes = AssetCode::where('department','=',null)->orderBy('id','desc')->first();
                $code = 0;
                if($asset_code == null)
                {
                    if($asset_codes == null)
                    {
                        $code = $code + 1;
                    }
                    else
                    {
                        $code =  $asset_codes->code + 1;
                    }
                    $newCode = new AssetCode;
                    $newCode->code = $code;
                    $newCode->employee_id = $request->employee;
                    $newCode->encode_by = auth()->user()->id;
                    $newCode->save();
                }
            }
            
            $employeeInventory = new EmployeeInventories;
            $employeeInventory->inventory_id = $asset;
            $employeeInventory->emp_code = $request->employee;
            $employeeInventory->status = "Active";
            $employeeInventory->department = $request->department;
            $employeeInventory->date_assigned = date('Y-m-d');
            $employeeInventory->assigned_by = auth()->user()->id;
            $employeeInventory->save();
        }

        
        $request->session()->flash('status','Successfully Assigned');
        return back();
    }
    public function viewAccountabilityPdf(Request $request,$id)
    {
        $transaction = Transaction::with('inventories.inventoriesData.category')->where('id',$id)->first();
      
        $pdf = PDF::loadView('asset_pdf',array(
         'transaction' =>$transaction
            
        ));
        return $pdf->stream('accountability.pdf');
    }
    public function returnItemPdf(Request $request,$id)
    {
        $transaction = ReturnItem::with('items.employee_inventory_d.inventoryData.category')->where('id',$id)->first();
        // dd($transaction->items[0]->employee_inventory_d->inventoryData->category);
        $pdf = PDF::loadView('returnItemPDF',array(
         'transaction' =>$transaction
            
        ));
        return $pdf->stream('returnItems.pdf');
    }
    public function for_repair()
    {
        return view('for_repair',
            array(
            'subheader' => '',
            'header' => "For Repairs",
            )
        );
    }
    public function accountabilities()
    {
     
        $employeeInventories = EmployeeInventories::with('inventoryData.category','transactions')->whereHas('transactions')->where('status','Active')->get();
        return view('accountabilities',
            array(
            'subheader' => '',
            'header' => "Accountabilities",
            'employeeInventories' => $employeeInventories,
            )
        );
    }
    public function deployedAssets()
    {
        return view('deployed_assets',
            array(
            'subheader' => '',
            'header' => "Deployed Assets",
            )
        );
    }
    public function transactions()
    {

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
            $employees = collect($employees);
            $assetCodes = AssetCode::get();
            $assetCodesDepartment = AssetCode::where('department','!=',null)->get();
            $employeeInventories = EmployeeInventories::with('inventoryData.category','EmployeeInventories.inventoryData.category')->where('status','Active')->where('generated',null)->where('department',null)->get();
            $employeeInventoriesDepartment = EmployeeInventories::with('inventoryData.category','EmployeeInventoriesDepartment.inventoryData.category')->where('status','Active')->where('generated',null)->where('department','!=',null)->get();
            $transactions = Transaction::orderBy('id','desc')->get();
            // dd($transactions); 
            return view('transactions',
            array(
            'subheader' => '',
            'header' => "Transactions",
            'employeeInventories' => $employeeInventories,
            'employees' => $employees,
            'transactions' => $transactions,
            'assetCodes' => $assetCodes,
            'employeeInventoriesDepartment' => $employeeInventoriesDepartment,
            'assetCodesDepartment' => $assetCodesDepartment,
            )
        );
    }
    public function returnItem (Request $request)
    {
        // dd($request->all());
        $employeeInventory = EmployeeInventories::where('id',$request->idAccountability)->first();
        $employeeInventory->date_returned = date('Y-m-d');
        $employeeInventory->remarks = $request->description;
        $employeeInventory->returned_status = $request->status;
        if($request->status == "Active")
        {
            $employeeInventory->returned_status = "Good Condition";
        }
        
        $employeeInventory->returned_to = auth()->user()->id;
        $employeeInventory->status = "Returned";
        $employeeInventory->save();

        $returnInventory = new ReturnInventories;
        $returnInventory->employee_inventory_id = $request->idAccountability;
        $returnInventory->inventory_id = $employeeInventory->inventory_id;
        $returnInventory->encode_by = auth()->user()->id;
        $returnInventory->name = $request->name;
        $returnInventory->position = $request->position;
        $returnInventory->department = $request->department;
        $returnInventory->emp_code = $request->emp_code;
        $returnInventory->email = $request->email;
        $returnInventory->save();

        $inventory = Inventory::where('id',$employeeInventory->inventory_id)->first();
        $inventory->status = $request->status;
        $inventory->save();

        Alert::success('Successfully returned.')->persistent('Dismiss');
        return back();

    }
    public function generateData (Request $request)
    {
        // dd($request->all());
        if($request->department_data != null)
        {
            $employeeInventories = EmployeeInventories::where('emp_code',$request->employee_codes)->where('status','Active')->where('department','!=',null)->where('generated',null)->get();
        }
        else
        {
            $employeeInventories = EmployeeInventories::where('emp_code',$request->employee_codes)->where('status','Active')->where('department','=',null)->where('generated',null)->get();
        }

        $transaction = new Transaction;
        $transaction->emp_code = $request->employee_codes;
        $transaction->asset_code = $request->employee_code;
        $transaction->name = $request->name;
        $transaction->department = $request->department;
        $transaction->email = $request->email_address;
        $transaction->position = $request->position;
        $transaction->status = "For Upload";
        $transaction->save();

        foreach($employeeInventories as $int)
        {
            $int->generated = 1;
            $int->save();
            $inventorytransaction = new InventoryTransaction;
            $inventorytransaction->transaction_id = $transaction->id;
            $inventorytransaction->inventory_id = $int->inventory_id;
            $inventorytransaction->save();
        }

        Alert::success('Successfully generated.')->persistent('Dismiss');
        return back();
        // dd($request->all());
    }
    public function viewAccountabilitiesData(Request $request)
    {
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

            
        $dataDepartments = $client->request('get', 'departments', [
            'headers' => [
                'Authorization' => 'Bearer ' . $key,
                'Accept' => 'application/json'
            ],
        ]);
        $responseEmployee = json_decode((string) $dataEmployee->getBody());
        $responseDepartment = json_decode((string) $dataDepartments->getBody());
        $employees = $responseEmployee->data;
        $employeesCollect = collect($employees);
        // dd($employeesCollect);
        $employee = $employeesCollect->where('badgeno',$request->emp_id)->first();
        // dd($employee);
        $employeeInventories = EmployeeInventories::with('inventoryData.category','transactions')->where('emp_code',$request->emp_id)->get();
        $categories = Category::where('status','Active')->get();

        // dd($employees);
        return view('viewAccountabilitiesData',
        array(
            'employeeInventories' => $employeeInventories,
            'employee' => $employee,
            )
        );

    }
    public function uploadSignedContract(Request $request)
    {

        $transaction = Transaction::where('id',$request->transaction)->first();
        $transaction->uploaded_by = auth()->user()->id;
        if($request->hasFile('upload_pdf'))
        {
            $attachment = $request->file('upload_pdf');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/transac/', $name);
            $file_name = '/transac/'.$name;
            $transaction->pdf = $file_name;
            $transaction->status = "Uploaded";
            $transaction->save();

            $transaction->notify(new SignedContractNotification(url($file_name)));
            Alert::success('Successfully uploaded.')->persistent('Dismiss');
            return back();
            
        }
    }
    public function return_items()
    {

        $items = ReturnInventories::with('return_inventories.inventory_data.category','inventory_data','return_inventories.employee_inventories')->where('generated',null)->get();
        // dd($items);
        // dd($items)
        $transactions = ReturnItem::orderBy('id','desc')->get();
        return view('return_items',
            array(
            'subheader' => '',
            'items' => $items,
            'transactions' => $transactions,
            'header' => "Returns",
            )
        );
    }
    public function generate_data_return(Request $request)
    {
        $employeeInventories = ReturnInventories::where('emp_code',$request->employee_code)->where('generated',null)->get();

        $transaction = new ReturnItem;
        $transaction->emp_code = $request->employee_code;
        $transaction->name = $request->name;
        $transaction->department = $request->department;
        $transaction->email = $request->email;
        $transaction->position = $request->position;
        $transaction->status = "For Upload";
        $transaction->save();

        foreach($employeeInventories as $int)
        {
            $int->generated = 1;
            $int->date_generated = date('Y-m-d');
            $int->generated_by = auth()->user()->id;
            $int->save();
            $inventorytransaction = new ReturnInventoryData;
            $inventorytransaction->transaction_id = $transaction->id;
            $inventorytransaction->employee_inventory = $int->employee_inventory_id;
            $inventorytransaction->save();
        }
        Alert::success('Successfully generated.')->persistent('Dismiss');
        return back();
    }
    public function upload_pdf_return(Request $request)
    {
        $transaction = ReturnItem::where('id',$request->transaction)->first();
        $transaction->uploaded_by = auth()->user()->id;
        if($request->hasFile('upload_pdf'))
        {
            $attachment = $request->file('upload_pdf');
            $original_name = $attachment->getClientOriginalName();
            $name = time().'_'.$attachment->getClientOriginalName();
            $attachment->move(public_path().'/transac/', $name);
            $file_name = '/transac/'.$name;
            $transaction->pdf = $file_name;
            $transaction->status = "Uploaded";
            $transaction->save();

            $transaction->notify(new ReturnItemNotification(url($file_name)));
            Alert::success('Successfully uploaded.')->persistent('Dismiss');
            return back();
            
        }
    }
}
