<?php

class Salt {

	private static $hash = "";
	private static $charset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	private static $length = 45;

	public function __construct() {
		if (strlen(self::$hash) == 0) {
			self::getHash();
		}
	} 

	public static function getHash() {
		for ($i = 0; $i < self::$length; $i++) {
			self::$hash .= self::$charset[rand(0, strlen(self::$charset) - 1)];
		}
		return self::$hash;
	}

}