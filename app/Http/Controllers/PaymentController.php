<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

// Model
use App\Models\Payment;
use App\Models\Collection;

// Helpers
use Brian2694\Toastr\Facades\Toastr;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
