<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Pending;
use App\Models\Preview;
use Illuminate\Http\Request;

class WordpressController extends Controller
{
    public function form(){
        $contacts= Contact::all();

        return view('modules.wordpress.form',compact('contacts'));
    }

    public function dates(Request $request){
        // return $request;
       $date = $request->date;

       $contacts= Pending::all();
        $entrevistas = 0;
       foreach($contacts as $contact){
        if($contact->interview_date != null){

            $interview = explode(' ',$contact->interview_date);

            if($request->date == $interview[0]){

                $horas = explode('-',$contact->hora);
                $horas_primera = $horas[0];
                $horas_primera = substr($horas_primera, 0, -1);

                if($request->hora == $interview[1]){
                   $entrevistas++;
                }
            }
        }

       }
        return $entrevistas;
    }
}
