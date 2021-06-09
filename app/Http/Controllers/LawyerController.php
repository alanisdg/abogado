<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Lawyer;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

// Request
use App\Http\Requests\LawyersRequest;

class LawyerController extends Controller
{
    protected $config = [
        "moduleName" => "Abogados",
        "moduleLabel" => "Registro de Abogados",
        "routeView" => "modules.lawyers.",
        "routeLink" => "lawyers",
        "add" => "Registrar Abogado",
        "edit" => "Editar Abogado",
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
        $array = Lawyer::orderBy('id', 'DESC')->get();

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
    public function store(LawyersRequest $request)
    {
        $addLawyer = New Lawyer();
        $addLawyer->lawyer_rut = $request->input('lawyer_rut');
        $addLawyer->lawyer_first_name = $request->input('lawyer_first_name');
        $addLawyer->lawyer_last_name = $request->input('lawyer_last_name');
        $addLawyer->charge = $request->input('charge');
        if ($addLawyer->save()) {
            Toastr::success("", "Abogado Registrado!");
            return redirect('lawyers');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Http\Response
     */
    public function show(Lawyer $lawyer)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Lawyer $lawyer)
    {
        return view($this->config["routeView"] . "register")
            ->with("breadcrumAction", "Editar")
            ->with('config', $this->config)
            ->with('typeForm', 'update')
            ->with('row', $lawyer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Http\Response
     */
    public function update(LawyersRequest $request, Lawyer $lawyer)
    {
        $editLawyer = Lawyer::find($lawyer->id);
        $editLawyer->lawyer_rut = $request->input('lawyer_rut');
        $editLawyer->lawyer_first_name = $request->input('lawyer_first_name');
        $editLawyer->lawyer_last_name = $request->input('lawyer_last_name');
        $editLawyer->charge = $request->input('charge');
        if ($editLawyer->save()) {
            Toastr::success("", "Abogado Actualizado!");
            return redirect('lawyers/'.$lawyer->id.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lawyer  $lawyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lawyer $lawyer)
    {
        //
    }
}
