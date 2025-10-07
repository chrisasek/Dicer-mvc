<?php

namespace App\Support;

class Alerts
{

	public static function notification()
	{
		if (Session::exists('notification')) {
			$notification = Session::get('notification'); // array('message', 'type');
			Session::delete('notification');
			Component::render('notification', $notification);
		}
	}

	public static function topNotification($message = null)
	{
		if ($message) {
			echo $message;
		}
		return null;
	}

	public static function displayNotification($notification = null)
	{
		if ($notification && is_array($notification) || is_object($notification) && $notification->message) {
			Component::render('notification', $notification);
		}
	}

	public static function notificationPopUp($message = null, $title = null)
	{
		if (Session::exists('notification-popup')) {
			$notification = Session::get('notification-popup');
			if (is_array($notification) || is_object($notification)) {
				$message = $notification['message'];
				$title = $notification['title'];
			} else {
				$message = $notification;
				$title = "Read!";
			}

			// $notification = Session::flash('notification-popup');
			$type = 'info';
			$s = "<script> popUpNotification('{$message}', '{$title}', '{$type}'); </script>";

			Session::delete('notification-popup');
			echo $s;
		}
		return null;
	}

	public static function displayError()
	{
		$s = '';
		if (Session::exists('error') && Session::get('error')) {
			$value = '' . Session::flash('error');
			$type = 'error';
			$s = "<script> alertToast('{$value}', '{$type}'); </script>";
		}
		//$s = "<script> alertToast('".Session::get('success')."'); </script>";
		echo $s;
	}

	public static function displayErrorModal()
	{
		// print General error Messages on modal
		$err = '';
		if (Session::exists('error-modal')) {
			$value = '' . Session::flash('error-modal');
			$type = 'error';
			$err = "<script> alertToast('{$value}', '{$type}'); </script>";
		}
		echo $err;
	}
	// print success messages
	public static function displaySuccess()
	{
		$s = '';
		if (Session::exists('success') && Session::get('success')) {
			$value = '' . Session::flash('success');
			$type = 'success';
			$s = "<script> alertToast('{$value}', '{$type}'); </script>";
		}
		//$s = "<script> alertToast('".Session::get('success')."'); </script>";
		echo $s;
	}
	public static function displaySuccessModal()
	{
		// print General error Messages on modal
		$err = '';
		if (Session::exists('success-modal')) {
			$value = '' . Session::flash('success-modal');
			$type = 'error';
			$err = "<script> alertToast('{$value}', '{$type}'); </script>";
		}
		echo $err;
	}

	public static function display()
	{
		// print General error Messages on modal

		if (Session::exists('error') && Session::get('error')) {
			$value = '' . Session::flash('error');
			$type = 'error';
			echo "<script> alertToast('{$value}', '{$type}'); </script>";
		} else if (Session::exists('success') && Session::get('success')) {
			$value = '' . Session::flash('success');
			$type = 'success';
			echo "<script> alertToast('{$value}', '{$type}'); </script>";
		}
	}
}
