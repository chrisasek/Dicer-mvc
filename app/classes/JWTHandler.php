<?php

namespace App\Classes;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use UnexpectedValueException;

class JWTHandler
{
    public static function encodeToken($data)
    {
        $token = array(
            'iss' => APP_URL,
            'iat' => time(),
            'exp' => time() + (86400 * 7), // 1 day * 7 = 7 days
            'data' => $data
        );
        return JWT::encode($token, JWT_SECRET_TOKEN, 'HS256');
    }

    public static function decodeToken($token)
    {
        try {
            $decode = JWT::decode($token, new Key(JWT_SECRET_TOKEN, 'HS256'));
            return $decode->data;
        } catch (ExpiredException | SignatureInvalidException $e) {
            Req::sendJson(400, $e->getMessage());
        } catch (UnexpectedValueException | Exception $e) {
            Req::sendJson(400, $e->getMessage());
        }
    }
}
