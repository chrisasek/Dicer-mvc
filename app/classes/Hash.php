<?php

namespace App\Classes;

class Hash
{
	public static function password($password, $hashed = null)
	{
		return $hashed ? password_verify($password, $hashed) : password_hash($password, PASSWORD_DEFAULT);
	}

	public static function make($input, $key = '', $is_v2 = true)
	{
		return hash('sha256', $input . $key);
		// return $is_v2 ? hash_hmac('sha512', $input, $key) : hash('sha256', $input . $key);
	}

	// random
	public static function RandomToken($length = 32)
	{
		if (!isset($length) || intval($length) <= 8) {
			$length = 32;
		}
		if (function_exists('random_bytes')) {
			return bin2hex(random_bytes($length));
		}
		if (function_exists('openssl_random_pseudo_bytes')) {
			return bin2hex(openssl_random_pseudo_bytes($length));
		}
	}

	// cancel out
	public static function salt($length)
	{
		return substr(strtr(base64_encode(hex2bin(self::RandomToken($length))), '+', '.'), 0, 44);
	}

	// cancel
	public static function unique()
	{
		return self::make(uniqid());
	}
}
