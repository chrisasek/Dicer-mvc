<?php

namespace App\Classes;

class Input
{
	public static function exists($type = 'post')
	{
		switch ($type) {
			case 'post':
				return (!empty($_POST)) ? TRUE : FALSE;
				break;
			case 'get':
				return (!empty($_GET)) ? TRUE : FALSE;
				break;
			default:
				return false;
				break;
		}
	}

	public static function active($check, $route = 'page', $add_class = null)
	{
		if (isset($_POST[$route])) {
			return $_POST[$route] == $check ? 'active ' . $add_class : false;
		} else if (isset($_GET[$route])) {
			return $_GET[$route] == $check ? 'active ' . $add_class : false;
		}
		return false;
	}

	public static function is($check, $route = 'page', $return = null, $post = false)
	{
		if (isset($_POST[$route])) {
			return $_POST[$route] == $check ? ($return ? $return : $_POST[$route]) : false;
		} else if (isset($_GET[$route])) {
			return !$post && $_GET[$route] == $check ?  ($return ? $return : $_GET[$route]) : false;
		}
		return false;
	}

	public static function get($item, $default = null, $trim = false)
	{
		if (isset($_POST[$item])) {
			return $trim ? Helpers::escape($_POST[$item]) : $_POST[$item];
		} else if (isset($_GET[$item])) {
			return  $trim ? Helpers::escape($_GET[$item]) : $_GET[$item];
		}
		return $default;
	}
}
