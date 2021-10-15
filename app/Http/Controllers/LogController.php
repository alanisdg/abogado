<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function logs(){
        $logs = Log::with('user')->paginate(6);
        return view('modules.logs.index',compact('logs'));
    }
}
