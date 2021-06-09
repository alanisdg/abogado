<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\BranchOffice;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

class BranchOfficeController extends Controller
{
    protected $config = [
        "moduleName" => "Sucursales",
        "moduleLabel" => "Registro de Sucursales",
        "routeView" => "modules.branch-offices.",
        "routeLink" => "branch-offices",
        "add" => "Registrar Sucursal",
        "edit" => "Editar Sucursal",
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
        $array = BranchOffice::orderBy('id', 'DESC')->get();

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
    public function store(Request $request)
    {
        $addBranchOffice = New BranchOffice();
        $addBranchOffice->branch_office = $request->input('branch_office');
        if ($addBranchOffice->save()) {
            Toastr::success("", "¡Sucursal Registrada!");
            return redirect('branch-offices');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function show(BranchOffice $branchOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function edit(BranchOffice $branchOffice)
    {
        return view($this->config["routeView"] . "register")
            ->with("breadcrumAction", "Editar")
            ->with('config', $this->config)
            ->with('typeForm', 'update')
            ->with('row', $branchOffice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BranchOffice $branchOffice)
    {
        $updateBranchOffice = BranchOffice::find($branchOffice->id);
        $updateBranchOffice->branch_office = $request->input('branch_office');
        if ($updateBranchOffice->save()) {
            Toastr::success("", "¡Sucursal Actualizada!");
            return redirect('branch-offices/'.$branchOffice->id.'/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BranchOffice  $branchOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(BranchOffice $branchOffice)
    {
        //
    }
}
