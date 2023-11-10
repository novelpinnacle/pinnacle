<?php if(!empty($data)){?>
<div id="content">
<div class='container-fluid'>
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Edit Student</h4>
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>user/updatestudent" method="post">
				<div class="row">
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Username</label>
							<input type="text" name="sid" readonly value="<?=$data->sid?>" class="w3-input w3-border" required>
						</div>
					</div>
	
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Name</label>
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
							<label class="w3-text-grey">Father Name</label>
							<input type="text" name="fname" value="<?=$data->fname?>" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Father Mobile</label>
							<input type="text" name="fmobile" value="<?=$data->fmobile?>" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Student Phone</label>
							<input type="text" name="phone" value="<?=$data->phone?>" class="w3-input w3-border">
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Roll No.</label>
							<input type="text" name="rollno" value="<?=$data->rollno?>" class="w3-input w3-border" required>
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Course</label>
							<select name="course" class="w3-input w3-border" required id="course"  onchange="loadBatches(this.value)">
							<option value="">Select Course</option>
							<?php 
							foreach ($courses as $v) {
								$selected="";
								if($v->id==$data->course){$selected="selected";}
								echo "<option value='$v->id' $selected>$v->course</option>";
							}
							?>
							</select>
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Batch</label>
							<select name="batch" class="w3-input w3-border" required id="batch">
								<option value="">Select Batch</option>
							</select>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Gender</label>
							<select name="gender" class="w3-input w3-border" required>
							<option>Male</option>
							<option>Female</option>
							</select>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">D.O.B</label>
							<input type="text" name="dob" value="<?=$data->dob?>" class="w3-input w3-border datepicker" required>
						</div>
					</div>
					<div class='col-sm-4 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Village/City</label>
							<input type="text" name="city" value="<?=$data->city?>" class="w3-input w3-border" required>
						</div>
					</div>
					<div class='col-sm-12 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">Address</label>
							<textarea name="address" class="w3-input w3-border" required><?=$data->address?></textarea>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
							<div class='form-group'>
								<label class="w3-text-grey">Session  <span>*</span></label>
								<select name="session" class="w3-input w3-border" required>
									<?php
									foreach ($sessions as $v) {
										$s=$v->id==$data->session?'selected':'';
										echo "<option value='$v->id' $s>$v->session</option>";
									}
									?>
								</select>
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
							<input type="button" value="Choose Image" onclick="imagefile.click()" class="fancy-btn btn-block small-btn">
						</div>
					</div>
					<div class="col-sm-3 wp pr">
						<div class="form-group">
						<label>&nbsp; </label><br>
							<input type="submit" value="Update" class="fancy-btn btn-block small-btn">
						</div>
					</div>
					<div class="col-sm-12 wp pr"><div id="showselected"></div></div>
				</div>
					
				</form>
			</div>
	</div>
</div>
</div>

<?php }?>

<script>
var baseurl="<?=base_url()?>";

function loadBatches(cid){
$.post({url:baseurl+'user/getbatchesbycourseid',data:{'cid':cid},success:function(data){
$("#batch").html("<option value=''>Select Batch</option>"+data);
$('#batch').val(<?=$data->batch?>);
}});
}
loadBatches(course.value);

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
          if(document.getElementById("showselected")!==null){
            $("#showselected").html("");
          }
         }
         $("#form input[type=submit]").attr("disabled",false);
        openModal({title:'Status',content:data.message});
        }
       });
  });

</script>