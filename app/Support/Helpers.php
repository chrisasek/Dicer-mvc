<?php

namespace App\Support;

use DateTime;

class Helpers
{
	public static function find_file($dir, $search)
	{
		$files = scandir($dir);
		$result = null;
		foreach ($files as $file) {
			if ($file === '.' || $file === '..') {
				continue;
			}

			print_r($file);
			if (strpos($search, $file) !== false) {
				return "$dir/$file";
			}
		}
		return $result;
	}

	public static function find_all_files($dir)
	{
		$root = scandir($dir, 1);
		foreach ($root as $value) {

			if ($value === '.' || $value === '..') {
				continue;
			}
			if (is_file("$dir/$value")) {
				$result[] = "$dir/$value";
				continue;
			}
			foreach (self::find_all_files("$dir/$value") as $value) {
				$result[] = $value;
			}
		}
		return $result;
	}

	public static function slugify($text, string $divider = '-')
	{
		// replace non letter or digits by divider
		$text = preg_replace('~[^\pL\d]+~u', $divider, $text);
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		// trim
		$text = trim($text, $divider);
		// remove duplicate divider
		$text = preg_replace('~-+~', $divider, $text);
		// lowercase
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}
		return $text;
	}

	public static function quote_array($current_array)
	{
		$new_array = array();
		$new_array  = array_map(function ($rec) {
			//concatenate record with "" 
			$result = $rec = '"' . $rec . '"';
			return $result;
		}, $current_array);

		return $new_array;
	}

	public static function format_currency($amount, $code = "NGN", $is_short = false)
	{
		switch ($code) {
			case "NGN":
				$data = '₦' . ($is_short ? self::number_format_short($amount) : number_format($amount));
				break;
		}

		return $data;
	}

	public static function number_format_short($n, $precision = 1, $with_suffix = true, $suffix_only = false)
	{
		$n = is_object($n) || is_array($n) ? count($n) : $n;

		if ($n < 900) {
			// 0 - 900
			$n_format = number_format($n, $precision);
			$suffix = '';
		} else if ($n < 900000) {
			// 0.9k-850k
			$n_format = number_format($n / 1000, $precision);
			$suffix = 'K';
		} else if ($n < 900000000) {
			// 0.9m-850m
			$n_format = number_format($n / 1000000, $precision);
			$suffix = 'M';
		} else if ($n < 900000000000) {
			// 0.9b-850b
			$n_format = number_format($n / 1000000000, $precision);
			$suffix = 'B';
		} else {
			// 0.9t+
			$n_format = number_format($n / 1000000000000, $precision);
			$suffix = 'T';
		}

		// Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
		// Intentionally does not affect partials, eg "1.50" -> "1.50"
		if ($precision > 0) {
			$dotzero = '.' . str_repeat('0', $precision);
			$n_format = str_replace($dotzero, '', $n_format);
		}

		return $with_suffix ? $n_format . $suffix : ($suffix_only ? $suffix : $n_format);
	}

	public static function stripnl2br($string, $hasbr = true)
	{
		$string = $hasbr ? $string : nl2br($string);
		return str_replace("<br />", '', $string);
	}

	public static function escape($string)
	{
		$string = trim($string);
		$string = stripslashes($string);
		$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
		return $string;
	}

	public static function strip_zeros_from_date($marked_string = "")
	{
		// first remove the marked zeros
		$no_zeros = str_replace('*0', '', $marked_string);
		// then remove any remaining marks
		$cleaned_string = str_replace('*', '', $no_zeros);
		return $cleaned_string;
	}
	public static function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	public static function getRandom()
	{
		mt_srand((float) microtime() * 1000000);
		$rnd = mt_rand(100, 999);
		return $rnd;
	}

	public static function getStateDigits($digit)
	{
		$dig = null;
		switch (strlen($digit)) {
			case 1:
				$dig = '000' . $digit;
				break;
			case 2:
				$dig = '00' . $digit;
				break;
			case 3:
				$dig = '0' . $digit;
				break;
			case 4:
				$dig = $digit;
				break;
			case (strlen($digit) > 4):
				$dig = substr($digit, 0, 4);
				break;
		}
		return $dig;
	}

	public static function validateDate($date)
	{
		$d = DateTime::createFromFormat('Y-m-d', $date);
		return $d->format('Y-m-d');
	}
	// Return certain number of words from a given string.
	public static function return_words($text, $length)
	{
		if (strlen($text) > $length) {
			$text = substr($text, 0, strpos($text . ' ', ' ', $length)) . "...";
		}
		return $text;
	}

	public static function isXHR()
	{
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']);
	}


	// generating unique keys for  sessions and token
	public static function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}

	public static function getUnique($length, $type = 'ad')
	{ // d - digit, a - alphabet, ad -both
		$token = "";
		$codeAlphabet = "";
		switch ($type) {
			case 'Aad':
				$codeAlphabet .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
				$codeAlphabet .= "0123456789";
				break;
			case 'ad':
				$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
				$codeAlphabet .= "0123456789";
				break;
			case 'Aa':
				$codeAlphabet .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
				break;
			case 'aA':
				$codeAlphabet .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
				break;
			case 'A':
				$codeAlphabet .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;
			case 'a':
				$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
				break;
			case 'd':
				$codeAlphabet .= "0123456789";
				break;
		}

		$max = strlen($codeAlphabet); // edited

		for ($i = 0; $i < $length; $i++) {
			$token .= $codeAlphabet[self::crypto_rand_secure(0, $max - 1)];
		}

		return $token;
	}
	// utb
	public static function isYouTube($url)
	{
		$rx = '~^(?:https?://)?(?:www\.)?(?:youtube\.com|youtu\.be)/watch\?v=([^&]+)~x';
		return preg_match($rx, $url, $matches);
	}
	// time function	
	public static function moment()
	{
		$dt = time();
		$mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);
		$newDateTime = date('d-M-Y h:i A', strtotime($mysql_datetime));
		return $newDateTime;
	}
	// remove extension
	public static function removeExtension($name)
	{
		return substr($name, 0, strrpos($name, "."));
	}

	// remove extension
	// filename = the file path to the file to deleteFile
	// return boolean whether file has been removed or not.
	public static function deleteFile($filename)
	{
		//try to force symlinks
		if (is_link($filename)) {
			$sym = @readlink($filename);
			if ($sym) {
				return is_writable($filename) && @unlink($filename);
			}
		}

		//try to use realpath
		if (realpath($filename) && realpath($filename !== $filename)) {
			return is_writable($filename) && @unlink(realpath($filename));
		}

		// default unlink
		return is_writable($filename) && @unlink($filename);
	}

	public static function upload_file($fn, $path = "../../media/category/", $ppath = "../../media/category/resized/")
	{
		$validate = new Validate();
		foreach ($_FILES['file']['name'] as $index => $files) {
			$temp = explode(".", $_FILES["file"]["name"][$index]);
			$fname = $fn;
			$newfilename = $fname . '.' . end($temp);
			// check path
			$path = (file_exists($path) && is_writeable($path)) ? $path : (mkdir($path, 0777, true) ? $path : "../../media/");
			// preview path
			$prevPath = (file_exists($ppath) && is_writeable($ppath)) ? $ppath : (mkdir($ppath, 0777, true) ? $ppath : "../../media/resized");
			// move and create preview
			if (move_uploaded_file($_FILES["file"]["tmp_name"][$index], $path . $newfilename) && $validate->imagePreviewSize($path . $newfilename, $prevPath, $fname, 250, 250)) {
				// && $validate->imagePreviewSize($path.$newfilename, $prevPath, $fname, 400, 400)
				$image = $newfilename;
			}
		}

		return $image;
	}

	public static function set_metas($smeta, $APP_NAME = "Oniontabs.com")
	{
		if ($smeta) {
			$image = $smeta['image'];
			$title = $smeta['title'];
			$description = $smeta['description'];
			$url = $smeta['url'];
			$alt = $smeta['alt'];
			$social_metas = `
			<meta property="og:title" content="{$title}">
			<meta property="og:description" content="{$description}">
			<meta property="og:image" content="{$image}">
			<meta property="og:url" content="{$url}">
			<meta property="og:type" content="article">
			<meta name="twitter:card" content="{$image}">
			<meta property="og:APP_NAME" content="{$APP_NAME}">
			<meta name="twitter:image:alt" content="{$alt}">
			`;

			return $social_metas;
		}
		return false;
	}
}
