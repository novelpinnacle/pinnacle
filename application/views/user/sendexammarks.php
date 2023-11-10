<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Search Marks</h4>
			</div>
			<div class="mycardbody">
				<form id="form" method="post">
					<div class='row'>
						<div class='col-sm-3 wp pr'>
					<label>Select Course</label>
						<select class='w3-input w3-border' id='course' onchange="loadBatches(this.value)">
							<option value="">Select Course</option>
							<?php 
							foreach ($courses as $v) {
								echo "<option value='$v->id'>$v->course</option>";
							}
							?>
						</select>
					</div>
					<div class='col-sm-3 wp pr'>
						<label>Select Batch</label>
						<select class='w3-input w3-border' id='batch' >
							<option value="">Select Batch</option>
						</select>
					</div>
						<div class="col-sm-3 wp pl">
						<label>&nbsp; </label><br>
						<input type="button" value="Get Exams" onclick="loadExams(batch.value)" class='fancy-btn small-btn' >
						</div>
					</div>
				</form>

				<div style="margin-top:30px;" class='table-wrapper' id="loadhere">
						
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
function loadExams(bid){
	$("#loading").css("display","block");
	$.post({url:baseurl+"user/getexamsstatusbybid",data:{'bid':bid},success:function(data){
    	$("#loadhere").html(data);
    	$("#loading").css("display","none");
    }}); 
}

function viewReport(eid)
{
	$("#loading").css("display","block");
	$.post({url:baseurl+"user/getsmsreportbyeid",data:{'eid':eid},success:function(data){
    	openModal({title:'Status',content:data,width:'1200px'});
    	$("#loading").css("display","none");
    }}); 
}

</script>