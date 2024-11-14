<?php

namespace App\Classes;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class UzoBestNg
{
    private $base_url;

    function __construct()
    {
        $this->base_url = 'https://uzobestgsm.ng/api/v1';
    }

    // --- Data
    public function getDataPlan()
    {
        $client = new Client();
        $request = new Request('GET', "{$this->base_url}/dataplans");
        $res = $client->sendAsync($request)->wait();

        return $res->getBody();
    }

    // Buy Data
    public function buyData()
    {
        $client = new Client();
        $body = '{
            "network_id":1,
            "phone_number":"09165380483",
            "plan_id":1,
            "ported":true
        }';

        $request = new Request('POST', "{$this->base_url}/purchase_data", [], $body);
        $res = $client->sendAsync($request)->wait();

        return $res->getBody();
    }
}
