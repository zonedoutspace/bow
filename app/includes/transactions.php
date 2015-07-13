<h4>Transactions</h4>
<div class="tab-content-inner">
	<table class="transactions-list">
		<tbody>
			<tr>
				<th>Address</th>
				<th>Amount</th>
				<th>Type</th>
				<th>Confirmations</th>
				<th>Date</th>
			</tr>

			<?php
					$totalTransactions = Wallet::getTransactions();
					foreach ($totalTransactions as $transaction) {
			?>
				<tr>
					<td><?php echo $transaction['address']; ?></td>
					<td><?php echo number_format($transaction['amount'], 8); ?></td>
					<td><?php echo $transaction['category']; ?></td>
					<td><?php echo $transaction['confirmations']; ?></td>
					<td><?php echo date('d-m-Y, H:i:s', $transaction['time']); ?></td>
				</tr>
			<?php
				}
			?>
		</tbody>
	</table>
	
</div>