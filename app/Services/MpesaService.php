<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MpesaService
{
    protected $client;
    protected $base_url;
    protected $consumer_key;
    protected $consumer_secret;
    protected $shortcode;
    protected $passkey;
    protected $callback_url;

    public function __construct()
    {
        $this->client = new Client();
        $this->base_url = env('MPESA_BASE_URL', 'https://api.safaricom.co.ke');
        $this->consumer_key = env('MPESA_CONSUMER_KEY');
        $this->consumer_secret = env('MPESA_CONSUMER_SECRET');
        $this->shortcode = env('MPESA_SHORTCODE');
        $this->passkey = env('MPESA_PASSKEY');
        $this->callback_url = env('MPESA_CALLBACK_URL');
    }

    public function getAccessToken()
    {
        try {
            $response = $this->client->request('GET', $this->base_url . '/oauth/v1/generate?grant_type=client_credentials', [
                'auth' => [$this->consumer_key, $this->consumer_secret]
            ]);

            $body = json_decode($response->getBody(), true);
            return $body['access_token'];
        } catch (RequestException $e) {
            // Handle errors (e.g., log them, rethrow, etc.)
            return null;
        }
    }

    public function initiateStkPush($amount, $phone, $reference, $description)
    {
        $access_token = $this->getAccessToken();
        if (!$access_token) {
            return ['error' => 'Unable to obtain access token'];
        }

        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        try {
            $response = $this->client->request('POST', $this->base_url . '/mpesa/stkpush/v1/processrequest', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $access_token,
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'BusinessShortCode' => $this->shortcode,
                    'Password' => $password,
                    'Timestamp' => $timestamp,
                    'TransactionType' => 'CustomerPayBillOnline',
                    'Amount' => $amount,
                    'PartyA' => $phone,
                    'PartyB' => $this->shortcode,
                    'PhoneNumber' => $phone,
                    'CallBackURL' => $this->callback_url,
                    'AccountReference' => $reference,
                    'TransactionDesc' => $description
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Handle errors (e.g., log them, rethrow, etc.)
            return [
                'error' => $e->getMessage(),
                'response' => $e->hasResponse() ? json_decode($e->getResponse()->getBody()->getContents(), true) : null
            ];
        }
    }
}
