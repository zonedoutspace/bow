<?php
//======================================================================
// REDIRECTION FILE (Redirect.php)
//======================================================================

//----------------------------------------------------------------------
//	This file is used in order to hadle redirections of the user from
//	one page to another, displaying a message or not before the redirection.
//----------------------------------------------------------------------

class Redirect {

	/* We have the ability to use a javascript redirection which
	 * can also show a message to the user before redirecting.
	 */
	public static function jsRedirect($location, $message = "") {
		if (!empty($message)) {
			echo "<script>alert('$message');</script>";
		}
		echo "<script>window.location.replace('$location');</script>";
	}

	/* We can use PHP's native redirection without having the ability
	 * to show a message.
	 */
	public static function phpRedirect($location) {
		header("Location: $location");
	}

}