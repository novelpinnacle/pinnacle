<style>
td .w3-input{
	display: inline-block;
	width: 33%;
}
td .fullwidth{
	width: 100%;
}
#form{
	max-width: 400px;
}
</style>
<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Upload Marks</h4>
			</div>
			<div class="mycardbody">
				<form id="form" method="post" action="<?=base_url()?>user/uploadmarksxlsx">
					<div class="form-group">
						<label>Select Exam</label>
						<select class='w3-input w3-border' name='eid' id='examid' >
							<option value="">Select Exam</option>
							<?php
							foreach ($exams as $v) {
								echo "<option value='$v->id'>$v->examname</option>";
							}
							 ?>
						</select>
					</div>
					<div class='form-group'>
						<div class='file-wrapper'>
							<input type="file"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"  required id="xlsxfile" onchange="$('#showselected').html('<b>Selected File:</b> '+this.files[0].name)" name="xlsx">
						</div>
						
						<input type=button class='w3-btn w3-khaki btn-block' onclick="document.getElementById('xlsxfile').click()" value="Choose File">

						<div style="margin-top:0px;" id="showselected"></div>
					</div>
					<div class="form-group">
						<input type="submit" value="Upload Marks" class='w3-btn b-primary' >
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
var baseurl="<?=base_url()?>";

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
	     if(data.status){
	    	$("#form").trigger("reset");
	      	showselected.innerHTML="";
	      }
	      $("#alertDialog").html(data.message);
	       $("#alertDialog").dialog();
	    },
	    error: function(data) {
	    	
	    }
   });
  });

</script>