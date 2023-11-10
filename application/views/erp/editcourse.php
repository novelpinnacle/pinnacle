<div id="content">
		<div class="row">
		<div class='col-sm-4'></div>
			<div class="col-sm-4">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Edit Course</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>erp/updatecourse" method="post">
						<input type="hidden" name="cid" value="<?=isset($course->id)?$course->id:''?>">
							<div class='form-group'>
							<label class="w3-text-grey">Course Name</label>
								<input type="text" name="course" value="<?=isset($course->course)?$course->course:''?>" class="w3-input w3-border" placeholder="Course Name" required>
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