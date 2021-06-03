<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $config = [
        "moduleName" => "Dashboard",
        "routeView" => "modules.dashboard.",
        "routeLink" => "dashboard"
    ];

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
     * Index
     */
    public function index()
    {
        // List Institutions

        return view($this->config["routeView"] . 'index')
            ->with("config", $this->config);
    }

}
