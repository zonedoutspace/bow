<?php

//======================================================================
// APPLICATION PROGRAMMING INTERFACE (api.php)
//======================================================================

//----------------------------------------------------------------------
//	This file contains all the information and basic functions needed in
//  order for external clients to connect and use this application.
//----------------------------------------------------------------------

//----------------------------------------------------------------------
// List of basic requests that can be made.
// - LOGIN
// - LOGOUT
// - TRANSFER
// - BALANCE
// - TRANSACTIONS
// - NEWADDRESS
//----------------------------------------------------------------------

//----------------------------------------------------------------------
// Documentation for this API exists in 
// http://yoursite/bow/api_documentation
//----------------------------------------------------------------------
include 'app/config/init.php';

$api = new API($_REQUEST);

echo $api->getReturnedData();


