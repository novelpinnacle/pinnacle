<div id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Edit Attendance</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>user/updatestudentattendance" method="post">
						<div class="form-group">
						<label>Select Course</label>
						<select id="course" class="w3-input w3-border course" name="cid" onchange="loadBatches(this.value,batch)">
						<option value="">Select Course</option>
						<?php 
						foreach ($courses as $v) {
						echo "<option value='$v->id'>$v->course</option>";
						}
						?>
						</select>
						</div>

						<div class="form-group">
						<label>Select Batch</label>
						<select id="batch" class="w3-border w3-input batch" name="bid" onchange="loadSubjects(this.value,subject,course,batch)">
						<option value="">Select Batch</option>
						</select>
						</div>
						
						<div class="form-group">
						<label>Select Subject</label>
						<select class="w3-border w3-input subject" name='sid' id='subject'>
						<option value="">Select Subject</option>
						</select>
						</div>

						<div class="form-group">
								<label>Select Student</label>
								<select class='w3-input w3-border' name='studentid' id="student" required>
									<option value="">Select Student</option>
									<?php foreach ($data as $v) {
										echo "<option value='$v->sid'>$v->name</option>";
									} ?>
								</select>
						</div>
						<div class='form-group'>
						<label>Enter Date</label>
						<input type="text" name='date' required class="w3-input w3-border datepicker">
						</div>	
						<div class='form-group'>
						<label>Select Attendance Status</label>
						<select name='status' class='w3-input w3-border'>
						<option value='1'>Present</option>
								<option value='0'>Absent</option>
								<option value='2'>On Leave</option>
								<option value='3'>N/A</option>
								<option value='4'>Holiday</option>
						</select>
						</div>
						<div class="form-group">
							<div class='form-group'>
							<input type="submit" value="Update" class="fancy-btn btn-block" >
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
<script>

var baseurl="<?=base_url()?>";
function loadBatches(cid,ele){
$.post({url:baseurl+"user/getbatchesbycourseid",data:{'cid':cid},success:function(data){
ele.innerHTML="<option value=''>Select Batch</option>"+data;
}}); 
}

function loadSubjects(bid,subjectid,co,ba){
cid=co.value;
bid=ba.value;
$.post({url:baseurl+"user/getsubjectsbybatchid",data:{'bid':bid},success:function(data){
subjectid.innerHTML="<option value=''>Select Subject</option>"+data;
}}); 

$.post({url:baseurl+"user/getstudents",data:{'cid':cid,'bid':bid},success:function(data){
student.innerHTML="<option value=''>Select Student</option>"+data;
}}); 



}

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
                  $("#form input[type=submit]").attr("disabled",false);
                  openModal({title:'Status',content:data.message});
                }
               });
  });
</script>