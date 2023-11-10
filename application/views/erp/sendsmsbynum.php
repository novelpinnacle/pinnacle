<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Send SMS By Number</h4>
		</div>
		<div class="mycardbody">
			<form id="form" action="<?=base_url()?>erp/sendsmsbynumbers" method="post">
				<div class='form-group'>
					<label>Enter Numbers</label>
					<textarea name="numbers" style="height:200px" class="w3-input w3-border" ></textarea>
				</div>
				<div class="form-group">
					<label>Enter Message</label>
					<textarea class="w3-input w3-border" name="message"></textarea>
				</div>
				<div class='form-group'>
					<input type="submit" value="Send" class='btn btn-default ' >
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?=base_url()?>js/erp-add-common.js"></script>