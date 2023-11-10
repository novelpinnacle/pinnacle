<div id="content">
		<div class="row">
		<div class='col-sm-4'></div>
			<div class="col-sm-4">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Edit Batch</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>erp/updatebatch" method="post">
						<input type="hidden" name="cid" value="<?=isset($batch->id)?$batch->id:''?>">
							<div class='form-group'>
							<label class="w3-text-grey">batch Name</label>
								<input type="text" name="batch" value="<?=isset($batch->batch)?$batch->batch:''?>" class="w3-input w3-border" placeholder="batch Name" required>
							</div>
							<div class="form-group">
							<input type="submit" value="Update" class="btn btn-default btn-sm">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</div>
<script src="<?=base_url()?>js/erp-edit-common.js"></script>