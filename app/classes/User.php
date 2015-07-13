<?php

class User {

	public static function getUsername() {
		return $_SESSION['user']['username'];
	}

	/**
	 * User login is based on username so we need to set it first.
	 * After that we can use it to fetch data associated with the user.
	 * 
	 * @var $username The username we got from the login form.
	 */

	public static function logInUser($username) {
		$_SESSION['user']['username'] = $username;
		$_SESSION['user']['id'] = self::getUserId();
		$_SESSION['user']['lastIP'] = self::getLastIP();
		$_SESSION['user']['lastLogin'] = self::getLastLogin();

		self::updateLoginData();
	}

	public static function isLoggedIn() {
		if (isset($_SESSION['user']['username']) && !empty($_SESSION['user']['username'])) {
			return true;
		}
		return false;
	}

	public static function logOutUser() {
		$_SESSION['user']['username'] = "";
		unset($_SESSION);
		session_destroy();
		Redirect::phpRedirect("start");
	}

	public static function getRemoteIP() {
		$ipaddress = '';
		if ($_SERVER['HTTP_CLIENT_IP'])
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if($_SERVER['HTTP_X_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if($_SERVER['HTTP_FORWARDED_FOR'])
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if($_SERVER['HTTP_FORWARDED'])
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if($_SERVER['REMOTE_ADDR'])
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public static function getLastIP() {
		global $dbConn;
		$username = self::getUsername();
		$result = $dbConn->query("SELECT last_ip FROM `accounts` WHERE `username`='$username';");
		if ($result) {
			$row = $result->fetch_array();
			return $row[0];
		}
	}

	public static function getLastLogin() {
		global $dbConn;
		$username = self::getUsername();
		$result = $dbConn->query("SELECT last_login FROM `accounts` WHERE `username`='$username';");
		if ($result) {
			$row = $result->fetch_array();
			return date('F j Y, G:i:s',strtotime($row[0]));
		}
	}

	public static function getUserId($username = "") {
		global $dbConn;
		if ($username == "") {
			$username = self::getUsername();
		}
		$result = $dbConn->query("SELECT id FROM `accounts` WHERE `username`='$username';");
		if ($result) {
			$row = $result->fetch_array();
			return $row[0];
		}
		return;
	}

	public static function updateLoginData() {
		global $dbConn;

		/* We first need to get the User's IP address and set his username. */
		$remoteIP = self::getRemoteIP();
		$username = self::getUsername();

		/* Then we update his login information with the new data. */
		$result = $dbConn->query("UPDATE `accounts` SET `last_login` = NOW(), `last_ip` = '$remoteIP' WHERE `username` = '$username';");

		if (!$result) {
			new Message(1);
		}


	}

}