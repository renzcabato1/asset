<?php

namespace App\Http\Controllers;
use App\Inventory;
use App\Category;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    //
    public function assets()
    {
        $inventories = Inventory::get();
        $categories = Category::where('status','=',"Active")->get();

        
        $response = file_get_contents('http://203.177.143.61:8080/HRAPI/public/get-employees-all');
        $employees = json_decode($response);
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
        $invetory->status = "Active";
        $request->session()->flash('status','Successfully created');
        return back();

    }
}
