<?php

class Wallet {
	
	public static function getAddresses() {
		global $bitcoin;
		return $bitcoin->getaddressesbyaccount(User::getUsername());
	}

	public static function getAddressesCount() {
		global $bitcoin;
		return count($bitcoin->getaddressesbyaccount(User::getUsername()));
	}

	public static function createNewAddress() {
		global $bitcoin;
		$bitcoin->getnewaddress(User::getUsername());
	}

	public static function getBalance() {
		global $bitcoin;
		return $bitcoin->getbalance(User::getUsername());
	}

	public static function getTransactions($from = 0, $count = 10) {
		global $bitcoin;
		return $bitcoin->listtransactions(User::getUsername(), $count, $from);
	}

	public static function getTransactionsCount() {
		global $bitcoin;
		return count($bitcoin->listtransactions(User::getUsername(), 1000, 0));
	}

	public static function getReceivedByAddress($address, $minconf = 1) {
		global $bitcoin;

		/**
		 * Returns the total amount received by in transactions with at least 
		 * [minconf] confirmations. While some might consider this obvious, 
		 * value reported by this only considers receiving transactions. 
		 * It does not check payments that have been made from this address. 
		 * In other words, this is not "getaddressbalance". 
		 * Works only for addresses in the local wallet, external addresses 
		 * will always show 0.
		 * ---------------------------------------------------------------------
		 * The blockchain carries the information you are looking for. 
		 * The original client however does not have the function to compute it.
		 */

		return $bitcoin->getreceivedbyaddress($address,$minconf);
	}

	public static function getAddressRealBalance($address) {
		return file_get_contents("https://blockchain.info/el/q/addressbalance/".$address);
	}

	public static function listAccountUnspent() {
		global $bitcoin;

		//https://bitcointalk.org/index.php?topic=218447.0;all

		echo "<pre>";
		print_r($bitcoin->listunspent());
		echo "<br><br>";
		print_r($bitcoin->getrawtransaction("ee8655d880ed4b3a418a36019666dc4dc40fa7e3a167870c76f94a2913d923d9"));
		echo "</pre>";

	}

	public static function sendFrom($address, $amount) {
		global $bitcoin;
		
		if ($bitcoin->validateAddress($address)) {
			
		} else {
			new Message(13);
		}

	}


}