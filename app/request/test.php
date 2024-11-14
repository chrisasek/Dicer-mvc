<?php

use App\Classes\Req;
use GuzzleHttp\Client;
use Models\Business;
use Models\User;

require_once('../../config/init.php');

// /home/smspadic/websites/tsara.ng/dashboard/app/request/test.php


// print_r(User::selected_business());
$Business = User::selected_business();
$api = json_decode($Business->api);


$token = $api->live->public_key;



// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://api.tsara.ng/v1/accounts',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => array('accountType' => 'Savings','suffix' => '','metadata' => '','account_type' => 'main'),
//   CURLOPT_HTTPHEADER => array(
//     'Authorization: Bearer '.$token,
//     'Cookie: PHPSESSID=15v1o6b24j9vhikq7nvospo4f5'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);

// print_r($response);
// die;


// $res = Req::post(array(
//     "accountType" => 'Savings',
//     "suffix" => $business->name,
//     "account_type" => 'main',
//     "metadata" => json_encode(array(
//         'tsara_user_id' => $business->user_id,
//         'tsara_business_id' => $business->id,
//     )),
// ), API_URL . '/v1/accounts', $api->live->public_key);

// print_r($res);
// die;

// $res = Req::post(array(
//     "accountType" => 'savings',
//     "suffix" => $Business->name,
//     "account_type" => 'main',
//     "metadata" => json_encode(array(
//         'tsara_user_id' => $Business->user_id,
//         'tsara_business_id' => $Business->id,
//     )),
// ), API_URL . '/v1/accounts', $api->live->public_key);

print_r($api->live->public_key);
$res = Req::get(API_URL . '/v1/accounts', $api->live->public_key);

print_r($res);
die;

$Client = new Client(['base_uri' => API_URL]);

$response = $Client->get('customers');
// print_r($response);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/website/tsara.com/api/customers',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('email' => 'chrisasek@gmail.com', 'phone_number' => '08093930950', 'first_name' => 'Tsara-', 'last_name' => 'Business', 'bvn' => ''),
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer 7n7om8efo8t3006uqysokkc5y6ojpbb2',
    ),
));
$response = curl_exec($curl);
curl_close($curl);

print_r($response);
