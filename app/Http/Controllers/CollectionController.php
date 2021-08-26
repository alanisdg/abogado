<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Collection;
use App\Models\Contract;
use App\Models\Customer;
use App\Models\Payment;

// Helpers
use Transbank\Webpay\WebpayPlus\Transaction;
use Transbank\Webpay\WebpayPlus;
use Brian2694\Toastr\Facades\Toastr;
use DataTables;

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

    public function __construct(){
        $this->middleware('auth');

        //if (app()->environment('production')) {
            WebpayPlus::configureForProduction(config('services.transbank.webpay_plus_cc'), config('services.transbank.webpay_plus_api_key'));
        //} else {
            WebpayPlus::configureForTesting();
        //}
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
            $resp = (new Transaction)->create($req["buy_order"], $req["session_id"], $req["amount"], $return_url);

        // Return view
            return view($this->config["routeView"] . "send-pay")
                ->with("breadcrumAction", "")
                ->with("resp", $resp)
                ->with("contract", $req['contract'])
                ->with("config", $this->config);
    }
}
