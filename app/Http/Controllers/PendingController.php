<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Use models
use App\Models\Pending;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use App\Imports\PendingImport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class PendingController extends Controller
{
    protected $config = [
        "moduleName" => "Pendientes",
        "moduleLabel" => "Carga de Pendientes",
        "routeView" => "modules.pending.",
        "routeLink" => "pending",
        "add" => "Agregar Pendientes",
        "edit" => "Editar Pendientes",
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
    public function index()
    {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Excel::import(new PendingImport, $request->file);

        Toastr::success("", "¡Carga de Datos Completada!");
        return redirect('list-pending');
    }

    /**
     * Pending list
     */
    public function listPending(Request $request)
    {
        $array = Pending::orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return Datatables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "list")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pending  $pending
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataPending = Pending::find($id);

        return view($this->config["routeView"] . "details")
                ->with("breadcrumAction", "")
                ->with('row', $dataPending)
                ->with("config", $this->config);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pending  $pending
     * @return \Illuminate\Http\Response
     */
    public function edit(Pending $pending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pending  $pending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pending $pending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pending  $pending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pending $pending)
    {
        //
    }

    /**
     * Update status
     */
    public function updateStatus(Request $request)
    {
        $dataPending = Pending::whereId($request->input('id'))->first();
        ($dataPending->status == 1) ? $status = 3 : $status = 1;
        $dataPending->update(['status' => $status]);


        return response()->json(1);
    }
}
