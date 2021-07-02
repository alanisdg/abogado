<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Annexed;
use App\Models\Contract;

class AnnexedController extends Controller
{
    protected $config = [
        "moduleName" => "Anexos",
        "moduleLabel" => "Anexos",
        "routeView" => "modules.contracts.",
        "routeLink" => "list-contracts/annexes",
        "add" => "Crear Anexo",
        "typeRegister" => "annexed"
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Annexes
     */
    public function annexes($id)
    {
        // Data contract
            $dataContract = Contract::find($id);

        // Annexed data
            $annexesData = Contract::where([
                                        ['number_contract', $id],
                                        ['annex_code', "!=", null]
                                    ])
                                    ->get();

        // Return view
        return view($this->config["routeView"] . "annexes")
            ->with("breadcrumAction", "")
            ->with("data", $annexesData)
            ->with("row", $dataContract)
            ->with("config", $this->config);
    }

    /**
     * Add Annexes (Step 1)
     */
    public function addAnnexes($id)
    {
        // Create session variable contract
            session(['idContract' => $id]);

        // Return view
            return view($this->config["routeView"] . "step-1")
                ->with("breadcrumAction", "")
                ->with('contract', $contract = Contract::find($id))
                ->with("config", $this->config);
    }

    /**
     * Type contract (Step 2)
     */
    public function typeContract()
    {

        // Return view
            return view($this->config["routeView"] . "step-2")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Type contract (Step 3)
     */
    public function parameters()
    {

        // Return view
            return view($this->config["routeView"] . "step-3")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Confirm (Step 4)
     */
    public function confirm()
    {
        // Return view
            return view($this->config["routeView"] . "step-4")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Edit
     */
    public function edit($id)
    {
        // Data contract
            $dataContract = Contract::with(['customer', 'causes'])->find($id);
        // Data cause
            foreach ($dataContract->causes as $value) {
                $cause = $value;
            }

        // Return view
        return view($this->config["routeView"] . "edit-annexed")
            ->with("breadcrumAction", "")
            ->with("row", $dataContract)
            ->with("cause", $cause)
            ->with("config", $this->config);
    }
}
