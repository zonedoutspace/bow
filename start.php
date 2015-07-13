<?php include 'app/includes/header.php';?>
<div class="outer-container">
	<div class="form-container">
		<div class="row">
			<div class="large-4 large-centered columns">
				<center>
					<a href="index" title="Go to homepage">
						<img src="content/img/bow_transparent.png" class="logo"/>
					</a>
				</center>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

					<input type="hidden" id="formType" name="formType" value="login"/>

					<label>Username</label>
					<input type="text" name="username" id="uTxt" required/>

					<label>Password</label>
					<input type="password" name="password" id="pTxt" required/>

					<label id="RPLbl">Repeat password</label>
					<input type="password" name="repeat" id="RPTxt"/>

					<label id="eLbl">Email address</label>
					<input type="email" name="email" id="eTxt"/>

					<!-- <label class="chklbl"><input type="checkbox" name="chkSaveUsername"><span class="label-text">Remember Username</span></label> -->

					<input type="submit" id="loginBtn" value="Login">

					<a href="#" id="sign-up">Sign up for an account</a>
					<a href="#" id="sign-in">Sign in with an account</a>

					<?php

						/* Check if the user is already logged in and if he is
						 * redirect him to his wallet panel.
						 */
						if (User::isLoggedIn()) {
							Redirect::phpRedirect("wallet");
						}

						/* Check if the user has submitted the form. */
						if (isset($_POST) && !empty($_POST)) {
							
							/* We get the forms' submitted data. */
							$formType = $_POST['formType'];
							$username = $_POST['username'];
							$password = $_POST['password'];
							$repeat = $_POST['repeat'];
							$email = $_POST['email'];

							/* We check to see if the user wanted to login or register. */
							if ($formType == "login") {
								Account::login($username, $password);
							} else if ($formType == "register") {
								Account::create($username, $password, $repeat, $email);
							} else {

								/*
								 * This code will run when a user has changed the value 
								 * of the hidden field that tells us about registration
								 * or login. It can be changed at the runtime as it is 
								 * client-side feature. We output a message to notify 
								 * the user afterwards.
								 */
								new Message(2);
							}
						}
					?>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$("p.error i").click(function() {
		$("p.error").toggle("fade");
	});

	$("p.success i").click(function() {
		$("p.success").toggle("fade");
	});

	$(document).ready(function() {
		$("#RPLbl").hide();
		$("#RPTxt").hide();
		$("#eLbl").hide();
		$("#eTxt").hide();
		$("#loginBtn").val("Login");
		$("#sign-up").show();
		$("#sign-in").hide();
	});

	$("#sign-up").click(function(){
		$(this).hide();
		$("#sign-in").show();
		$("#loginBtn").val("Register");

		$("#RPLbl").show("400");
		$("#RPTxt").show("400");
		$("#eLbl").show("400");
		$("#eTxt").show("400");

		$("#formType").val("register");
	});

	$("#sign-in").click(function(){
		$(this).hide();
		$("#sign-up").show();
		$("#loginBtn").val("Login");

		$("#RPLbl").hide("400");
		$("#RPTxt").hide("400");
		$("#eLbl").hide("400");
		$("#eTxt").hide("400");

		$("#formType").val("login");
	});
</script>