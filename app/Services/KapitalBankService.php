<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KapitalBankService
{
    protected string $baseUrl;
    protected string $username;
    protected string $password;

    public function __construct()
    {
        $this->baseUrl = env('KAPITAL_BANK_BASE_URL', 'https://e-commerce.kapitalbank.az/api');
        $this->username = env('KAPITAL_BANK_USERNAME');
        $this->password = env('KAPITAL_BANK_PASSWORD');
    }

    public function request(string $method, string $uri, array $data = [])
    {
        $url = rtrim($this->baseUrl, '/') . '/' . ltrim($uri, '/');
        $response = Http::withBasicAuth($this->username, $this->password)
                    ->acceptJson()
            ->$method($url, $data);
        return $response;
    }

    public function createOrder($amount, $orderId)
    {
        $order = [
            'typeRid' => "ORDER_SMS",
            'amount' => $amount,
            'currency' => "AZN",
            'language' => "en",
            'title' => "Order #{$orderId}",
            "description" => "GNL Couture",
            "hppRedirectUrl" => url("/api/callback?orderId={$orderId}")
        ];

        return $this->request('post', 'order', ['order' => $order]);
    }

    public function getOrderDetails($txpgId)
    {
        $uri = "order/{$txpgId}";
        return $this->request('get', $uri);
    }

    public function refundOrder($txpgId, $amount)
    {
        $uri = "order/{$txpgId}/exec-tran";

        $data = [
            'tran' => [
                'phase' => 'Single',
                'amount' => $amount,
                'type' => 'Refund'
            ]
        ];

        return $this->request('post', $uri, $data);
    }
}
