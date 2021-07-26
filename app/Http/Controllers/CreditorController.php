<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Creditor;
use App\Models\Contract;

// Helpers
use Brian2694\Toastr\Facades\Toastr;

class CreditorController extends Controller
{
    protected $config = [
        "moduleName" => "Acreedores",
        "moduleLabel" => "Registro de Acreedores",
        "routeView" => "modules.creditors.",
        "routeLink" => "creditors",
        "add" => "Registrar Acreedor",
        "edit" => "Editar Acreedor"
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
    public function index($id)
    {
        // Data creditors
            $data = Creditor::whereContractId($id)->get();

        // Data contract
            $dataContract = Contract::find($id);
            if (!is_null($dataContract)) {
                $contract = [$dataContract->id, $dataContract->annex_code, $dataContract->number_contract];
            }

        // Return view
            return view($this->config["routeView"] . "index")
                    ->with("breadcrumAction", "")
                    ->with('data', $data)
                    ->with('contract', $contract)
                    ->with("config", $this->config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view($this->config["routeView"] . "register")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('contract', $id)
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
        $add = new Creditor();
        $add->contract_id = $request->input('contract_id');
        $add->name = $request->input('name');
        $add->creditor_amount = $request->input('creditor_amount');
        $add->registration_date = $request->input('registration_date');
        if ($add->save()) {
            Toastr::success("", "¡Acreedor Registrado!");
            return redirect('creditors/'.$request->input('contract_id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function show(Creditor $creditor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Creditor
            $dataCreditor = Creditor::find($id);

        // Return view
            return view($this->config["routeView"] . "register")
                ->with("breadcrumAction", "Editar")
                ->with('config', $this->config)
                ->with('contract', $id)
                ->with('row', $dataCreditor)
                ->with('typeForm', 'update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update = Creditor::find($request->input('creditor_id'));
        $update->name = $request->input('name');
        $update->creditor_amount = $request->input('creditor_amount');
        $update->registration_date = $request->input('registration_date');
        if ($update->save()) {
            Toastr::success("", "¡Acreedor Actualizado!");
            return redirect('creditors/edit/'.$update->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Creditor  $creditor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creditor $creditor)
    {
        //
    }
}
