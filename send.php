<?php 

include 'app/config/init.php';


	//Wallet::listAccountUnspent();

	//create raw transaction
	//sendfrom	<fromaccount> <tobitcoinaddress> <amount> [minconf=1] [comment] [comment-to]	<amount> is a real and is rounded to 8 decimal places. Will send the given amount to the given address, ensuring the account has a valid balance using [minconf] confirmations. Returns the transaction ID if successful (not in JSON object).	Y
	//sendmany	<fromaccount> {address:amount,...} [minconf=1] [comment]	amounts are double-precision floating point numbers

if (isset($_POST)) {
	if (!empty($_POST['remoteAddress']) && !empty($_POST['amount'])) {

		$address = $_POST['remoteAddress'];
		$amount = $_POST['amount'];

		echo $address;

		var_dump(Wallet::sendFrom($address, $amount));

	}
}

?>



