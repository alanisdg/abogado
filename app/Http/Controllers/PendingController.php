<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Use models
use App\Models\Pending;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use App\Imports\PendingImport;
use App\Models\Log;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

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
        return view($this->config["routeView"] . "create-customer")
                ->with("breadcrumAction", "")
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
        Excel::import(new PendingImport, $request->file);

        Toastr::success("", "¡Carga de Datos Completada!");
        return redirect('list-pending');
    }

    /**
     * Customer store
     */
    public function storeCustomer(Request $request)
    {
        $add = Pending::create([
                'rut' => $request->input('rut'),
                'names' => $request->input('name'),
                'surnames' => $request->input('last_name'),
                'nationality' => $request->input('nationality'),
                'phone' => $request->input('phone'),
                'home_phone' => $request->input('home_phone'),
                'email' => $request->input('email'),
                'civil_status' => $request->input('civil_status'),
                'profession' => $request->input('profession'),
                'region' => $request->input('region'),
                'commune' => $request->input('commune'),
                'address' => $request->input('address'),
                'observations' => $request->input('observations'),
                'status' => 1
            ]);

            Log::create([
                'user_id'=>Auth::user()->id,
                'action'=>'Creo un nuevo cliente',
                'target_id'=>$add->id
            ]);

        // Response
            if ($add) {
                Toastr::success("", "¡Cliente registrado!");
                return redirect('list-pending');
            }
    }

    /**
     * Pending list
     */
    public function listPending(Request $request)
    {
        //$array = Pending::orderBy('status', 'ASC')->get();
        $ganados = Pending::where('status',2)->get()->toArray();
        $duda = Pending::where('status',4)->get()->toArray();
        $perdido = Pending::where('status',3)->get()->toArray();
        $pendiente = Pending::where('status',1)->get()->toArray();
        $array= array();

        if($request->id == 'false'){

            foreach($duda as $ganado){
                array_push($array,$ganado);
            }
            foreach($pendiente as $ganado){
                array_push($array,$ganado);
            }
            foreach($perdido as $ganado){
                array_push($array,$ganado);
            }
            foreach($ganados as $ganado){
                array_push($array,$ganado);
            }
        }else{
            $array = Pending::where('status',$request->id)->get()->toArray();


        }

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
        $date = explode( ' ' , $dataPending->interview_date);

        $dataPending->date2 = '';
        $dataPending->hour2 = '';
        if($dataPending->second_date != '' ){
            $date2 = explode( ' ' , $dataPending->second_date);
            $dataPending->date2 = $date2[0];
            $dataPending->hour2 = $date2[1].' '. $date2[2].' '.$date2[3];
        }


        $dataPending->date = $date[0];
        $dataPending->hour = $date[1].' '. $date[2].' '.$date[3];




        return view($this->config["routeView"] . "details")
                ->with("breadcrumAction", "")
                ->with('row', $dataPending)
                ->with("config", $this->config);
    }

    public function updateInterview(Request $request){


        $date1 = $request->day1 . ' ' . $request->hour1;
        $date2 = $request->day2 . ' ' . $request->hour2;


        $pending = Pending::find($request->id);
        $pending->interview_date = $date1;
        if( $date2 != " "){
            $pending->second_date = $date2;
        }


        $pending->save();
        return redirect()->back();

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

        $dataPending->update(['status' => $request->status ]);

        return response()->json(1);
    }

    /**
     * Add user
     */
    public function addUser($id)
    {
        // Data pending
            $dataPending = Pending::whereId($id)->first(['id', 'names', 'surnames', 'rut', 'email']);

            //dd($dataPending);

        // Return view
            return view($this->config["routeView"] . "add-user")
                    ->with("breadcrumAction", "")
                    ->with('row', $dataPending)
                    ->with("config", $this->config);
    }
}
