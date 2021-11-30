<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Models
use App\Models\Collection;
use App\Models\Contract;
use App\Models\Pending;
use App\Models\Task;
use App\Models\Customer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $config = [
        "moduleName" => "Dashboard",
        "routeView" => "modules.dashboard.",
        "routeLink" => "dashboard"
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Index
     */
    public function index()
    {
        // Pending fees
            $pendingFees = Collection::whereStatus('PENDIENTE')->count();

        // Pending clients
            $pendingClients = Pending::whereStatus(1)->count();

        // Pending tasks
            $pendingTasks = Task::whereStatus(1)->count();

        // Lost contracts
            $lostContracts = Pending::whereStatus(3)->count();

        // Contracts won
            $contractsWon = Contract::whereAnnexCode(null)->count();

        // Customer contracts
            $data = Customer::with('contracts')->whereRut(Auth::user()->rut)->first();


            $contracts = Contract::all();

            $contracts_total = Contract::all()->count();

            $total = 0;
            $valor_cuotas = 0;
            $total_cuotas = 0;
            foreach($contracts as $contract){
                $cuotas = Collection::where('contract_id',$contract->id)->get();
                foreach($cuotas as $cuota){

                    $total_cuotas++;
                    if($cuota->amount){
                        $valor_cuotas = $valor_cuotas +  intval($cuota->amount);
                    }

                }
                $cuotas_por_contrato = Collection::where('contract_id',$contract->id)->count();

                $total += $contract->total_contract;
            }
            $promedio = $total / $contracts_total;
            $promedio_numero_de_cuotas = $total_cuotas / $contracts_total;
            $promedio_valor_de_cuotas = $valor_cuotas / $total_cuotas;


           // dd($contracts);

            /*
            if(data.origen == 1){
                name = 'Instagram'
            }
            if(data.origen == 2){
                name = 'Facebook'
            }
            if(data.origen == 3){
                name = 'Llamadas'
            }
            if(data.origen == 4){
                name = 'Email'
            }
            if(data.origen == 5){
                name = 'Mensaje de texto'
            }
            if(data.origen == 6){
                name = 'Campaña Presencial'
            }*/

            $instagram = 0;
            $facebook = 0;
            $llamadas = 0;
            $email = 0;
            $sms = 0;
            $campana = 0;
            $tablero = array();

            foreach($contracts as $contract){
                $customer = Customer::find($contract->customer_id);

                $origen = Pending::where('email',$customer->email)->first();
                if(isset($origen->origen)){
                    $origen = $origen->origen;
                    if($origen == 1){
                        $instagram += $contract->total_contract;
                    }

                    if($origen == 2){
                        $facebook += $contract->total_contract;
                    }

                    if($origen == 3){
                        $llamadas += $contract->total_contract;
                    }

                    if($origen == 4){
                        $email += $contract->total_contract;
                    }

                    if($origen == 5){
                        $sms += $contract->total_contract;
                    }

                    if($origen == 6){
                        $campana += $contract->total_contract;
                    }
                }


            }

            $dateS = Carbon::now()->startOfMonth();
$dateE = Carbon::now()->endOfMonth();
$collections_per_month = Collection::whereBetween('created_at',[$dateS,$dateE])
->get();
dd($collections_per_month);
$total_cuota_x_mes = 0;
$total_cuota_x_mes_pagada = 0;
$users_couta_x_mes = array();
$users_couta_x_mes_pagada = array();
foreach($collections_per_month as $collection){

    $total_cuota_x_mes += floatval($collection->amount);
    if(isset($users_couta_x_mes[$collection->contract->customer->id])){
        $users_couta_x_mes[$collection->contract->customer->id]['total_cuotas'] += floatval($collection->amount);

    }else{
        $users_couta_x_mes[$collection->contract->customer->id] =
        array(
            'customer'=>$collection->contract->customer,
            'total_cuotas'=>floatval($collection->amount)
        );
    }

    if($collection->status == 'PAGADA'){
        $total_cuota_x_mes_pagada += $collection->amount;

        if(isset($users_couta_x_mes_pagada[$collection->contract->customer->id])){
            $users_couta_x_mes_pagada[$collection->contract->customer->id]['total_cuotas'] += floatval($collection->amount);

        }else{
            $users_couta_x_mes_pagada[$collection->contract->customer->id] =
            array(
                'customer'=>$collection->contract->customer,
                'total_cuotas'=>floatval($collection->amount)
            );
        }

    }
}


$data = array(
                'promedio_valor_contrato'=>$promedio,
                'promedio_valor_de_cuotas'=>$promedio_valor_de_cuotas,
                'promedio_numero_de_cuotas'=>$promedio_numero_de_cuotas,
                'facebook'=> $facebook,
                'instagram'=> $instagram,
                'llamadas'=> $llamadas,
                'email'=> $email,
                'sms'=> $sms,
                'campana'=>$campana,
                'total_cuota_x_mes'=>$total_cuota_x_mes,
                'total_cuota_x_mes_pagada'=>$total_cuota_x_mes_pagada,
                'users_couta_x_mes'=>$users_couta_x_mes,
                'users_couta_x_mes_pagada'=>$users_couta_x_mes_pagada
            );


array_push($tablero,$data );



//dd($users_couta_x_mes,$users_couta_x_mes_pagada);

            $dataContract = '';
            if(isset($data->contracts)){
                $dataContract = Contract::with(['causes', 'collections', 'customer'])->find($data->contracts->first->get()->id);

            }

            $user = Auth::user();
                return view($this->config["routeView"] . 'index')
                    ->with('pendingFees', $pendingFees)
                    ->with('pendingClients', $pendingClients)
                    ->with('pendingTasks', $pendingTasks)
                    ->with('lostContracts', $lostContracts)
                    ->with('contractsWon', $contractsWon)
                    ->with('dataContract', $data)
                    ->with('user', $user)
                    ->with("config", $this->config)
                    ->with("tablero", $tablero)
                    ->with("data", $dataContract);
            }


    public function agenda(){
        return view('wordpress.agenda');
    }
}
