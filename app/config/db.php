<?php

//======================================================================
// DATABASE CONNECTION FILE (db.php)
//======================================================================

//----------------------------------------------------------------------
//	This file contains all the basic information needed for the connection
// 	to the database.
//----------------------------------------------------------------------


/* -------------------------------------------------------------------- *
 *	The $db array contains all the needed information in order to connect
 *	to the specified database.
 * -------------------------------------------------------------------- */

$db['hostname'] = "localhost";
$db['username'] = "root";
$db['password'] = "";
$db['database'] = "bow_db";


/* -------------------------------------------------------------------- *
	Initialise the connection to the database.
 * -------------------------------------------------------------------- */
	
$dbConn = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);

if ($dbConn->connect_errno) {
    printf("Connect failed: %s\n", $dbConn->connect_error);
    exit();
}
