<?php

namespace App\Classes;

class Token
{
	public static function generate($force = false)
	{
		$tokenName = Config::get('session/user_token');
		if ($force) {
			return Session::put($tokenName, md5(uniqid()));
		}
		return Session::exists($tokenName) ? Session::get($tokenName) : Session::put($tokenName, md5(uniqid()));
	}

	public static function check($token)
	{
		$tokenName = Config::get('session/user_token');
		if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
			Session::delete($tokenName);
			return true;
		}
	}
}
