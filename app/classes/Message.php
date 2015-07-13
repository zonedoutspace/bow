<?php 

//======================================================================
// ERROR MESSAGING CLASS (Message.php)
//======================================================================

//----------------------------------------------------------------------
//	This class contains all information needed in order to output error
//	messages and warning to the user via the front end. We can also 
//	output success messages to the user.
//----------------------------------------------------------------------

class Message {

/* -------------------------------------------------------------------- *
 *	The class constructor which takes two arguments.
 * --------------------------------------------------------------------
 *  @id : the numeric id of the error message.
 *	@type : an optional argument which is the type of the message
 *				it can be error, warning or success. 
 * -------------------------------------------------------------------- */

	public function __construct($id,$type = "error") {
		
		switch($id) {

			case 1:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Something went wrong!</p>";
				break;
			case 2:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Invalid form type!</p>";
				break;
			case 3:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Invalid username!</p>";
				break;
			case 4:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Invalid password!</p>";
				break;
			case 5:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>The two passwords don't match!</p>";
				break;
			case 6:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Invalid email address!</p>";
				break;
			case 7:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Your account was created!</p>";
				break;
			case 8: 
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>This username already exists!</p>";
				break;
			case 9: 
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>This email address already exists!</p>";
				break;
			case 10: 
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Invalid password! Your password must contain both numbers and letters and be 8 characters or more.</p>";
				break;
			case 11:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>You have logged in. Welcome!</p>";
				break;
			case 12:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Invalid credentials please try again!</p>";
				break;
			case 13:
				echo "<p class='$type'><span><i class='fa fa-times'></i></span>Invalid remote address!</p>";
				break;
		}
	}

}