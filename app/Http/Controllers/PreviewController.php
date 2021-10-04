<?php

namespace App\Http\Controllers;

use App\Imports\PendingImport;
use App\Imports\PreviewImport;
use App\Models\Contact;
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


    public function preview(){
        return view('modules.preview.preview');
    }

    public function upload(Request $request){

        Excel::import(new PreviewImport, $request->file);

        Toastr::success("", "¡Carga de Datos Completada!");

        return redirect('list-pending');
    }

    public function listPreview(Request $request)
    {
        $array = Contact::orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "preview")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }


}
