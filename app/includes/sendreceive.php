<h4>Send & Receive</h4>
<div class="tab-content-inner">
	<dl class="accordion" id="send-receive-accordion" data-accordion>
		<dd class="accordion-navigation">
			<a href="#send">Send bitcoins</a>
			<div id="send" class="content">
				<form method="post" id="frmSend" action="send.php" class="srfrm">
					<label>Remote Address</label>
					<input type="text" name="remoteAddress"/>
					<label>Amount</label>
					<input type="number" name="amount" step="any"/>
					<center><input type="submit" value="Send"/></center>
				</form>
				<div class="response"></div>
				<script type="text/javascript">
					$(document).ready(function() {
						$("#frmSend").submit(function() {
							event.preventDefault();
							$.ajax( {
								type: "POST",
								url: $("#frmSend").attr('action'),
								data: $("#frmSend").serialize(),
								success: function(response) {
									console.log(response);
									$(".response").html(response);
								}
							});
						});
					});
				</script>
			</div>
		</dd>
		<dd class="accordion-navigation">
			<a href="#receive">Receive bitcoins</a>
			<div id="receive" class="content">
				<form class="srfrm">
					<label>Select a local address</label>
					<select class="select-address">
						<?php
						$addresses = Wallet::getAddresses();
						foreach ($addresses as $address) {
							?>
							<option value="<?php echo $address;?>"><?php echo $address;?></option>
							<?php
						}
						?>
					</select>
					<center>
						<a class="btn-action" id="copy" href="javascript:void(0);">Copy address</a>
						<a class="btn-action" id="qrCodeGen" href="javascript:void(0);">View QR Code</a>
						<div id="qrcode" title="Click to hide this!"></div>
					</center>
				</form>
			</div>
		</dd>
	</dl>
</div>
<script type="text/javascript" src="content/js/jquery.qrcode.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/zclip/1.1.2/jquery.zclip.min.js"></script>
<script type="text/javascript">
	$("#copy").zclip({
		path: '//cdnjs.cloudflare.com/ajax/libs/zclip/1.1.2/ZeroClipboard.swf',
		copy: function() {
			return $(".select-address option:selected").text();
		}
	});
</script>
<script type="text/javascript">
	$("#qrCodeGen").click(function() {
		$('#qrcode').html('');
		$('#qrcode').qrcode($(".select-address option:selected").text());
	});
	$('#qrcode').click(function() {
		$('#qrcode').html('');
	})
</script>