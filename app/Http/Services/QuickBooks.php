<?php

namespace App\Http\Services;

use App\Traits\ServicesCommunication;
use http\Encoding\Stream;

class QuickBooks
{

    use ServicesCommunication;

    private string $accessToken;
    private string $baseUrl;

    public function __construct()
    {
        $this->accessToken = env("QB_ACCESS_TOKEN");
        $this->baseUrl = 'https://sandbox-quickbooks.api.intuit.com/v3/';
    }

    /**
     * @param array $data
     * @return \GuzzleHttp\Psr7\Stream
     */
    public function expense(array $data = []): \GuzzleHttp\Psr7\Stream
    {

        $url = $this->baseUrl . 'company/4620816365299047290/purchase';

        $data = [
            'AccountRef' => [
                'value' => '41',
                'name' => 'Mastercard',
            ],
            'PaymentType' => 'CreditCard',
            'Line' => [
                [
                    'Amount' => $data['amount'],
                    'DetailType' => 'AccountBasedExpenseLineDetail',
                    'AccountBasedExpenseLineDetail' => [
                        'AccountRef' => [
                            'value' => '41',
                        ],
                    ],
                ],
            ],
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $this->accessToken
        ];

        return $this->postRequest($url, $data, $headers);
    }
}
