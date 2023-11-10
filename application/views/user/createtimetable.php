
<div id="content">
<div class='container-fluid'>
<div class='row'>
	<div class='col-sm-12 wp'>
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Create Timetable</h4>
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>user/uploadtimetable">
					<div class="row">
						<div class="col-sm-3 wp pr">
							<div class='form-group'>
								<label>Select Teacher</label>
								<select class='w3-input w3-border' name="tid" >
									<option value="">Select Teacher</option>
									<?php 
									foreach ($teachers as $v) {
										echo "<option value='$v->tid'>$v->name</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-3 wp pr">
							<div class='form-group'>
								<label>Select Course</label>
								<select class='w3-input w3-border' id='course' name="cid" onchange="loadBatches(this.value)">
									<option value="">Select Course</option>
									<?php 
									foreach ($courses as $v) {
										echo "<option value='$v->id'>$v->course</option>";
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-3 wp pr">
							<div class='form-group'>
								<label>Select Batch</label>
								<select class='w3-input w3-border' id='batch' name="bid" onchange="loadSubjects(this.value)" >
									<option value="">Select Batch</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3 wp">
							<div class='form-group'>
								<label>Select Subject</label>
								<select class='w3-input w3-border' id='subject' name="subjectid" >
									<option value="">Select Subject</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3 wp pr">
							<div class='form-group'>
								<label>From Date</label>
								<input type="text" autocomplete="off" class="w3-input w3-border datepicker" name="from_date" >
							</div>
						</div>
						<div class="col-sm-3 wp pr">
							<div class='form-group'>
								<label>To Date</label>
								<input type="text" autocomplete="off" class="w3-input w3-border datepicker" name="to_date">
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-2 wp pr">
						<label>Schedule</label>
						</div>	
						<div class="col-sm-10 wp">
							<div class="row">
								<div class="col-sm-3">
									<label><input type="checkbox" name="Sunday"> Sunday </label>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="sunday_from">
										<?=$timeslots?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="sunday_to">
										<?=$timeslots?>
									</select>
								</div>
							</div>
							<div style="height:10px"></div>
							<div class="row">
								<div class="col-sm-3">
									<label><input type="checkbox" name="Monday"> Monday </label>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="monday_from">
										<?=$timeslots?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="monday_to">
										<?=$timeslots?>
									</select>
								</div>
							</div>
							<div style="height:10px"></div>
							<div class="row">
								<div class="col-sm-3">
									<label><input type="checkbox" name="Tuesday"> Tuesday </label>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="tuesday_from">
										<?=$timeslots?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="tuesday_to">
										<?=$timeslots?>
									</select>
								</div>
							</div>
							<div style="height:10px"></div>
							<div class="row">
								<div class="col-sm-3">
									<label><input type="checkbox" name="Wednesday"> Wednesday </label>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="wednesday_from">
										<?=$timeslots?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="wednesday_to">
										<?=$timeslots?>
									</select>
								</div>
							</div>
							<div style="height:10px"></div>
							<div class="row">
								<div class="col-sm-3">
									<label><input type="checkbox" name="Thursday"> Thursday </label>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="thursday_from">
										<?=$timeslots?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="thursday_to">
										<?=$timeslots?>
									</select>
								</div>
							</div>
							<div style="height:10px"></div>
							<div class="row">
								<div class="col-sm-3">
									<label><input type="checkbox" name="Friday"> Friday </label>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="friday_from">
										<?=$timeslots?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="friday_to">
										<?=$timeslots?>
									</select>
								</div>
							</div>
							<div style="height:10px"></div>
							<div class="row">
								<div class="col-sm-3">
									<label><input type="checkbox" name="Saturday"> Saturday </label>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="saturday_from">
										<?=$timeslots?>
									</select>
								</div>
								<div class="col-sm-3">
									<select class="w3-input w3-border" name="saturday_to">
										<?=$timeslots?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-3 wp pr">
							<div class='form-group'>
								<input type="submit" class="w3-btn b-primary" >
							</div>
						</div>
						
					</div>
									
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>


<script>
var baseurl="<?=base_url()?>";
	function loadBatches(cid){
		$.post({url:baseurl+"user/getbatchesbycourseid",data:{'cid':cid},success:function(data){
	    	$("#batch").html("<option value=''>Select Batch</option>"+data);
	    }}); 
	}

	function loadSubjects(bid){
		$.post({url:baseurl+"user/getsubjectsbybatchid",data:{'bid':bid},success:function(data){
	    	$("#subject").html("<option value=''>Select Batch</option>"+data);
	    }}); 
	}

	$('#form').submit(function(evt) {
                evt.preventDefault();
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
      
                  }
                   $("#alertDialog").html(data.message);
                   $("#alertDialog").dialog({title:'Alert'});
                },
                error: function(data) {
                	
                }
               });
  });



</script>