<?php include 'app/includes/header.php';?>
<?php 
	/* We first check if the user is logged in, before we show him tha page.
	 * Users who are not logged in are redirected back to the login page.
	 */
	if (!User::isLoggedIn()) {
		Redirect::phpRedirect("start");
	}

	/* Check if the user has made a logout request. */
	if (isset($_GET['logout'])) {
		User::logOutUser();
	}
	?>
		<div class="top-container">
			<div class="row">
				<div class="large-10 large-centered columns">
					<img src="content/img/bow-small.png" class="logo"/>
					<span class="user-logout"> 
						Welcome 
						<span data-tooltip aria-haspopup="true" class="has-tip" title="Last login at <?php echo $_SESSION['user']['lastLogin'] . ' from ' . $_SESSION['user']['lastIP']; ?>">
							<?php echo $_SESSION['user']['username'];?> 
						</span>
						<a class="logout" href="wallet?logout">Log out <i class="fa fa-sign-out"></i></a>
					</span>
				</div>
			</div>
		</div>
		<div class="main-content">
			<div class="row">
				<div class="large-10 large-centered columns">
					<dl class="tabs" data-tab>
						<dd class="active"><a href="#dashboard"><i class="fa fa-tachometer"></i> Dashboard</a></dd>
						<dd><a href="#sendreceive"><i class="fa fa-paper-plane"></i> Send & Receive</a></dd>
						<dd><a href="#accounts"><i class="fa fa-btc"></i> Addresses</a></dd>
						<dd><a href="#transactions"><i class="fa fa-history"></i> Transactions</a></dd>
						<dd><a href="#profile"><i class="fa fa-user"></i> Profile</a></dd>
					</dl>
					<div class="tabs-content">
						<div class="content active" id="dashboard">
							<?php include 'app/includes/dashboard.php'; ?>
						</div>
						<div class="content" id="accounts">
							<?php include 'app/includes/addresses.php'; ?>
						</div>
						<div class="content" id="transactions">
							<?php include 'app/includes/transactions.php'; ?>
						</div>
						<div class="content" id="profile">
							<?php include 'app/includes/profile.php'; ?>
						</div>
						<div class="content" id="sendreceive">
							<?php include 'app/includes/sendreceive.php'; ?>
						</div>
					</div>
				</div>	
			</div>
		</div>