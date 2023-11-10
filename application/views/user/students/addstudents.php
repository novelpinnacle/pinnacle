<style>
	label span{color:#FF5733;}
</style>
<div id="content">
<div class='container-fluid'>
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Add Student</h4>
			</div>
			<div class="mycardbody">
				<form id="form" autocomplete="off" action="<?=base_url()?>user/savestudent" method="post">
				<div class="row">
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Name <span>*</span></label>
							<input type="text" name="name" title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Email</label>
							<input type="email" name="email" class="w3-input w3-border" >
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Father Name <span>*</span></label>
							<input type="text" name="fname" class="w3-input w3-border"  title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Father Mobile  <span>*</span></label>
							<input type="text" name="fmobile" class="w3-input w3-border" minlength="10" maxlength="10" pattern="^[0-9]*$" title="Only Numeric values allowed" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Student Phone</label>
							<input type="text" name="phone" class="w3-input w3-border" minlength="10" maxlength="10" pattern="^[0-9]*$" >
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Roll No. <span>*</span></label>
							<input type="number" min="1" name="rollno" class="w3-input w3-border" required>
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Course  <span>*</span></label>
							<select name="course" class="w3-input w3-border" required  onchange="loadBatches(this.value)">
							<option value="">Select Course</option>
							<?php 
							foreach ($courses as $v) {
								echo "<option value='$v->id'>$v->course</option>";
							}
							?>
							</select>
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Batch  <span>*</span></label>
							<select name="batch" class="w3-input w3-border" required id="batch">
								<option value="">Select Batch</option>
							</select>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Gender  <span>*</span></label>
							<select name="gender" class="w3-input w3-border" required>
							<option>Male</option>
							<option>Female</option>
							</select>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">D.O.B <span>*</span></label>
							<input type="text" name="dob" class="w3-input w3-border datepickerS">
						</div>
					</div>
					<div class='col-sm-4 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Village/City <span>*</span></label>
							<input type="text" name="city" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-12 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Address <span>*</span></label>
							<textarea name="address" class="w3-input w3-border" required></textarea>
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
							<input type="button" value="Choose Image" onclick="imagefile.click()" class="fancy-btn btn-block small-btn">
						</div>
					</div>
					<div class="col-sm-3 wp pr">
						<div class="form-group">
						<label>&nbsp; </label><br>
							<input type="submit" value="Submit" class="fancy-btn btn-block small-btn">
						</div>
					</div>
					<div class="col-sm-12 wp"><div id="showselected"></div></div>
				</div>
					
				</form>
			</div>
	</div>
</div>
</div>

<script src="<?=base_url()?>js/erp-add-common.js"></script>
<script>
var baseurl="<?=base_url()?>";
function refreshData(){
	
}
function loadBatches(cid){
	if(cid=="")return;
	$.post({url:baseurl+'user/getbatchesbycourseid',data:{'cid':cid},success:function(data){
		$("#batch").html("<option value=''>Select Batch</option>"+data);
	}});
}

<?php echo "var data=$data;"; ?>
$("[name=fname]").val(data.fathername);
$("[name=name]").val(data.studentname);
$("[name=fmobile]").val(data.fathermobile);
$("[name=address]").val(data.address);
$("[name=course]").val(data.course);
loadBatches(data.course);

$(function() {
    $( ".datepickerS").datepicker({dateFormat:"yy-mm-dd",changeMonth: true,
      changeYear: true,minDate:new Date(2001,0,1),maxDate:new Date(2011,11,31)});
});
</script>