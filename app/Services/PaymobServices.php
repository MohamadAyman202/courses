<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymobServices
{
    protected $client;
    protected $baseUrl;
    protected $apiKey;


    public function __construct()
    {
        $this->baseUrl = env('PAYMOB_BASE URL');
        $this->apiKey = env('PAYMOB_API_KEY');
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);
    }

    public function initiatePayment($request)
    {
        $response = $this->client->post($this->baseUrl . 'v1/intention/', [
            'json' => [
                'amount_cents' => 100,
                'currency' => 'EGP',
                'order_id' => '1',
                'billing_data' => [
                    // Billing information
                ],
                'shipping_data' => [
                    // Shipping information
                ],
                'integration_id' => '1',
                'lock_order_when_paid' => true,
            ],
        ]);


        $body = json_decode($response->getBody()->getContents(), true);

        // Redirect the user to PayMob payment URL
        return redirect($body['redirect_url']);
    }

    public function handleCallback(Request $request)
    {
        // Handle PayMob callback here
    }
}
