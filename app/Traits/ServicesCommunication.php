<?php

namespace App\Traits;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Http\JsonResponse;

trait ServicesCommunication
{

    use ResponseTrait;

    public function postRequest(string $url, array $data, $headerParameters = []): Stream
    {

        $client = new Client(['verify' => false]);
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $headers = array_merge($headers, $headerParameters);

        $body = json_encode($data);

        $request = new Request('POST', $url, $headers, $body);
        $res = $client->sendAsync($request)->wait();

        return $res->getBody();
    }

}
