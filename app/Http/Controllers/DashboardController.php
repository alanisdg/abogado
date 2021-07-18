<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Collection;
use App\Models\Pending;
use App\Models\Task;

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

        // Pending clients
            $pendingClients = Pending::whereStatus(1)->count();

        // Pending tasks
            $pendingTasks = Task::whereStatus(1)->count();

        return view($this->config["routeView"] . 'index')
            ->with('pendingFees', $pendingFees)
            ->with('pendingClients', $pendingClients)
            ->with('pendingTasks', $pendingTasks)
            ->with("config", $this->config);
    }

}
