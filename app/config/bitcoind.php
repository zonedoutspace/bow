<?php

$serverIP = "";
$serverPort = "";
$rpcUsername = "";
$rpcPassword = "";

//read more https://github.com/aceat64/EasyBitcoin-PHP

$bitcoin = new Bitcoin($rpcUsername, $rpcPassword, $serverIP, $serverPort);