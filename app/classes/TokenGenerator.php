<?php

class TokenGenerator {

	protected $token;
	protected $expiration;

	public function __construct($username) {
		global $dbConn;
		$this->token = md5($username . strtotime("now"));
		$this->expiration = strtotime('+10 minutes');
		$userId = User::getUserId($username);

		//insert user in database as active if he is not already present.
		$result = $dbConn->query("SELECT * FROM tokens WHERE `account_id`='$userId'");

		//if user is not present we must create his token.
		if ($result->num_rows == 0) {
			$dateTimeFormat = date('Y-m-d H:i:s', $this->expiration);
			$tokenCreated = $dbConn->query("INSERT INTO `tokens` VALUES ('$userId', '$this->token', '$dateTimeFormat')");

		} else {
			//a token already exists retrieve the current token.

			$existingToken = $dbConn->query("SELECT token FROM tokens WHERE `account_id`='$userId'");
			$tokenData = $existingToken->fetch_array();
			$this->token = $tokenData["token"];

		}
	}

	public function getToken() {
		return $this->token;
	}

	public static function checkExpired($token) {

		global $dbConn;

		$currentTimestamp = strtotime("now");
		$curDateTime = date('Y-m-d H:i:s', $currentTimestamp);

		$expirationDT = $dbConn->query("SELECT expiration FROM tokens WHERE `token`='$token'");

		$dt = $expirationDT->fetch_array();
		$expTimestamp = $dt["expiration"];

		return ($curDateTime > $expTimestamp);
	}

	public static function getUsernameFromToken($token) {
		global $dbConn;
		$getUserQuery = $dbConn->query("SELECT accounts.username FROM tokens, accounts WHERE tokens.token = '$token' AND accounts.id = tokens.account_id;");
		$userdata = $getUserQuery->fetch_array();
		return $userdata["username"];
	}
}