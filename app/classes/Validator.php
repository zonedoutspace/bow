<?php
//======================================================================
// BASIC VALIDATOR CLASS (Validator.php)
//======================================================================

//----------------------------------------------------------------------
//	This file contains all the basic information needed in order to 
//	validate certain user input such as the email address, username 
//	password to ensure that they are correct and follow our specified
//	security policies.
//----------------------------------------------------------------------

class Validator {

	/*
	 * The function below takes an email address as an argument and
	 * checks if it is a valid email address.
	 */
	public static function validateEmail($address) {
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/'; 
		if (preg_match($regex, $address)) {
			return true;
		}
		return false;
	}

	/*
	 * The function below takes a username as an argument and
	 * checks if the username already exists in any of the existing accounts.
	 */
	public static function userExists($username) {
		global $dbConn;
		$result = $dbConn->query("SELECT * FROM `accounts` WHERE `username`='$username';");
		if ($result->num_rows > 0) {
			return true;
		}
		return false;
	}

	/*
	 * The function below takes an email address as an argument and
	 * checks if the email already exists in any of the existing accounts.
	 */
	public static function emailExists($email) {
		global $dbConn;
		$result = $dbConn->query("SELECT * FROM `accounts` WHERE `email`='$email';");
		if ($result->num_rows > 0) {
			return true;
		}
		return false;
	}

	/*
	 * The function below takes as an argument a user specified password
	 * and checks if it matches our password security policy.
	 * ------------------------------------------------------------------
	 * Password security policy rules:
	 * ------------------------------------------------------------------
	 * 1. It must contain both numbers/letters.
	 * 2. It must be longer than 8 characters.
	 */
	public static function isValidPassword($str) {
		if (preg_match('/[A-Za-z]/', $str) && preg_match('/[0-9]/', $str) && strlen($str) >= 8) {
			return true;
		}
		return false;
	}

	public static function isEmpty($str) {
		if (empty($str)) {
			return true;
		}
		return false;
	}



}