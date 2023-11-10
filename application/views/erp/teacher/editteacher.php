<style>
label span{
	color:#FF5733;	
}
</style>
<?php if(!empty($data)){?>
<div id="content">
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Edit Teacher</h4>
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>erp/updateteacher" method="post">
				<div class="row">
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Username <span>*</span></label>
							<input type="text" name="tid" readonly value="<?=$data->tid?>" class="w3-input w3-border" required>
						</div>
					</div>
	
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Name <span>*</span></label>
							<input type="text" name="name" value="<?=$data->name?>" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Email</label>
							<input type="text" name="email" value="<?=$data->email?>" class="w3-input w3-border">
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Phone <span>*</span></label>
							<input type="text" name="phone" value="<?=$data->phone?>" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Gender <span>*</span></label>
							<select name="gender" class="w3-input w3-border" required>
								<option <?=strtolower($data->gender)=='male'?'selected':''?>>Male</option>
								<option <?=strtolower($data->gender)=='female'?'selected':''?>>Female</option>
							</select>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">D.O.B <span>*</span></label>
							<input type="text" name="dob" value="<?=$data->dob?>" class="w3-input w3-border datepicker" required>
						</div>
					</div>
					<div class='col-sm-6 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Qualification <span>*</span></label>
							<textarea name="qualification" class="w3-input w3-border" required><?=$data->qualification?></textarea>
						</div>
					</div>
					<div class='col-sm-6 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Address</label>
							<textarea name="address" class="w3-input w3-border"><?=$data->address?></textarea>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Biometric ID </label>
							<input type="number" min="1" name="bioid" value="<?=$data->bioid?>" class="w3-input w3-border">
						</div>
					</div>
					<div class="col-sm-3 wp pr">
						<div class="form-group">
						<label>Choose Image</label>
						<input type="file" accept="image/x-png,image/gif,image/jpeg" id="imagefile" onchange="$('#showselected').html('Selected File:<b> '+this.files[0].name+'</b>')" name="image" style="position:absolute;left:-2000px">
							<input type="button" value="Choose Image" onclick="imagefile.click()" class="btn btn-default btn-block btn-sm">
						</div>
					</div>
					<div class="col-sm-3 wp pr">
						<div class="form-group">
						<label>&nbsp; </label><br>
							<input type="submit" value="Update" class="btn btn-default btn-block btn-sm">
						</div>
					</div>
					<div class="col-sm-12 wp pr"><div id="showselected"></div></div>
				</div>
					
				</form>
			</div>
	</div>
</div>
<?php }?>
<script src="<?=base_url()?>js/erp-edit-common.js"></script>