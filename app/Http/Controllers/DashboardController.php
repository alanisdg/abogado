<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Collection;

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
        // Pending fees
            $pendingFees = Collection::whereStatus('PENDIENTE')->count();

        return view($this->config["routeView"] . 'index')
            ->with('pendingFees', $pendingFees)
            ->with("config", $this->config);
    }

}
