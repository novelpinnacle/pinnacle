<style>
.sc-table th,.sc-table td{

}
</style>
<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Search Marks</h4>
			</div>
			<div class="mycardbody">
				<form id="form" method="post">
					<div class='row'>
						<div class='col-sm-3 wp'>
							<label>Select Exam</label>
							<select class='w3-input w3-border' name='eid' id='examid'>
								<option value="">Select Exam</option>
								<?php
								foreach ($exams as $v) {
									echo "<option value='$v->id'>$v->examname</option>";
								}
								 ?>
							</select>
						</div>
						<div class="col-sm-3 wp pl">
						<label>&nbsp; </label><br>
						<input type="button" value="Search Marks" onclick="loadExamMarks()" class='fancy-btn small-btn' >
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

function loadExamMarks(){
		if(examid.value==""){loadhere.innerHTML=""; return;}
$.post({url:baseurl+"teacher/getexammarks",data:$("#form").serialize(),success:function(data){
	loadhere.innerHTML=data;
}}); 
}
function updateMarks(mid,val,col){
$.post({url:baseurl+"teacher/updatemarks",data:{'mid':mid,'val':val,'col':col},success:function(data){
	
}}); 
}

</script>