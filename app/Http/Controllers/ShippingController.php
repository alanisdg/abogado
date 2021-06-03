<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Zone;

// Helpers
use DataTables;
use Brian2694\Toastr\Facades\Toastr;

class ShippingController extends Controller
{
    protected $config = [
        "moduleName" => "Zone",
        "routeView" => "backend.modules.zones.",
        "routeLink" => "shipping"
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
     * List zones
     */
    public function listZones(Request $request)
    {
        $data = Zone::get();

        if ($request->ajax()) {
            return Datatables::of($data)->make(true);
        }

        return view($this->config["routeView"] . "index")
                    ->with("data", $data)
                    ->with("config", $this->config);
    }
    /**
     * Zone details
     */
    public function zoneDetail($id)
    {
        $data = Zone::find($id);

        return view($this->config["routeView"] . "details")
                    ->with("row", $data)
                    ->with("config", $this->config);
    }
}
