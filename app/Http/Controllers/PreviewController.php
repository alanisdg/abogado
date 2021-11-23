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
     $array = Contact::orderBy('id', 'DESC')->where('state_id','!=',2)->where('state_id','!=',5)->get();

        if ($request->ajax()) {
            return DataTables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "preview")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }


    public function calendar(Request $request)
    {

        $search = $request->search;
        $date = date('Y-m-d');
        $error = false;
        if(!empty(request()->search)){
            $pending =  Pending::where('names', 'like', '%' . request()->search . '%')
            ->orWhere('phone', 'like', '%' . request()->search  . '%')
            ->orWhere('email', 'like', '%' . request()->search  . '%')->take(1)->get();


            $count =  Pending::where('names', 'like', '%' . request()->search . '%')
            ->orWhere('phone', 'like', '%' . request()->search  . '%')
            ->orWhere('email', 'like', '%' . request()->search  . '%')->take(1)->count();


            if($count > 0){
                $deit = explode (' ', $pending[0]->interview_date);
                $date = $deit[0];
            }else{
                $error = 'No se han encontrado resultados';
            }

        }


        return view($this->config["routeView"] . "calendar",compact('search','date','error'))
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }


    public function events()
    {
        if(!empty(request()->search)){
            $pendings =  Pending::where('names', 'like', '%' . request()->search . '%')
            ->orWhere('phone', 'like', '%' . request()->search  . '%')
            ->orWhere('email', 'like', '%' . request()->search  . '%')->take(1)->get();


        }else{
            $pendings =  Pending::all();
        }


        $events = array();
        foreach($pendings as $pending){
            if($pending->interview_date != null){
                $deit = explode (' ', $pending->interview_date);

                $event = array(
                    'start'=>$deit[0] . ' ' . $deit[1] ,
                    'end'=>$deit[0] . ' '. $deit[3] ,

                    'title'=>$pending->names . ' <br> Email: '
                            . $pending->email . ' <br> Teléfono: '
                            . $pending->phone . ' <br> Horario: '
                            . $deit[0] . ' ' . $deit[1] .' a '. $deit[0] . ' '. $deit[3] . '<hr><br><br>',
                            'color'=>'purple',
                            'textColor'=>'red',
                            'backgroundColor'=>'red',
                            'borderColor'=>'yellow',
                            'className'=>'lecolor',
                            'email'=>$pending->email,
                    'phone'=>$pending->phone,
                );
                array_push($events,$event);
            }

            if($pending->second_date != null){
                $deit = explode (' ', $pending->second_date);

                $event = array(
                    'start'=>$deit[0] . ' ' . $deit[1] ,
                    'end'=>$deit[0] . ' '. $deit[3] ,
                    'className'=>'second_inter',
                    'title'=>$pending->names . ' <br> Email: '
                            . $pending->email . ' <br> Teléfono: '
                            . $pending->phone . ' <br> Horario: '
                            . $deit[0] . ' ' . $deit[1] .' a '. $deit[0] . ' '. $deit[3] . '<hr><br><br>',
                    'email'=>$pending->email,
                    'phone'=>$pending->phone,
                    'interview'=>2
                );

                array_push($events,$event);
            }


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
