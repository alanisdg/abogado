<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index($id){
        return view('modules.biblioteca.index',compact('id'));
    }

    public function biblioteca($id){
        $files = FIle::where('contract_id',$id)->get();
        return view('modules.biblioteca.biblioteca',compact('files'));
    }

    public function download($id){

        $file = FIle::find($id);
        //dd($file);

        return Storage::download('/filesbiblioteca/'.$file->path);
    }


    public function store(Request $request){
        $validation = $request->validate([
            'file' => 'required|file|mimes:jpeg,png,gif,pdf,ppt'
            // for multiple file uploads
            // 'photo.*' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
            ]);
        $name = time(). $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('filesbiblioteca',$name);
        File::create([
            'path'=>$name,
            'name'=>$request->name,
            'contract_id'=>$request->contract_id,
            'user_id'=>Auth::user()->id,
        ]);
        return back()->with('success','El archivo se ha subido correctamente!');

    }

}
