<style>
form{
	padding: 10px 20px;
}
label span{
	color:#FF5733;
}
</style>
<div class="container">
	<section class="section pages" style="padding-top:10px;">
		<div class="section-title">
			<h2>Registration Form</h2>
		</div>
		<div class="row shadow">
		<form id="form" autocomplete="off" action="<?=base_url()?>home/savestudent"  method="post">
				<div class="row">
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Name <span>*</span></label>
							<input type="text" name="name" title="Only Alphabets Allowed" pattern="^[a-zA-Z]+([\s][a-zA-Z]+)*$" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Email  <span>*</span></label>
							<input type="email" name="email" class="w3-input w3-border" required>
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
							<input type="number" min="0" name="rollno" class="w3-input w3-border">
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Course  <span>*</span></label>
							<select name="courseId" class="w3-input w3-border" required  onchange="loadBatches(this.value)">
							<option value="">Select Course</option>
							<?php 
							foreach ($courses as $v) {
								echo "<option value='$v->courseId'>$v->course</option>";
							}
							?>
							</select>
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Batch  <span>*</span></label>
							<select name="batchId" class="w3-input w3-border" required id="batch">
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
							<input type="text" name="dob" class="w3-input w3-border datepickerS" required>
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
					<div class='col-sm-0 wp pr'>
						<div class='form-group'>
							<!-- <label class="w3-text-grey">Biometric ID</label> -->
							<input type="hidden" min="1" name="bioid" class="w3-input w3-border">
						</div>
					</div>
					<div class="col-sm-3 wp pr">
						<div class="form-group">
						<label>Choose Image</label><br>
						<input type="file" accept="image/x-png,image/gif,image/jpeg" id="imagefile" onchange="$('#showselected').html('Selected File:<b> '+this.files[0].name+'</b>')" name="image" style="position:absolute;left:-2000px">
							<input type="button" value="Choose Image" onclick="imagefile.click()" class="btn btn-default btn-block">
						</div>
					</div>
					<div class="col-sm-3 wp pr">
						<div class="form-group">
						<label>&nbsp; </label><br>
							<input type="submit" value="Submit" class="btn btn-default btn-block">
						</div>
					</div>
					<div class="col-sm-12 wp"><div id="showselected"></div></div>
					<div class='col-sm-12 wp'>
						<div class="w3-text-red"><b>For any Enquiry related to Registration whatsapp @8248918528</b></div>
					</div>
				</div>
					
			</form>
			</div>
	</section>
</div>
<script>
$('#form').submit(function(evt) {
    evt.preventDefault();
    $("#form input[type=submit]").attr("disabled",true);
    var formData = new FormData(this);
    $.ajax({
    type: 'POST',
    url: $(this).attr('action'),
    data:formData,
    cache:false,
    dataType: 'json',
    contentType: false,
    processData: false,
    success: function(data) {
     if(data.status=="ok"){
    	$("#form").trigger("reset");
      	if(document.getElementById("showselected")!==null){
        $("#showselected").html("");
      }
     }
     $("#form input[type=submit]").attr("disabled",false);
     openModal({
     	title:'Status',
     	content:data.message
     });
    }
   });
  });
var baseurl="<?=base_url()?>";

function loadBatches(cid){
	if(cid=="")return;
	$.post({url:baseurl+'home/getbatchesbycourseid',data:{'cid':cid},success:function(data){
		$("#batch").html("<option value=''>Select Batch</option>"+data);
	}});
}
$( function() {
    $( ".datepickerS").datepicker({dateFormat:"yy-mm-dd",changeMonth: true,
      changeYear: true,minDate:new Date(2001,0,1),maxDate:new Date(2011,11,31)});
});

</script>