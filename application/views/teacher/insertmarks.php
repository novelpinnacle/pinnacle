<style>
td .w3-input{
	display: inline-block;
	width: 33%;
}
td .fullwidth{
	width: 100%;
}
</style>
<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Insert Marks</h4>
			</div>
			<div class="mycardbody">
				<form id="form" method="post">
					<div class='row'>
						<div class='col-sm-3 wp'>
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
					<div class="col-sm-3 wp pl">
						<label>&nbsp; </label><br>
						<input type="button" value="Load Students" onclick="loadStudents()" class='fancy-btn small-btn' >
						</div>
					</div>
				</form>

				<div style="margin-top:30px;" class='table-wrapper' id="loadhere">
						
				</div>

			</div>
		</div>
	</div>
</div>

<script src="<?=base_url()?>js/validation.js"></script>
<script>
var baseurl="<?=base_url()?>";
function loadStudents(){
if(examid.value==""){return;}
$.post({url:baseurl+"teacher/getstudentsforexam",data:$("#form").serialize(),success:function(data){
	loadhere.innerHTML=data;
}}); 
}

function uploadMarks(){
if(!validateForm()){return;}
var eid=$("#examid").val();
var sid=$("#subject").val();
$("#examform input[type=button]").attr("disabled",true);
$.post({url:baseurl+"teacher/savemarks",cache:false,dataType: 'json',data:$("#examform").serialize()+"&eid="+eid+"&sid="+sid,success:function(data){
	if(data.status=="ok"){
   		$("#examform").trigger("reset");
   	}
	 $("#alertDialog").html(data.message);
     $("#alertDialog").dialog({modal:true});
     $("#examform input[type=button]").attr("disabled",false);
}}); 	
}

function toggleInput(classs,ele){
	$('.'+classs).prop('readonly', $(ele).prop('checked'));
	$('.'+classs).prop('required', !$(ele).prop('checked'));

	$('.'+classs).prop('value','');
	$('.'+classs).removeClass("w3-border-red");
}


</script>