<?php

//======================================================================
// APPLICATION INITIALIZATION FILE (init.php)
//======================================================================

//----------------------------------------------------------------------
//	This file contains all the basic information needed by this application 
//	in order to work properly. It also contains information about the 
//  development of this application and parameters for production.
//----------------------------------------------------------------------

/* -------------------------------------------------------------------- *
 *	Handles application's error reporting, should be error_reporting(0) 
 *	on a development environment, leave E_ALL for development.
 * -------------------------------------------------------------------- */
error_reporting(E_ALL);

/* -------------------------------------------------------------------- *
 *	Set the base path of the application.
 * -------------------------------------------------------------------- */
$basePath = realpath(".");

/* -------------------------------------------------------------------- *
 *	Load all the needed libraries for this application in order to work
 *	properly both on development and production environment.
 * -------------------------------------------------------------------- */
require_once $basePath . "/app/config/session.php";
require_once $basePath . "/app/libraries/easybitcoin.php";
require_once $basePath . "/app/config/db.php";
require_once $basePath . "/app/config/bitcoind.php";
require_once $basePath . "/app/classes/Wallet.php";
require_once $basePath . "/app/classes/User.php";
require_once $basePath . "/app/classes/Redirect.php";
require_once $basePath . "/app/classes/Salt.php";
require_once $basePath . "/app/classes/Validator.php";
require_once $basePath . "/app/classes/Account.php";
require_once $basePath . "/app/classes/Message.php";
require_once $basePath . "/app/classes/API.php";
require_once $basePath . "/app/classes/TokenGenerator.php";

