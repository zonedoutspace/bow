<h4>Addresses</h4>
<div class="tab-content-inner">

	
	<table class="account-list">
		<tbody>
			<tr>
				<th>Address</th>
				<th>Balance</th>
			</tr>
			<?php
			$addresses = Wallet::getAddresses();
			foreach ($addresses as $address) {
				?>

				<tr>
					<td><?php echo $address;?></td>
					<td><?php echo number_format(Wallet::getReceivedByAddress($address), 8);?> <!-- &nbsp;&nbsp;&nbsp;(<a href="javascript:void(0);" title="Realtime balance calculated from both internal and external sources." data="<?php echo $address;?>" class="real-balance">Real balance</a>) --> </td>
				</tr>

				<?php
			}
			?>
		</tbody>
	</table>
		<a class="btn-action" href="wallet?newaddress">Create New Address</a>

		<?php
		if (isset($_GET['newaddress'])) {
			Wallet::createNewAddress();
			header('Location: wallet');
		}
		?>
	</div>