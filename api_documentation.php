<?php include 'app/includes/header.php';?>
<div class="container">
	<h1>API Documentation</h1>
	<div class="api_nav">
		<a href="/bow">Home</a>
		<a href="#overview">Overview</a>
		<a href="#requests">Requests</a>
		<a href="#examples">Examples</a>
	</div>

	<a name="overview">
		<h3>API Overview</h3>
	</a>
	<p>
		This API is an attempt to help programmers connect their applications with our service. Below you can find information about the types of the requests that can be made, the responses that our service gives and how you can parse these responses in order to make a fully working application. The way our api works is fairly easy to understand, you start by making a LOGIN request and supposing the credentials of the user are correct, our service responds with a token, which is a string that uniquely identifies your session, and expires after 10 minutes for security purposes. After your LOGIN request the only thing that is required for full access on a user account is the token. So keep in mind that in all future requests you make you need to supply the token in order for them to work.
	</p>

	<a name="requests">
		<h3>Requests</h3>
	</a>
	<p>
		These requests are available and built-in our API.
		<table>
			<tr>
				<th>Request</th>
				<th>Parameters</th>
				<th>Responses</th>
			</tr>
			<tr>
				<td>LOGIN</td>
				<td>username, password</td>
				<td>A token string that identifies the user or a warning / error.</td>
			</tr>
			<tr>
				<td>LOGOUT</td>
				<td>token</td>
				<td>A message that indicates that the user is logged out or a warning / error.</td>
			</tr>
			<tr>
				<td>TRANSFER</td>
				<td>token, amount, address</td>
				<td>A message that indicates that the transaction was successful or a warning / error.</td>
			</tr>
			<tr>
				<td>BALANCE</td>
				<td>token</td>
				<td>Returns an array containing the addresses, and amounts in each address which you can sum to show the total balance of an account or a warning / error is the token is incorrect.</td>
			</tr>
			<tr>
				<td>TRANSACTIONS</td>
				<td>token</td>
				<td>Returns an array of all the transactions of an account or a warning / error is the token is incorrect.</td>
			</tr>
			<tr>
				<td>NEWADDRESS</td>
				<td>token</td>
				<td>Returns a new bitcoin address where you can receive bitcoins or a warning / error is the token is incorrect.</td>
			</tr>
		</table>

	<a name="examples">
		<h3>Examples</h3>
	</a>
	<p>
		These requests are available and built-in our API.
		<table>
			<tr>
				<th>Request</th>
				<th>Parameters</th>
				<th>Responses</th>
			</tr>
			<tr>
				<td>LOGIN</td>
				<td>username, password</td>
				<td>A token string that identifies the user or a warning / error.</td>
			</tr>
			<tr>
				<td>LOGOUT</td>
				<td>token</td>
				<td>A message that indicates that the user is logged out or a warning / error.</td>
			</tr>
			<tr>
				<td>TRANSFER</td>
				<td>token, amount, address</td>
				<td>A message that indicates that the transaction was successful or a warning / error.</td>
			</tr>
			<tr>
				<td>BALANCE</td>
				<td>token</td>
				<td>Returns an array containing the addresses, and amounts in each address which you can sum to show the total balance of an account or a warning / error is the token is incorrect.</td>
			</tr>
			<tr>
				<td>TRANSACTIONS</td>
				<td>token</td>
				<td>Returns an array of all the transactions of an account or a warning / error is the token is incorrect.</td>
			</tr>
			<tr>
				<td>NEWADDRESS</td>
				<td>token</td>
				<td>Returns a new bitcoin address where you can receive bitcoins or a warning / error is the token is incorrect.</td>
			</tr>
		</table>
	</p>
</div>
<script>
	$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
    }
  });
});
</script>