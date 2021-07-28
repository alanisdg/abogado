<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Customer;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

// Request
use App\Http\Requests\CustomerRequest;
use App\Models\Pending;

class CustomerController extends Controller
{
    protected $config = [
        "moduleName" => "Clientes",
        "moduleLabel" => "Registro de Clientes",
        "routeView" => "modules.customers.",
        "routeLink" => "customers",
        "add" => "Registrar Cliente",
        "edit" => "Editar Cliente",
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $array = Customer::orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return Datatables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "index")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->config["routeView"] . "register")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('typeForm', 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $addCustomer = New Customer();
        $addCustomer->rut = $request->input('rut');
        $addCustomer->first_name = $request->input('first_name');
        $addCustomer->last_name = $request->input('last_name');
        $addCustomer->civil_status = $request->input('civil_status');
        $addCustomer->profession = $request->input('profession');
        $addCustomer->nationality = $request->input('nationality');
        $addCustomer->commune = $request->input('commune');
        $addCustomer->region = $request->input('region');
        $addCustomer->address = $request->input('address');
        $addCustomer->email = $request->input('email');
        $addCustomer->phone = $request->input('phone');
        if ($addCustomer->save()) {
            Toastr::success("", "¡Cliente Registrado!");
            return redirect('customers');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view($this->config["routeView"] . "register")
            ->with("breadcrumAction", "Editar")
            ->with('config', $this->config)
            ->with('typeForm', 'update')
            ->with('row', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $editCustomer = Customer::find($customer->id);
        $editCustomer->rut = $request->input('rut');
        $editCustomer->first_name = $request->input('first_name');
        $editCustomer->last_name = $request->input('last_name');
        $editCustomer->civil_status = $request->input('civil_status');
        $editCustomer->profession = $request->input('profession');
        $editCustomer->nationality = $request->input('nationality');
        $editCustomer->commune = $request->input('commune');
        $editCustomer->region = $request->input('region');
        $editCustomer->address = $request->input('address');
        $editCustomer->email = $request->input('email');
        $editCustomer->phone = $request->input('phone');
        if ($editCustomer->save()) {
            Toastr::success("", "¡Cliente Actualizado!");
            return redirect('customers/'.$editCustomer->id.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    /**
     * Search customer
     */
    public function searchCustomer(Request $request)
    {
        $dataCustomer = Pending::whereRut($request->input("customer_rut"))->first();
        if (is_null($dataCustomer)) {
            $dataCustomer = 2;
        }
        return response()->json($dataCustomer);
    }
}
