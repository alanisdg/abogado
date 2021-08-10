<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

// Model
use App\Models\Payment;

class PaymentController extends Controller
{
    public function paymentReturn(Request $request)
    {
        dd($request->all());
    }
}
