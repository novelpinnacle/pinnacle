<style>
label span{
	color:#FF5733;	
}
</style>
<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Add User</h4>
		</div>
		<div class="mycardbody">
			<form id="form" action="<?=base_url()?>erp/saveuser" method="post" autocomplete="off">
				<div class="row">
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Name <span>*</span></label>
							<input type="text" title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$"  name="name" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Email</label>
							<input type="text" name="email" class="w3-input w3-border" >
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Phone <span>*</span></label>
							<input type="text" name="phone"  minlength="10" maxlength="10" pattern="^[0-9]*$" title="Only Numeric values allowed"  required class="w3-input w3-border" >
						</div>
					</div>

					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Gender <span>*</span></label>
							<select name="gender" class="w3-input w3-border" required>
							<option>Male</option>
							<option>Female</option>
							</select>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">D.O.B <span>*</span></label>
							<input type="text" name="dob" required class="w3-input w3-border datepicker">
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Role</label>
							<select name="role" class="w3-input w3-border" required>
								<option value="coordinator">Coordinator</option>
								<option value="receptionist">Receptionist</option>
								<option value="librarian">Librarian</option>
							</select>
						</div>
					</div>
					<div class='col-sm-6 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Qualification <span>*</span></label>
							<textarea name="qualification" class="w3-input w3-border" required></textarea>
						</div>
					</div>
					<div class='col-sm-6 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Address</label>
							<textarea name="address" class="w3-input w3-border"></textarea>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Username <span>*</span></label>
							<input type="text" name="cid" title="Alphabets,Digits and Underscore is allowed" pattern="^[a-zA-Z0-9]+([_]?[a-zA-Z0-9])*$" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Password <span>*</span></label>
							<input type="text" name="password" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Biometric ID</label>
							<input type="number" min="1" name="bioid" class="w3-input w3-border">
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
							<input type="submit" value="Submit" class="btn btn-default btn-block btn-sm">
						</div>
					</div>
					<div class="col-sm-6 wp pr" style="clear:both"></div>
					<div class="col-sm-6 wp pr"><div id="showselected"></div></div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	var baseurl="<?=base_url()?>";
</script>
<script src="<?=base_url()?>js/erp-add-common.js"></script>