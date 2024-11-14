<?php

namespace App\Classes;

use Curl\Curl;
use Symfony\Component\HttpFoundation\JsonResponse;

class Req
{

    public static function read()
    {
        return json_decode(file_get_contents("php://input"));
    }

    public static function  response(int $code, string $message, array $extra = [])
    {
        $status = $code == 200 ? 'success' : 'failed';
        $response = ['status' => $status, 'status_code' => $code];
        if ($message) $response['message'] = $message;

        http_response_code($code);
        $json = json_encode(array_merge($response, $extra));

        $response = JsonResponse::fromJsonString($json);
        $response->send();
        exit;
    }

    public static function user($user)
    {
        if ($user) {
            unset($user->salt);
            unset($user->password);
        }

        return $user;
    }

    public static function createAuthorization($token)
    {
        return JWTHandler::encodeToken($token);
    }

    public static function authorization($get_token = false)
    {
        $token = null;
        $headers = array_change_key_case(getallheaders());
        if (isset($headers['authorization'])) {
            $authorizationHeader = $headers['authorization'];
            $matches = array();
            if (preg_match('/Bearer (.+)/', $authorizationHeader, $matches)) {
                if (isset($matches[1])) {
                    $token = $matches[1];
                }
            }
        }


        $authorization_token = $token && $get_token ? $token : ($token ? JWTHandler::decodeToken($token) : null);
        if (!$authorization_token) {
            self::response(
                401,
                'Invalid authorization token',
                ['message' => 'Invalid authorization token',]
            );
        }

        return $authorization_token;
    }



    // CURL
    // ~ POST
    static function post($body, $endpoint, $token = null)
    {
        $curl = new Curl();
        if ($token) {
            $curl->setHeader('authorization', "Bearer $token");
        }

        $curl->post($endpoint, $body);
        return (object) $curl->response;

        $headers[] = "accept: application/json";
        $headers[] = "content-type: application/json";
        if ($token) {
            $headers[] = "authorization: Bearer $token";
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            $response = json_decode($response);
            return $response;
        }
    }

    // ~ PUT
    static function put($body, $endpoint, $token)
    {
        $headers[0] = "accept: application/json";
        $headers[1] = "content-type: application/json";
        if ($token) {
            $headers[2] = "authorization: Bearer $token";
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            $response = json_decode($response);
            return $response;
        }
    }

    // ~ DELETE
    static function delete($body, $endpoint, $token)
    {
        $headers[0] = "accept: application/json";
        $headers[1] = "content-type: application/json";
        if ($token) {
            $headers[2] = "authorization: Bearer $token";
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            $response = json_decode($response);
            return $response;
        }
    }

    // ~ GET
    static function  get($endpoint, $token = false)
    {
        $curl = new Curl();
        if ($token) {
            $curl->setHeader('authorization', "Bearer $token");
        }

        $curl->get($endpoint);
        return (object) $curl->response;

        $headers[0] = "accept: application/json";
        $headers[1] = "content-type: application/json";
        if ($token) {
            $headers[2] = "authorization: Bearer $token";
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            $response = json_decode($response);
            return $response;
        }
    }
}
