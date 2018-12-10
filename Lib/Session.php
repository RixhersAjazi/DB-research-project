<?php

class Session {

	public function __construct()
	{
		session_start();
	}

	public static function isLoggedIn()
	{
		if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
			return true;
		}

		return false;
	}

	public static function login()
	{
		$_SESSION['loggedIn'] = true;
	}

	public static function logout()
	{
		$_SESSION['loggedIn'] = false;
	}
}