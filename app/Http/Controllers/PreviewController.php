<?php

namespace App\Http\Controllers;

use App\Imports\PendingImport;
use App\Imports\PreviewImport;
use App\Models\Contact;
use App\Models\Pending;
use App\Models\Preview;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PreviewController extends Controller
{
    protected $config = [
        "moduleName" => "Lista Preview",
        "moduleLabel" => "Carga de Preview",
        "routeView" => "modules.preview.",
        "routeLink" => "pending",
        "add" => "Agregar Pendientes",
        "edit" => "Editar Pendientes",
    ];


    public function updateStatus(Request $request)
    {
        $dataPending = Contact::whereId($request->input('id'))->first();
        ($dataPending->state_id == 1) ? $status = 3 : $status = 1;
        $dataPending->update(['state_id' => $status]);

        return response()->json(1);
    }




    public function upload(Request $request){

        Excel::import(new PreviewImport, $request->file);

        Toastr::success("", "¡Carga de Datos Completada!");

        return redirect('list-preview');
    }

    public function convertContactToPending($pending){

        $pending = Pending::create([
            'interview_date'=>$pending->date . ' ' . $pending->hour,
            'names'=>$pending->name,
            'rut'=>$pending->rut,
            'email'=>$pending->email,
            'phone'=>$pending->phone,
            'status'=>1,
        ]);
    }

    public function update(Contact $contact){


        $contact->state_id = request()->state_id;
        $contact->date = request()->date;
        $contact->rut = request()->rut;
        $contact->name = request()->name;
        $contact->comuna = request()->comuna;
        $contact->phone = request()->phone;
        $contact->hour = request()->hour_1 . ' a ' . request()->hour_2;
        $contact->save();

        if(request()->state_id == 2){
            $this->convertContactToPending($contact);
        }
        Toastr::success("", "¡Carga de Datos Completada!");

        return redirect('list-preview');
    }



    public function listPreview(Request $request)
    {
     $array = Contact::orderBy('id', 'DESC')->where('state_id','!=',2)->get();

        if ($request->ajax()) {
            return DataTables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "preview")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }


    public function calendar(Request $request)
    {
        return view($this->config["routeView"] . "calendar")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }


    public function events()
    {
        $pendings =  Pending::where('id','>',26)->get();

        $events = array();
        foreach($pendings as $pending){
            $deit = explode (' ', $pending->interview_date);

            $event = array(
                'start'=>$deit[0] . ' ' . $deit[1] ,
                'end'=>$deit[0] . ' '. $deit[3] ,
                'title'=>$pending->names,
            );
            array_push($events,$event);

        }
        return response()->json( $events);
    }




    public function show($id)
    {

        $dataPending = Contact::find($id);
        if(!empty($dataPending->hour)){
            $hours = explode('a',$dataPending->hour);

            $dataPending->hour_1 = substr($hours[0], 0, -1);
            $dataPending->hour_2= ltrim($hours[1], ' ');

        }

        return view($this->config["routeView"] . "details")
                ->with("breadcrumAction", "")
                ->with('row', $dataPending)
                ->with("config", $this->config);
    }



}
