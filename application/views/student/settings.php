<div id="content">
	<div class="row">
		<div class="col-sm-4 wp pr">
			<div class="mycard">
				<div class="mycardheader b-primary">
					<h4 class="mycardtitle">Session</h4>
				</div>
				<div class="mycardbody">
					<form id="form" action="<?=base_url()?>student/updatesession">
						<div class='form-group'>
							<label>Select Session</label>
							<select name="session" class="w3-input w3-border">
								<?php 
								foreach ($sessions as $v) {
									$selected="";
									if($activesession && $activesession->sessionid==$v->id){
										$selected="selected";
									}
									echo "<option value=$v->id $selected>$v->session</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<button class='btn btn-default btn-block'>Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?=base_url()?>js/erp-add-common.js"></script>