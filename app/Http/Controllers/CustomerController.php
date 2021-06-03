<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Customer;

// Helpers
use DataTables;
use Brian2694\Toastr\Facades\Toastr;

class CustomerController extends Controller
{
    protected $config = [
        "moduleName" => "Customers",
        "routeView" => "backend.modules.customers.",
        "routeLink" => "customers"
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
     * List customers
     */
    public function listCustomers(Request $request)
    {
        $data = Customer::get();

        if ($request->ajax()) {
            return Datatables::of($data)->make(true);
        }

        return view($this->config["routeView"] . "index")
                    ->with("data", $data)
                    ->with("config", $this->config);
    }
    /**
     * Details customers
     */
    public function detailsCustomers($id)
    {
        $data = Customer::find($id);

        return view($this->config["routeView"] . "details")
                    ->with("row", $data)
                    ->with("config", $this->config);
    }
    /**
     * Update customers
     */
    public function updateCustomers(Request $request)
    {
        $dataCustomer = Customer::find($request->input('customer_id'));
        $dataCustomer->name = $request->input('name');
        $dataCustomer->surname = $request->input('surname');
        $dataCustomer->email = $request->input('email');
        $dataCustomer->phone = $request->input('phone');
        $dataCustomer->address = $request->input('address');
        if ($dataCustomer->save()) {
            Toastr::success(__("Update Record"),__("Success"));
            return redirect('customers/details/'.$request->input('customer_id'));
        }
    }
}
