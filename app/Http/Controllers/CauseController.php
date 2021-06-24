<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Cause;
use App\Models\Contract;
// Helpers
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class CauseController extends Controller
{
    protected $config = [
        "moduleName" => "Causas",
        "moduleLabel" => "Registro de Causas",
        "routeView" => "modules.causes.",
        "routeLink" => "causes",
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
        //$array = Cause::with('contract')->orderBy('id', 'DESC')->get();
        $array = Contract::with('customer')->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return Datatables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "index")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Record Causes
     */
    public function recordCauses($id)
    {
        // Data cause
            $dataCauses = Contract::with('causes')->find($id);

        // Return view
            return view($this->config["routeView"] . "contracts-list-causes")
                ->with('row', $dataCauses)
                ->with("breadcrumAction", "")
                ->with("config", $this->config);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view($this->config["routeView"] . "add")
                ->with("breadcrumAction", "")
                ->with('contract_id', $id)
                ->with('typeForm', 'create')
                ->with("config", $this->config);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addCause = Cause::create([
            'contract_id' => $request->input('contract_id'),
            'number_rit' => $request->input('number_rit'),
            'court' => $request->input('cours'),
            'matter' => $request->input('matter'),
            'status' => 1
        ]);

        if ($addCause) {
            Toastr::success("", "¡Causa registrada!");
            return redirect('causes/contracts/record-causes/'.$request->input('contract_id'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cause  $cause
     * @return \Illuminate\Http\Response
     */
    public function show(Cause $cause)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cause  $cause
     * @return \Illuminate\Http\Response
     */
    public function edit(Cause $cause, $id)
    {
        // Return view
            return view($this->config["routeView"] . "add")
                ->with("breadcrumAction", "")
                ->with('row', Cause::find($id))
                ->with('typeForm', 'update')
                ->with("config", $this->config);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cause  $cause
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cause $cause)
    {
        $updateCause = Cause::find($request->input('cause_id'));
        $updateCause->number_rit = $request->input('number_rit');
        $updateCause->court = $request->input('cours');
        $updateCause->matter = $request->input('matter');
        if ($updateCause->save()) {
            Toastr::success("", "¡Causa actualizada");
            return redirect('causes/contracts/record-causes/add-cause/edit/'.$request->input('cause_id'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cause  $cause
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cause $cause)
    {
        //
    }
}
