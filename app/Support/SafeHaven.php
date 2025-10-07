<?php

namespace App\Support;

use App\Support\Req;
use App\Models\Api;
use App\Support\Template;
use App\Models\User;

class SafeHaven
{


    public static function home()
    {
        $user = User::data();
        return Template::renderer('home', 'user/transaction', ['user' => $user]);
    }

    // Authentication
    public static function token($grant_type = 'authorization_code')
    {
        $api = Api::where('uid', 'SAFEHAVEN')->first();
        if (!$api) {
            Req::response(402, 'API details not found!');
        }

        $api_data = json_decode($api->data);

        $data  = array(
            'grant_type' => $grant_type,
            'code' => '1993',
            'client_id' => $api_data->client_id,
            'client_assertion' => $api_data->client_assertion,
            'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
            'refresh_token' => $api_data->refresh_token,
        );


        return Req::post($data, SAFEHAVEN_API_BASE . '/oauth2/token', false);
    }

    // Accounts
    public static function create_account($grant_type = 'authorization_code')
    {
        $api = Api::where('uid', 'SAFEHAVEN')->first();
        if (!$api) {
            Req::response(402, 'API details not found!');
        }

        $api_data = json_decode($api->data);

        $data  = array(
            'grant_type' => $grant_type,
            'code' => '1993',
            'client_id' => $api_data->client_id,
            'client_assertion' => $api_data->client_assertion,
            'client_assertion_type' => 'urn:ietf:params:oauth:client-assertion-type:jwt-bearer',
            'refresh_token' => $api_data->refresh_token,
        );


        return Req::post($data, SAFEHAVEN_API_BASE . '/oauth2/token', false);
    }
}
