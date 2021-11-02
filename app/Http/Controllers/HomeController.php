<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


// Helpers
use Brian2694\Toastr\Facades\Toastr;

// Request
use App\Http\Requests\CustomerRequest;
use App\Models\Pending;
use Response;
use View;
use File;
class HomeController extends Controller
{
    /**
     * Index function
     */
    public function login()
    {
        return view('auth.login');
    }

    public function json(){
        $pendings = Pending::all()->toJson();
        $data = json_encode(['Text One', 'Text Two', 'Text Three']);

        $jsongFile = time() . '_file.json';

        File::put(public_path('/'.$jsongFile), $pendings);

        return Response::download(public_path('/'.$jsongFile));
    }
}
