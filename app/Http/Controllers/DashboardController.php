<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Collection;
use App\Models\Contract;
use App\Models\Pending;
use App\Models\Task;
use App\Models\Customer;

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

        // Lost contracts
            $lostContracts = Pending::whereStatus(3)->count();

        // Contracts won
            $contractsWon = Contract::whereAnnexCode(null)->count();

        // Customer contracts
            $data = Customer::with('contracts')->whereRut(Auth::user()->rut)->first();


            $dataContract = Contract::with(['causes', 'collections', 'customer'])->find($data->contracts->first->get()->id);

            $user = Auth::user();
        return view($this->config["routeView"] . 'index')
            ->with('pendingFees', $pendingFees)
            ->with('pendingClients', $pendingClients)
            ->with('pendingTasks', $pendingTasks)
            ->with('lostContracts', $lostContracts)
            ->with('contractsWon', $contractsWon)
            ->with('dataContract', $data)
            ->with('user', $user)
            ->with("config", $this->config)
            ->with("data", $dataContract);
    }


    public function agenda(){
        return view('wordpress.agenda');
    }
}
