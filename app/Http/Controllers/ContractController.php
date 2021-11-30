<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Cause;
use App\Models\Collection;
use App\Models\Log;
use App\Models\Pending;
use App\Models\User;
use App\Models\Role;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DateTime;
use PDF;
use Illuminate\Support\Facades\Mail;

class ContractController extends Controller
{
    protected $config = [
        "moduleName" => "Contratos",
        "moduleLabel" => "Contratos",
        "routeView" => "modules.contracts.",
        "routeLink" => "contracts",
        "add" => "Crear Contrato",
        "typeRegister" => "contract"
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
        $array = Contract
                        ::with(['user', 'customer'])
                        ->whereNull('annex_code')
                        ->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return Datatables::of($array)->make(true);
        }

        return view($this->config["routeView"] . "list")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function step1()
    {
        return view($this->config["routeView"] . "step-1")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('typeForm', 'create');
    }
    /**
     * Create contract step 2
     */
    public function step2()
    {
        return view($this->config["routeView"] . "step-2")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('typeForm', 'create');
    }
    /**
     * Create contract step 3
     */
    public function step3()
    {
        return view($this->config["routeView"] . "step-3")
            ->with("breadcrumAction", "Crear")
            ->with('config', $this->config)
            ->with('typeForm', 'create');
    }
    /**
     * Create contract step 4
     */
    public function step4()
    {
        return view($this->config["routeView"] . "step-4")
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

        $customer = json_decode($request->input('data_customer'));
        $parameters = json_decode($request->input('data_parameters'));
        $cuotes = json_decode($request->input('data_cuotes'));

        if ($request->input("data_type_register") === "annexed") {
                $description_log = 'Creo un anexo';
            // We look for contracts that have an annex code
                $dataContract = Contract::whereNotNull("annex_code")->orderBy('id', 'desc')->first();
                if (!is_null($dataContract)) {
                    $annexCode = $dataContract->annex_code;
                    $annexCode++;
                } else {
                    $annexCode = "AX 1";
                }

            // Current contract id
                $currentContractId = session("idContract");
        }
        else {
            $description_log = 'Creo un contrato';
            $annexCode = null;
            $currentContractId = null;
        }

        // Register customer
            $addCustomer = Customer::firstOrCreate(
                ['rut' => $customer[2]],
                [
                    "customer" => $customer[0],
                    "civil_status" => $customer[1],
                    "profession" => $customer[3],
                    "nationality" => $customer[4],
                    "commune" => $customer[8],
                    "region" => $customer[10],
                    "address" => $customer[5],
                    "phone" => $customer[6],
                    "home_phone" => $customer[7],
                    "email" => $customer[9]
                ]
            );

            if ($addCustomer) {
                // Register contract
                    $addContract = new Contract();
                    $addContract->number_contract = $currentContractId;
                    $addContract->annex_code = $annexCode;
                    $addContract->user_id = Auth::user()->id;
                    $addContract->type_contract = "CONTRATO DE PRESTACIÓN DE SERVICIOS JURIDICOS";
                    $addContract->customer_id = $addCustomer->id;
                    $addContract->contract_date = $parameters[0];
                    $addContract->total_contract = $parameters[1];
                    $addContract->first_payment_amount = $parameters[6];
                    $addContract->first_installment_payment_date = $parameters[4];
                    $addContract->number_installments = $cuotes[0] + 1;
                    $addContract->amount_fees = $cuotes[1];
                    $addContract->status = 1;
                    $addContract->save();


                    Log::create([
                        'user_id'=>Auth::user()->id,
                        'action'=>$description_log,
                        'contract_id'=>$addContract->id
                    ]);
                // Register causes
                    $addCause = new Cause();
                    $addCause->contract_id = $addContract->id;
                    $addCause->number_rit = $parameters[2];
                    $addCause->court = $parameters[5];
                    $addCause->matter = $parameters[7];
                    $addCause->status = 1;
                    $addCause->save();

                // Registers collections
                    $number_cuote = 1;
                    // The payment of the first installment is added
                        Collection::create([
                            "contract_id" => $addContract->id,
                            "installment_number" => 1,
                            "payment_date" => $parameters[4],
                            "amount" => $parameters[6],
                            "status" => "PENDIENTE"
                        ]);

                    // Referential date
                        $referentialDate = $parameters[4];

                    //We add all the fees
                        for ($i=0; $i < $cuotes[0]; $i++) {
                            $number_cuote = $number_cuote + 1;

                            // We calculate the number of days per month
                                /*if (date('t') == 31) {
                                    $referentialD = date('Y-m-d', strtotime($referentialDate. '+ 31 days'));
                                }
                                elseif (date('t') == 30) {
                                    $referentialD = strtotime($referentialDate. '+ 30 days');
                                }
                                elseif (date('t') == 29) {
                                    $referentialD = strtotime($referentialDate. '+ 29 days');
                                }
                                else {
                                    $referentialD = strtotime($referentialDate. '+ 28 days');
                                }*/

                                $referentialD = date('Y-m-d', strtotime($referentialDate. '+1 month'));

                                Collection::create([
                                    "contract_id" => $addContract->id,
                                    "installment_number" => $number_cuote,
                                    "payment_date" => $referentialD,
                                    "amount" => $cuotes[1],
                                    "status" => "PENDIENTE"
                                ]);

                                $referentialDate = $referentialD;
                        }
                // Update pending
                    $upPending = Pending::whereRut($customer[2])->first();
                    $upPending->status = 2;
                    $upPending->save();
                // Create user
                //dd($customer);
                    $pass = substr($customer[2], 0, 6);
                    $name = explode(" ", $customer[0]);

                    $addUser = User::firstOrCreate(
                        ['email' => $customer[9]],
                        [
                            'rut' => $customer[2],
                            'first_name' => $name[0],
                            'last_name' => $name[1],
                            'password' => bcrypt($pass),
                            'status' => 1
                        ]
                    );

                    // Awsign role
                        $role = Role::find(5);
                        $addUser->roles()->sync($role);

                // Data email
                    $emailDetails = [
                        'title' => 'Appboproc!',
                        'url'   => \Request::root(),
                        'user' => $addUser->name.' '.$addUser->last_name,
                        'email' => $customer[9],
                        'pass' => $pass
                    ];

                    //Send mail
                    //return $request->input("data_type_register");

                    //ADJUNTAR PDF
                    $dataContract = Contract::with(['causes', 'collections', 'customer'])->find($addContract->id);

                    // Share data to view
                        view()->share('data', $dataContract);

                    $pdf = PDF::loadView('modules.contracts.pdfs.contract');


                    if ($request->input("data_type_register") === "annexed") {
                        Mail::send('emails.contract-documents', $emailDetails, function($message) use ($emailDetails,$pdf) {
                            $message->from('contacto@appaboproc.com', 'Appboproc');
                            $message->to($emailDetails['email']);
                            $message->subject('Registro de Anexo - Appboproc')
                            ->attachData($pdf->output(), "contrato.pdf");
                        });

                        Mail::send('emails.create-annexes', $emailDetails, function($message) use ($emailDetails,$pdf) {
                            $message->from('contacto@appaboproc.com', 'Appboproc');
                            $message->to($emailDetails['email']);
                            $message->subject('Registro de Anexo - Appboproc')
                            ->attachData($pdf->output(), "contrato.pdf");
                        });

                    }
                    else {
                        Mail::send('emails.create-contract', $emailDetails, function($message) use ($emailDetails,$pdf) {
                            $message->from('contacto@appaboproc.com', 'Appboproc');
                            $message->to($emailDetails['email']);
                            $message->subject('Registro de Contrato - Appboproc')
                            ->attachData($pdf->output(), "contrato.pdf");
                        });
                    }

                // Return response
                    return response()->json(["response_code" => 1, "contract_id" => session("idContract")]);
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data contract
            $dataContract = Contract::with(['customer', 'causes'])->find($id);

        // Data cause
            foreach ($dataContract->causes as $value) {
                $cause = $value;
            }

        // Return view
            return view($this->config["routeView"] . "edit")
                ->with("breadcrumAction", "")
                ->with("row", $dataContract)
                ->with("cause", $cause)
                ->with("config", $this->config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        // Data contract
            $contract = Contract::find($request->input('contract_id'));

        // Update data customer
            $contract->customer->update([
                "rut" => $request->input("rut"),
                "customer"      => $request->input("customer"),
                "civil_status"  => $request->input("civil_status"),
                "profession"    => $request->input("profession"),
                "nationality"   => $request->input("email"),
                "commune"       => $request->input("commune"),
                "region"        => $request->input("region"),
                "address"       => $request->input("address"),
                "phone"         => $request->input("phone"),
                "home_phone"    => $request->input("home_phone"),
                "email"         => $request->input("email")
            ]);

        // Return response
            if (!is_null($request->input('annexed'))) {
                Toastr::success("", "¡Detalles de Anexo Actualizado!");
                return redirect('list-contracts/annexes/edit/'.$contract->id.'');
            }
            else {
                Toastr::success("", "¡Detalles de Contrato Actualizado!");
                return redirect('contract/edit/'.$contract->id.'');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }

    /**
     * Actualize contract
     */
    public function actualizeContract($id)
    {
        // Data contract
            $dataContract = Contract::with(['customer', 'causes', 'updates', 'collections', 'creditors'])->find($id);
            $collectMount = 0;

        // Collections
            foreach ($dataContract->collections as $value) {
                if ($value->status == 'PENDIENTE') {
                    $collections[] = $value;

                    $amount =  str_replace('.', '', $value->amount);
                    $collectMount += $amount;
                }
            }


        // Return view
            return view($this->config["routeView"] . "actualize")
                    ->with("breadcrumAction", "")
                    ->with("nextPaymentDate", $collections[0]->payment_date)
                    ->with("row", $dataContract)
                    ->with('contractAmount', $collectMount)
                    ->with("config", $this->config);
    }

    /**
     * Terminate contract
     */
    public function terminateContract(Request $request)
    {
        // Data contract
            $dataContract = Contract::with(['causes', 'collections'])->find($request->input("id"));

            // Validate pending quotes
                foreach ($dataContract->collections as $collection) {
                    $currentDate = new DateTime(date('Y-m-d'));
                    $paymentDate = new DateTime($collection->payment_date);

                    if (($collection->status == "PENDIENTE") && ($paymentDate > $currentDate)) {
                        // Array collections to update
                            $collectionsToUPdate[] = $collection->id;
                    }
                    else {
                        // Return response
                            return response()->json(404);
                    }
                }

            // Array collections for update
                foreach ($collectionsToUPdate as $value) {
                    // We settle quota}
                        $upCollection = Collection::find($value);
                        $upCollection->status = "FINIQUITADA";
                        $upCollection->save();
                }

            // Close tash and causes
                foreach ($dataContract->causes as $cause) {
                    // Tasks
                        foreach ($cause->tasks as $task) {
                            // We close the task of the cause
                                $task->update(["date_realization" => date("Y-m-d"), "status" => 2]);
                        }

                    // Update cause
                        $cause->update(["status" => 2]);
                }

        // Finisch contract
            $dataContract->update(["status" => 2]);

        // Return
            return response()->json(200);
    }

    /**
     * Settlement contract
     */
    public function settlementContract($id)
    {
        // Data contract
            $dataContract = Contract::with(['collections', 'customer'])->find($id);

        // Share data to view
            view()->share('contract', $dataContract);
            $pdf = PDF::loadView('modules.contracts.pdfs.contract-settlement');

        // Download pdf
            return $pdf->download('Finiquito_Contrato.pdf');
    }

    /**
     * Print contract
     */
    public function printContract($id)
    {
        // Data contract
            $dataContract = Contract::with(['causes', 'collections', 'customer'])->find($id);

        // Share data to view
            view()->share('data', $dataContract);
            $pdf = PDF::loadView('modules.contracts.pdfs.contract');

        // Download pdf
            return $pdf->download('Contrato.pdf');
    }
}
