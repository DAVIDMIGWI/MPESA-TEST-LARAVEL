<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MpesaService;

class MpesaController extends Controller
{
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    public function initiateStkPush(Request $request)
    {
        $amount = $request->input('amount');
        $phone = $request->input('phone');
        $reference = $request->input('reference');
        $description = $request->input('description');

        $response = $this->mpesaService->initiateStkPush($amount, $phone, $reference, $description);

        return response()->json($response);
    }

    public function callback(Request $request)
    {
        // Handle the callback from Safaricom
        \Log::info('M-Pesa Callback:', $request->all());

        return response()->json(['status' => 'success']);
    }
}
