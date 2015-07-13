<?php

class API {

	protected $request;
	protected $returnData = [];
	protected $token;

	public function __construct($req) {
		$this->request = $req;
		$this->handleRequest();
	}

	public function handleRequest() {

		if (isset($this->request['request'])) {
			$requestType = $this->request['request'];
		} else {
			$requestType = "";
			$this->addWarning("No request type was set.");
			return;
		}

		//if the user has given any parameters
		if (isset($this->request['parameters'])) {
			$requestParameters = $this->request['parameters'];

		} else {
			$requestParameters = "";
			$this->addWarning("No request parameters were set.");
			return;
		}

		//we handle the user's request based on the type. (explained in api.php)
		switch ($requestType) {
			case 'LOGIN':
				$this->handleLOGIN($requestParameters);
				break;

			case 'LOGOUT':
				$this->handleLOGOUT($requestParameters);
				break;

			case 'TRANSFER':
				$this->handleTRANSFER($requestParameters);
				break;

			case 'BALANCE':
				$this->handleBALANCE($requestParameters);
				break;

			case 'TRANSACTIONS':
				$this->handleTRANSACTIONS($requestParameters);
				break;

			case 'NEWADDRESS':
				$this->handleNEWADDRESS($requestParameters);
				break;

			default:
				break;
		}

	}


	public function handleLOGIN($params) {
		global $dbConn;
		$username = $params['username'];
		$password = $params['password'];

		$username = $dbConn->real_escape_string($username);
		$password = $dbConn->real_escape_string($password);

		/*
		 * We need to get the user's salt based on his username in order to
		 * continue with his password authentication.
		 */
		$result = $dbConn->query("SELECT * FROM `accounts` WHERE `username`='$username';");
		$salt = "";
		$storedHash = "";

		/* We get the salt and the stored hash. */
		if ($result) {

			/* We ensure that the username exists. */
			if ($result->num_rows > 0) {
				$row = $result->fetch_array();
				$salt = $row["salt"];
				$storedHash = $row["password"];

				$hashedPassword = hash("sha256", $salt . $password . $salt);

				if ($hashedPassword != $storedHash) {
					$this->addError("Invalid credentials");
					return;
				}

			} else {
				$this->addError("Invalid credentials");
				return;
			}
		}

		//Generate new token.

		$tokenGen = new TokenGenerator($username);
		$token = $tokenGen->getToken();

		if (!TokenGenerator::checkExpired($token)) {

			//if token has not expired set the variable to the token, and return it to the user.

			$this->returnData["token"] = $token;
			$this->token = $token;
		} else {
			//if the token has expired show a friendly message to the user and log him out.

			$this->addError("Your token has expired or does not exist, please login again.");
			$this->handleLOGOUT(["token" => $token]);
		}
	}


	public function handleLOGOUT($params) {

		global $dbConn;

		$token = $params["token"];
		$result = $dbConn->query("DELETE FROM tokens WHERE `token`='$token'");

	}

	public function handleBALANCE($params) {
		
		$suppliedToken = $params["token"];

		if (TokenGenerator::checkExpired($suppliedToken)) {
			$this->addError("Your token has expired or does not exist, please login again.");
			$this->handleLOGOUT(["token" => $suppliedToken]);
		}

		global $dbConn;
		global $bitcoin;

		echo TokenGenerator::getUsernameFromToken($suppliedToken);
		return $bitcoin->getbalance(TokenGenerator::getUsernameFromToken($suppliedToken));
	}


	public function handleTRANSACTIONS($params) {
		
	}


	public function getReturnedData() {
		return json_encode($this->returnData);
	}

	public function addError($error) {
		$this->returnData['errors'][] = $error;
	}

	public function addWarning($warning) {
		$this->returnData['warnings'][] = $warning;
	}

}