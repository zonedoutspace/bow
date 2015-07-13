<?php

//======================================================================
// ACCOUNT CLASS (Account.php)
//======================================================================

//----------------------------------------------------------------------
//	This class contains all information needed in order to create new 
//  accounts, login, and manage accounts in general.
//----------------------------------------------------------------------

class Account {


	public static function login($username, $password) {
		/* We load the $dbConn variable as global to use it inside the function. */
		global $dbConn;

		/* 
		 * We first need to sanitize the variables we got in order to avoid
		 * SQL injection attacks from malicious users.
		 */
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
			} else {

				/* If the username does not exist we display a general
				 * error about invalid credentials and we exit because
				 * its a potential security risk to disclose more 
				 * information about the nature of the error.
				 */
				new Message(12);
				return;
			}

		}

		/* We must now replicate the process we used at registration and 
		 * create the hashed password in order to match it with the one 
		 * used in the registration.
		 */
		$hashedPassword = hash("sha256", $salt . $password . $salt);

		/* We now need to compare the storedHash with the one he entered 
		 * (the user) as a password in order to login. If they match it's 
		 * the correct user (or someone who knows his credentials).
		 */
		if ($hashedPassword != $storedHash) {
			new Message(12);
			return;
		}

		/* We log the user in so the system knows who he is and that he is online. */
		User::logInUser($username);

		/* We redirect him to his wallet dashboard. */
		Redirect::phpRedirect("wallet");

	}

	public static function create($username, $password, $repeat, $email) {

		/* We load the $dbConn variable as global to use it inside the function. */
		global $dbConn;

		/* 
		 * We first need to sanitize the variables we got in order to avoid
		 * SQL injection attacks from malicious users.
		 */
		$username = $dbConn->real_escape_string($username);
		$password = $dbConn->real_escape_string($password);
		$repeat = $dbConn->real_escape_string($repeat);
		$email = $dbConn->real_escape_string($email);


		/* We check if the two passwords match each other. */
		if ($password == $repeat) {

			/* Check if username is empty. */
			if (Validator::isEmpty($username)) {
				new Message(3);
				return;
			}

			/* We check if the user has supplied a valid email address. */
			if (Validator::validateEmail($email) == false) {
				new Message(6);
				return;
			}

			/* We check for duplicate usernames. */
			if (Validator::userExists($username)) {
				new Message(8);
				return;
			}

			/* We check for duplicate email address. */
			if (Validator::emailExists($email)) {
				new Message(9);
				return;
			}

			/* 
			 * Check password for security. 
			 * Password security policy rules:
			 * ---------------------------------
			 * 1. It must contain both numbers/letters.
			 * 2. It must be longer than 8 characters.
			 */
			if (Validator::isValidPassword($password) == false) {
				new Message(10);
				return;
			}

			/* We generate a new unique salt for the user. */
			$salt = Salt::getHash(); 

			/* 
			 * We now need to store the password as a hash and for that reason
			 * we will use the hash function sha-256 which generates a 64 character
			 * hash (256 bits long and uses 4 bits per character = 64 characters).
			 * We also mix the salt with the hash so that it is harder for an
			 * attacker to bruteforce the hash and find the correct password.
			 */
			$hashedPassword = hash("sha256", $salt . $password . $salt);

			/* We build our query and execute it. */
			$result = $dbConn->query("INSERT INTO `accounts` VALUES ('', '$username', '$hashedPassword', '$email', '$salt', NULL, NULL);");

			/* Supposing the query ran then */
			if ($result) {
				//The account was created successfully.
				new Message(7, "success");
			}

		} else {

			/* The two passwords don't match each other. */
			new Message(5);
		}
	}

	public static function changePassword($username, $oldPassword, $newPassword) {
		/* We load the $dbConn variable as global to use it inside the function. */
		global $dbConn;

		$username = $dbConn->real_escape_string($username);
		$oldPassword = $dbConn->real_escape_string($oldPassword);
		$newPassword = $dbConn->real_escape_string($newPassword);

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
			} else {

				/* If the username does not exist we display a general
				 * error about invalid credentials and we exit because
				 * its a potential security risk to disclose more 
				 * information about the nature of the error.
				 */
				new Message(12);
				return;
			}

		}

		$hashedPassword = hash("sha256", $salt . $oldPassword . $salt);

		/* We now need to compare the storedHash with the one he entered 
		 * (the user) as a password in order to login. If they match it's 
		 * the correct user (or someone who knows his credentials).
		 */
		if ($hashedPassword != $storedHash) {
			new Message(12);
			return;
		}

		$newHashedPassword = hash("sha256", $salt . $newPassword . $salt);

		/* 
		 * Update the user's password with the new one.
		 */
		$result = $dbConn->query("UPDATE `accounts` SET `password`='$newHashedPassword' WHERE `username`='$username';");
		
		return $result;
	}

}