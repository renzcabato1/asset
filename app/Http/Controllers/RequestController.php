<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
