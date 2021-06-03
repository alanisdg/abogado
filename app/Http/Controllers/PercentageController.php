<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Percentage;

// Helpers
use Brian2694\Toastr\Facades\Toastr;

class PercentageController extends Controller
{
    protected $config = [
        "moduleName" => "Percentage",
        "routeView" => "backend.modules.percentages.",
        "routeLink" => "percentages"
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
     * Register
     */
    public function register()
    {
        // Data
            $data = Percentage::first();

        return view($this->config["routeView"] . "register")
            ->with("row", $data)
            ->with("config", $this->config);
    }
    /**
     * Update
     */
    public function update(Request $request)
    {
        $updateData = Percentage::first();
        if(!is_null($updateData)) {
            $updateData->value = $request->input('value');
            $updateData->save();

            Toastr::success(__("Update Record"),__("Success"));
            return redirect('shipping/percentage');
        }
        else {
            $create = new Percentage();
            $create->value = $request->input('value');
            $create->save();

            Toastr::success(__("Update Record"),__("Success"));
            return redirect('shipping/percentage');
        }
    }
}
