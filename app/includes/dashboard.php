<h4>Dashboard</h4>
<div class="tab-content-inner">
	<span>
		<?php echo number_format(Wallet::getBalance(), 8);?> <i class='fa fa-btc'></i>
		<label>Balance</label>
	</span>

	<span>
		<?php echo Wallet::getAddressesCount();?>
		<label>Addresses</label>
	</span>

	<span>
		<?php echo Wallet::getTransactionsCount();?>
		<label>Transactions</label>
	</span>
</div>