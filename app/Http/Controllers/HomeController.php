<?php

namespace App\Http\Controllers;
use App\Inventory;
use App\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $inventories = Inventory::get();
        $categories = Category::with('inventories')->get();
        $active_inventories = Inventory::where('status','Active')->get();
        $deployed_inventories = Inventory::where('status','Deployed')->get();
        // Alert::success('Success Login', 'Welcome to Asset Inventory Management System '.auth()->user()->name)->persistent('Dismiss');
        return view('home',
        array(
            'subheader' => '',
            'header' => "Dashboard",
            'inventories' => $inventories,
            'active_inventories' => $active_inventories,
            'deployed_inventories' => $deployed_inventories,
            'categories' => $categories,
        )    
    
    );
    }
}
