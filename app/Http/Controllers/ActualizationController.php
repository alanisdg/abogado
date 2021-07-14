<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Contract;

class ActualizationController extends Controller
{
    protected $config = [
        "moduleName" => "Actualización",
        "moduleLabel" => "Actualización",
        "routeView" => "modules.actualize.",
        "routeLink" => "contracts",
        "add" => "Registrar Actualización",
        "typeRegister" => "contract"
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Actualize register
     */
    public function registerActualize(Request $request)
    {
        // Data contract
            $dataContract = Contract::with(['customer', 'causes'])->find($request->input('contract_id'));

        return view($this->config["routeView"] . "register")
                ->with('type', $request->input('type'))
                ->with('row', $dataContract)
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }
}
