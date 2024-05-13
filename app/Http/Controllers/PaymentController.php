<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PaymobServices;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $PaymobServices;
    public function __construct(PaymobServices $PaymobServices)
    {
        $this->PaymobServices = $PaymobServices;
    }

    public function pay(Request $request)
    {
        return $this->PaymobServices->initiatePayment($request);
    }

    public function data($request): array
    {
        $data = $request->except("_token");
        return $data;
    }
}
