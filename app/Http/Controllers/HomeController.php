<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// Helpers
use Brian2694\Toastr\Facades\Toastr;

// Request
use App\Http\Requests\CustomerRequest;

class HomeController extends Controller
{
    /**
     * Index function
     */
    public function login()
    {
        return view('auth.login');
    }
}
