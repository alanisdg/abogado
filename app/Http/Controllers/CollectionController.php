<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Collection;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Pending;
// Helpers
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\WebpayPlus;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Mail;

class CollectionController extends Controller
{
    protected $config = [
        "moduleName" => "Cobranzas",
        "moduleLabel" => "Cobranzas",
        "routeView" => "modules.collections.",
        "routeLink" => "collections",
        "add" => "",
        "typeRegister" => ""
    ];

    public function test(){
        dd('t');
            Pending::create([
                'names'=>'horacio'
            ]);


    }
    public function __construct() {
        $this->middleware('auth');

        if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_cc'), config('services.transbank.webpay_plus_api_key'));
        } else {
            WebpayPlus::configureForTesting();
        }
    }

    /**
     * List of fees
     */
    public function listFees()
    {
        return view($this->config["routeView"] . "list")
                ->with("breadcrumAction", "")
                ->with("config", $this->config);
    }

    /**
     * Search collections
     */
    public function searchCollections(Request $request)
    {
        // Data customer
            $data = Customer::with(['contracts', 'contracts.collections'])->whereRut($request->input('customer_rut'))->first();
            foreach ($data->contracts as $contract) {
                $arrayCollections[] = $contract->collections;
            }
            if (!is_null($data)) {
                $collections = $arrayCollections;
            }
            else {
                $collections = null;
            }

        // Response
            return response()->json(["response" => 200, "collections" => $collections]);
    }

    /**
     * List fees
     */
    public function listFeesContract($id)
    {
        // List fees
            $collections = Collection::whereContractId($id)->get();

        // Return view
            return view("modules.collections.list-fees")
                ->with("breadcrumAction", "")
                ->with('dataCollections', $collections)
                ->with("config", $this->config);

    }

    /**
     * Pay fee
     */
    public function payFee($id)
    {
        $dataCollection = Collection::find($id);

        $data = [
            "reference" => "Ref-".$dataCollection->id,
            "sessionId" => $dataCollection->id.'-'.bin2hex(random_bytes(20))
        ];

        return view($this->config["routeView"] . "pay")
                ->with("breadcrumAction", "")
                ->with("row", $dataCollection)
                ->with("data", $data)
                ->with("config", $this->config);
    }

    /**
     * Create transaction
     */
    public function createTransaction(Request $request)
    {
        // Return url
            $return_url = \Request::root().'/payment-return';

        // Data transactions
            $req = $request->except('_token');

        //$transaction = new Transaction();
            //WebpayPlus::configureForTesting();
            //WebpayPlus::configureForProduction(597042518866, '6ac748603c86beff59944d25d3d906c5');
            //$transaction = new Transaction();
            //$resp = $transaction->create($req["buy_order"], $req["session_id"], $req["amount"], $return_url);
            $resp = (new Transaction)->create($req["buy_order"], $req["session_id"], $req["amount"], $return_url);

        // Return view
            return view($this->config["routeView"] . "send-pay")
                ->with("breadcrumAction", "")
                ->with("resp", $resp)
                ->with("contract", $req['contract'])
                ->with("config", $this->config);
    }
    public function update(Request $request, Collection $collection){

        $collection->status = $request->state;
        $collection->save();
        return $collection;
    }
    public function returnUrl(Request $request)
    {
        $token = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;

        if (!$token) {
            // Redirect to dashboard
                Toastr::error("", "¡Pago rechazado por Webpay!");
                return redirect('dashboard');
        }
        else {
            $resp = (new Transaction)->commit($token);

            // Register payment and validate quote
                if ($resp->status === "AUTHORIZED") {
                    // Extract quote id
                        $quoteId = explode("-", $resp->sessionId);

                    // Search quote
                        $collection = Collection::find($quoteId[0]);
                        if (!is_null($collection)) {
                            // Register payment
                                Payment::create([
                                    'collection_id' => $quoteId[0],
                                    'amount' => number_format((int)$resp->amount, 0, '', '.'),
                                    'authorizationCode' => $resp->authorizationCode,
                                    'session_id' => $resp->sessionId,
                                    'buy_order' => $resp->buyOrder,
                                    'card_number' => $resp->cardNumber,
                                    'transaction_date' => $resp->transactionDate
                                ]);

                            // Update quote status
                                $collection->update(['status' => "PAGADA"]);

                            // Return response
                                Toastr::success("", "¡Pago Procesado!");
                                return redirect('dashboard');
                        }
                        else {
                            Toastr::error("", "¡Error al procesar el pago por Appboproc!");
                            return redirect('dashboard');
                        }
                }
                else {
                    Toastr::error("", "¡Error al procesar el pago por Appboproc!");
                    return redirect('dashboard');
                }
        }
    }
}
