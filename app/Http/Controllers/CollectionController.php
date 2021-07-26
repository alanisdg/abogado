<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Collection;
use App\Models\Contract;
use App\Models\Customer;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class CollectionController extends Controller
{
    protected $config = [
        "moduleName" => "Cobranzas",
        "moduleLabel" => "Cobranzas",
        "routeView" => "modules.collections.",
        "routeLink" => "collections",
        "add" => "",
        "typeRegister" => ""
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List of fees
     */
    public function listFees()
    {

        return view($this->config["routeView"] . "list")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Search collections
     */
    public function searchCollections(Request $request)
    {
        // Data customer
            $data = Customer::with(['contracts', 'contracts.collections'])->whereRut($request->input('customer_rut'))->first();
            if (!is_null($data)) {
                $collections = $data;
            }
            else {
                $collections = null;
            }

        // Response
            return response()->json(["response" => 200, "collections" => $collections]);
    }

    /**
     * List fees
     */
    public function listFeesContract($id)
    {
        // List fees
            $collections = Collection::whereContractId($id)->get();

        // Return view
            return view("modules.collections.list-fees")
                ->with("breadcrumAction", "")
                ->with('dataCollections', $collections)
                ->with("config", $this->config);

    }

    /**
     * Pay fee
     */
    public function payFee($id)
    {
        
    }
}
