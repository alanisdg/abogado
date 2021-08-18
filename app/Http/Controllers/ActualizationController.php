<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Contract;
use App\Models\CreditorUpdate;
use App\Models\Update;
use App\Models\Collection;
use App\Models\Creditor;
use App\Models\Customer;

// Helpers
use Brian2694\Toastr\Facades\Toastr;
use DataTables;
use PDF;
use Illuminate\Support\Facades\Mail;

class ActualizationController extends Controller
{
    protected $config = [
        "moduleName" => "Actualización",
        "moduleLabel" => "Actualización",
        "routeView" => "modules.actualize.",
        "routeLink" => "contracts",
        "add" => "Registrar Actualización",
        "typeRegister" => "contract"
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Change creditor
     */
    public function changeCreditor(Request $request)
    {
        // Data contract - customer
            $dataContract = Contract::with('customer')->whereId($request->input('contract_id'))->first();
        // Delete creditor
            if (!is_null($request->input('current_creditor'))) {
                $creditor = Creditor::find($request->input('current_creditor'))->delete();
            }
        // Register new creditor
            $addCreditor = Creditor::create([
                'contract_id' => $request->input('contract_id'),
                'name' => $request->input('new_creditor'),
                'creditor_amount' => $request->input('creditor_amount'),
                'registration_date' => $request->input('creditor_registration_date')
            ]);
        // Register update
            $createUpdate = Update::create([
                'contract_id' => $request->input('contract_id'),
                'type' => 1,
                'creditor_id' => $addCreditor->id,
                'contract_amount' => $request->input('contract_amount'),
                'number_installments' => $request->input('number_installments'),
                'amount_fees' => $request->input('amount_fees'),
                'payment_date_installment' => $request->input('first_installment_payment'),
                'observations' => $request->input('observations'),
            ]);

            if ($createUpdate) {
                // Variables
                    $referentialDate = $request->input('payment_date_installment_strategy');

                // We look for all pending fees
                    $pendingFees = Collection::where([
                            ['contract_id', '=', $request->input('contract_id')],
                            ['status', '=', 'PENDIENTE']
                        ])
                        ->get();

                    foreach ($pendingFees as $fee) {
                        // Fees id
                            $feesId[] = $fee->id;

                        // Settle quotas
                            $cuote = Collection::find($fee->id);
                            $cuote->status = 'FINIQUITADA';
                            $cuote->save();
                    }

                // Number and total amount fees
                    $numberFees = $request->input('number_installments');

                // Seleccionamos le ultimo id de las cuotas finiquitadas
                    $lastIdCuote = end($feesId);

                //We add all the fees
                    for ($i=0; $i < $numberFees; $i++) {
                        // Seleccionamos le ultimo id de las cuotas finiquitadas
                            $number_cuote = $lastIdCuote + 1;

                        // Tomamos la fecha referencial y le añadimos 30 dias
                            $referentialD = date('Y-m-d', strtotime($referentialDate. ' + 30 days'));

                            Collection::create([
                                "contract_id" => $request->input('contract_id'),
                                "installment_number" => $number_cuote,
                                "payment_date" => $referentialD,
                                "amount" => $request->input('amount_fees'),
                                "status" => "PENDIENTE"
                            ]);

                            $referentialDate = $referentialD;
                            $lastIdCuote = $number_cuote;
                    }

                // Data email
                    $emailDetails = [
                        'title' => '¡APPABOPROC!',
                        'url'   => \Request::root(),
                        'title' => 'Cambio de Acreedor Registrado',
                        'email' => $dataContract->customer->email,
                    ];
                //Send mail
                    Mail::send('emails.create-update', $emailDetails, function($message) use ($emailDetails) {
                        $message->from('contacto@appaboproc.com', 'Appboproc');
                        $message->to($emailDetails['email']);
                        $message->subject('Registro de Actualización - Appboproc');
                    });

                Toastr::success("", "¡Actualización registrada!");
                return redirect('contract/actualize/'.$request->input('contract_id'));
            }
    }

    /**
     * Change strategy
     */
    public function changeStrategy(Request $request)
    {
        // Data contract - customer
            $dataContract = Contract::with('customer')->whereId($request->input('contract_id'))->first();
        // Register update
            $createUpdate = Update::create([
                'contract_id' => $request->input('contract_id'),
                'type' => 2,
                'strategy_contract_amount' => $request->input('strategy_contract_amount'),
                'number_strategy_installments' => $request->input('number_strategy_installments'),
                'amount_strategy_fees' => $request->input('amount_strategy_fees'),
                'payment_date_installment_strategy' => $request->input('payment_date_installment_strategy'),
                'observations' => $request->input('observations'),
            ]);

            if ($createUpdate) {

                // Variables
                    $referentialDate = $request->input('payment_date_installment_strategy');

                // We look for all pending fees
                    $pendingFees = Collection::where([
                            ['contract_id', '=', $request->input('contract_id')],
                            ['status', '=', 'PENDIENTE']
                        ])
                        ->get();

                // Number and total amount fees
                    $numberFees = $request->input('number_strategy_installments');

                    foreach ($pendingFees as $fee) {
                        // Fees id
                            $feesId[] = $fee->id;

                        // Settle quotas
                            $cuote = Collection::find($fee->id);
                            $cuote->status = 'FINIQUITADA';
                            $cuote->save();
                    }

            // Seleccionamos le ultimo id de las cuotas finiquitadas
                $lastIdCuote = end($feesId);

            //We add all the fees
                for ($i=0; $i < $numberFees; $i++) {
                    // Seleccionamos le ultimo id de las cuotas finiquitadas
                        $number_cuote = $lastIdCuote + 1;

                    // Tomamos la fecha referencial y le añadimos 30 dias
                        $referentialD = date('Y-m-d', strtotime($referentialDate. ' + 30 days'));

                        Collection::create([
                            "contract_id" => $request->input('contract_id'),
                            "installment_number" => $number_cuote,
                            "payment_date" => $referentialD,
                            "amount" => $request->input('amount_strategy_fees'),
                            "status" => "PENDIENTE"
                        ]);

                        $referentialDate = $referentialD;
                        $lastIdCuote = $number_cuote;
                }

            // Data email
                $emailDetails = [
                    'title' => '¡APPABOPROC!',
                    'url'   => \Request::root(),
                    'title' => 'Cambio de Estrategia Registrada',
                    'email' => $dataContract->customer->email,
                ];
            //Send mail
                Mail::send('emails.create-update', $emailDetails, function($message) use ($emailDetails) {
                    $message->from('contacto@appaboproc.com', 'Appboproc');
                    $message->to($emailDetails['email']);
                    $message->subject('Registro de Actualización - Appboproc');
                });

                Toastr::success("", "¡Actualización registrada!");
                return redirect('contract/actualize/'.$request->input('contract_id'));
            }
    }

    /**
     * Account holder change
     */
    public function accountHolderChange(Request $request)
    {
        // Data contract - customer
            $dataContract = Contract::with('customer')->whereId($request->input('contract_id'))->first();

        // Register Customer
            $addCustomer = Customer::create([
                "rut" => $request->input('rut'),
                "customer" => $request->input('new_account_holder'),
                "civil_status" => $request->input('civil_status'),
                "profession" => $request->input('profession'),
                "nationality" => $request->input('nationality'),
                "address" => $request->input('address'),
                "commune" => $request->input('commune'),
                "region" => $request->input('region'),
                "phone" => $request->input('phone'),
                "home_phone" => $request->input('home_phone'),
                "email" => $request->input('email')
            ]);

        // Register update
            $createUpdate = Update::create([
                'contract_id' => $request->input('contract_id'),
                'type' => 4,
                'customer_id' => $addCustomer->id,
                'holder_amount' => $request->input('contract_amount'),
                'observations' => $request->input('observations')
            ]);

        // We update the payment plan
            if ($createUpdate) {
                // Variables
                    $referentialDate = $request->input('date_first_payment');

                // We look for all pending fees
                    $pendingFees = Collection::where([
                                            ['contract_id', '=', $request->input('contract_id')],
                                            ['status', '=', 'PENDIENTE']
                                        ])
                                        ->get();

                    foreach ($pendingFees as $fee) {
                        // Fees id
                            $feesId[] = $fee->id;

                        // Settle quotas
                            $cuote = Collection::find($fee->id);
                            $cuote->status = 'FINIQUITADA';
                            $cuote->save();
                    }

                // Seleccionamos le ultimo id de las cuotas finiquitadas
                    $lastIdCuote = end($feesId);

                //We add all the fees
                    for ($i=0; $i < $request->input('number_installments'); $i++) {

                        // Seleccionamos le ultimo id de las cuotas finiquitadas
                            $number_cuote = $lastIdCuote + 1;

                            Collection::create([
                                "contract_id" => $request->input('contract_id'),
                                "installment_number" => $number_cuote,
                                "payment_date" => $referentialDate,
                                "amount" => $request->input('amount_fees'),
                                "status" => "PENDIENTE"
                            ]);

                            // Tomamos la fecha referencial y le añadimos 30 dias
                            $referentialD = date('Y-m-d', strtotime($referentialDate. ' + 30 days'));

                            $referentialDate = $referentialD;
                            $lastIdCuote = $number_cuote;
                    }

                // Data email
                    $emailDetails = [
                        'title' => '¡APPABOPROC!',
                        'url'   => \Request::root(),
                        'title' => 'Cambio de Titular de Cuenta Efectuado',
                        'email' => $dataContract->customer->email,
                    ];
                //Send mail
                    Mail::send('emails.create-update', $emailDetails, function($message) use ($emailDetails) {
                        $message->from('contacto@appaboproc.com', 'Appboproc');
                        $message->to($emailDetails['email']);
                        $message->subject('Registro de Actualización - Appboproc');
                    });

                // Return response
                    Toastr::success("", "¡Actualización registrada!");
                    return redirect('contract/actualize/'.$request->input('contract_id'));
            }
    }

    /**
     * Change payment date
     */
    public function changePaymentDate(Request $request)
    {
        // Data contract - customer
            $dataContract = Contract::with('customer')->whereId($request->input('contract_id'))->first();

        // Dates
            $nextDate = $request->input('nextPaymentDate');
            $newDate = $request->input('deceased_new_payment_date');

        // Variables
            $referentialDate = $newDate;

        // Validate dates
            if (strtotime($newDate) > strtotime($nextDate) ) {

                // Register update
                    $createUpdate = Update::create([
                        'contract_id' => $request->input('contract_id'),
                        'type' => 3,
                        'contract_amount' => $request->input('deceased_new_payment_amount'),
                        'number_installments' => $request->input('deceased_amount_fees'),
                        'amount_fees' => $request->input('deceased_quota_amount'),
                        'payment_date_installment' => $request->input(''),
                        'change_payment_date' => $newDate,
                        'observations' => $request->input('observations')
                    ]);

                if ($createUpdate) {
                    // Search collections
                        $cuotes = Collection::where([
                            ['contract_id', '=', $request->input('contract_id')],
                            ['status', '=', 'PENDIENTE']
                        ])
                        ->get();

                    // Validate collections
                        foreach ($cuotes as $value) {
                            // Fees id
                                $feesId[] = $value->id;

                            // Settle quotas
                                $cuote = Collection::find($value->id);
                                $cuote->status = 'FINIQUITADA';
                                $cuote->save();
                        }

                    // Last id from cuotes terminates
                        $lastIdCuote = end($feesId);

                    //We add all the fees
                        for ($i=0; $i < $request->input('deceased_amount_fees'); $i++) {

                            // Seleccionamos le ultimo id de las cuotas finiquitadas
                                $number_cuote = $lastIdCuote + 1;

                                Collection::create([
                                    "contract_id" => $request->input('contract_id'),
                                    "installment_number" => $number_cuote,
                                    "payment_date" => $referentialDate,
                                    "amount" => $request->input('deceased_quota_amount'),
                                    "status" => "PENDIENTE"
                                ]);

                                // Tomamos la fecha referencial y le añadimos 30 dias
                                    $referentialD = date('Y-m-d', strtotime($referentialDate. ' + 30 days'));

                                    $referentialDate = $referentialD;
                                    $lastIdCuote = $number_cuote;
                        }

                    // Data email
                        $emailDetails = [
                            'title' => '¡APPABOPROC!',
                            'url'   => \Request::root(),
                            'title' => 'Cambio de Fecha de Pago Registrado',
                            'email' => $dataContract->customer->email,
                        ];
                    //Send mail
                        Mail::send('emails.create-update', $emailDetails, function($message) use ($emailDetails) {
                            $message->from('contacto@appaboproc.com', 'Appboproc');
                            $message->to($emailDetails['email']);
                            $message->subject('Registro de Actualización - Appboproc');
                        });

                    // Return response
                        Toastr::success("", "¡Fechas de Pagos Actualizadas!");
                        return redirect('contract/actualize/'.$request->input('contract_id'));
                }
            }
            else {
                Toastr::error("", "¡La nueva fecha de pago, debe ser mayor a la fecha del proximo pago!");
                return redirect('contract/actualize/'.$request->input('contract_id'));
            }
    }

    /**
     * Deceased customer
     */
    public function deceasedCustomer(Request $request)
    {
        // Data contract - customer
            $dataContract = Contract::with('customer')->whereId($request->input('contract_id'))->first();

        // Register Customer
            $addCustomer = Customer::create([
                "rut" => $request->input('rut'),
                "customer" => $request->input('customer'),
                "civil_status" => $request->input('civil_status'),
                "profession" => $request->input('profession'),
                "nationality" => $request->input('nationality'),
                "address" => $request->input('address'),
                "commune" => $request->input('commune'),
                "region" => $request->input('region'),
                "phone" => $request->input('phone'),
                "home_phone" => $request->input('home_phone'),
                "email" => $request->input('email')
            ]);

        // Register update
            $createUpdate = Update::create([
                'contract_id' => $request->input('contract_id'),
                'type' => 5,
                'customer_id' => $addCustomer->id,
                'deceased_new_payment_amount' => $request->input('deceased_new_payment_amount'),
                'deceased_amount_fees' => $request->input('deceased_amount_fees'),
                'deceased_quota_amount' => $request->input('deceased_quota_amount'),
                'deceased_new_payment_date' => $request->input('deceased_new_payment_date'),
                'observations' => $request->input('observations')
            ]);

            if ($createUpdate) {
                // Variables
                    $referentialDate = $request->input('deceased_new_payment_date');

                // Search collections
                    $cuotes = Collection::where([
                                ['contract_id', '=', $request->input('contract_id')],
                                ['status', '=', 'PENDIENTE']
                            ])
                            ->get();

                // Validate collections
                    foreach ($cuotes as $value) {
                        // Fees id
                            $feesId[] = $value->id;

                        // Update fees
                            $updateCuote = Collection::find($value->id);
                            $updateCuote->status = "FINIQUITADA";
                            $updateCuote->save();
                    }

                // Seleccionamos le ultimo id de las cuotas finiquitadas
                    $lastIdCuote = end($feesId);

                //We add all the fees
                    for ($i=0; $i < $request->input('deceased_amount_fees'); $i++) {
                        // Seleccionamos le ultimo id de las cuotas finiquitadas
                            $number_cuote = $lastIdCuote + 1;

                            Collection::create([
                                "contract_id" => $request->input('contract_id'),
                                "installment_number" => $number_cuote,
                                "payment_date" => $referentialDate,
                                "amount" => $request->input('deceased_quota_amount'),
                                "status" => "PENDIENTE"
                            ]);

                            // Tomamos la fecha referencial y le añadimos 30 dias
                                $referentialD = date('Y-m-d', strtotime($referentialDate. ' + 30 days'));

                            $referentialDate = $referentialD;
                            $lastIdCuote = $number_cuote;
                    }

                // Data email
                    $emailDetails = [
                        'title' => '¡APPABOPROC!',
                        'url'   => \Request::root(),
                        'title' => 'Registro de Fallecido Registrado',
                        'email' => $dataContract->customer->email,
                    ];
                //Send mail
                    Mail::send('emails.create-update', $emailDetails, function($message) use ($emailDetails) {
                        $message->from('contacto@appaboproc.com', 'Appboproc');
                        $message->to($emailDetails['email']);
                        $message->subject('Registro de Actualización - Appboproc');
                    });

                // Return response
                    Toastr::success("", "¡Actualización registrada!");
                    return redirect('contract/actualize/'.$request->input('contract_id'));
            }
    }

    /**
     * Print document
     */
    public function printDocument($id, $type)
    {
        // Search data
            $data = Update::with(['customer', 'contract', 'contract.collections'])->find($id);

        // Share data to view
            view()->share('data', $data);

        // Select type document
            if ($type == 1) { // Change creditor
                $pdf = PDF::loadView('modules.contracts.pdfs.change-creditor');
                $title = "Cambio_de_Acreedor.pdf";
            }
            elseif ($type == 2) { // Change strategy
                $pdf = PDF::loadView('modules.contracts.pdfs.change-strategy');
                $title = "Cambio_de_Estrategia.pdf";
            }
            elseif ($type == 3) { // Change payment date
                $pdf = PDF::loadView('modules.contracts.pdfs.change-payment-date');
                $title = "Cambio_Fecha_de_Pago.pdf";
            }
            elseif ($type == 4) { // Account holder change
                $pdf = PDF::loadView('modules.contracts.pdfs.account-holder-change');
                $title = "Cambio_Titular_de_Cuenta.pdf";
            }
            else { // Deceased
                $pdf = PDF::loadView('modules.contracts.pdfs.deceased');
                $title = "Fallecido.pdf";
            }

        // Download pdf
            return $pdf->download($title);
    }
}
