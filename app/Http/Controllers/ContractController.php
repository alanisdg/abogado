<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Cause;
use App\Models\Collection;
use App\Models\User;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ContractController extends Controller
{
    protected $config = [
        "moduleName" => "Contratos",
        "moduleLabel" => "Contratos",
        "routeView" => "modules.contracts.",
        "routeLink" => "contracts",
        "add" => "Crear Contrato",
        "edit" => "Editar Contrato"
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
        $array = Contract::with(['user', 'customer'])->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return Datatables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "list")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function step1()
    {
        return view($this->config["routeView"] . "step-1")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('typeForm', 'create');
    }
    /**
     * Create contract step 2
     */
    public function step2()
    {
        return view($this->config["routeView"] . "step-2")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('typeForm', 'create');
    }
    /**
     * Create contract step 3
     */
    public function step3()
    {
        return view($this->config["routeView"] . "step-3")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('typeForm', 'create');
    }
    /**
     * Create contract step 4
     */
    public function step4()
    {
        return view($this->config["routeView"] . "step-4")
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
    public function store(Request $request)
    {
        $customer = json_decode($request->input('data_customer'));
        $parameters = json_decode($request->input('data_parameters'));
        $cuotes = json_decode($request->input('data_cuotes'));

        // Register customer
            $addCustomer = new Customer();
            $addCustomer->rut = $customer[2];
            $addCustomer->customer = $customer[0];
            $addCustomer->civil_status = $customer[1];
            $addCustomer->profession = $customer[3];
            $addCustomer->nationality = $customer[4];
            $addCustomer->commune = $customer[7];
            $addCustomer->region = $customer[9];
            $addCustomer->address = $customer[5];
            $addCustomer->phone = $customer[6];
            $addCustomer->email = $customer[8];
            if ($addCustomer->save()) {
                // Register contract
                    $addContract = new Contract();
                    $addContract->user_id = Auth::user()->id;
                    $addContract->type_contract = "CONTRATO DE PRESTACIÓN DE SERVICIOS JURIDICOS";
                    $addContract->customer_id = $addCustomer->id;
                    $addContract->contract_date = $parameters[0];
                    $addContract->total_contract = $parameters[1];
                    $addContract->save();

                // Register causes
                    $addCause = new Cause();
                    $addCause->contract_id = $addContract->id;
                    $addCause->number_rit = $parameters[2];
                    $addCause->court = $parameters[4];
                    $addCause->matter = $parameters[6];
                    $addCause->status = 1;
                    $addCause->save();

                // Registers collections
                    $number_cuote = 0;

                    for ($i=0; $i < $cuotes[0]; $i++) {
                        $number_cuote = $number_cuote + 1;

                        Collection::create([
                            "contract_id" => $addContract->id,
                            "installment_number" => $number_cuote,
                            "amount" => $cuotes[1],
                            "status" => 1
                        ]);
                    }

                // Return response
                    return response()->json(1);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
