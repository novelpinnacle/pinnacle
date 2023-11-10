<style>
	.fa-minus-square,.fa-plus-square{
		font-size: 20px;
		margin-top: 5px;
		margin-right: 4px;
	}
</style>
<div id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 wp">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Add New Subjects</h4>
					</div>
					<div class="mycardbody" style=''>
						<form id="form" action="<?=base_url()?>teacher/saveexamsubjects" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Select Exam</label>
								<select name="eid" class="w3-input w3-border" required onchange="loadSubjects(this.value)">
								<option value="">Select Exam</option>
								<?php 
								foreach ($exams as $v) {
									echo "<option value='$v->id'>$v->examname</option>";
								}
								?>
								</select>
							</div>
						<div id="base">
						<div class="row">
							<div class="col-sm-3 wp">
							<div class="form-group">
							<label>Select Subjects</label>
								<select id="subject" name="sid[]" class="w3-input w3-border subjects">
								<option value="">Select Subjects</option>
								</select>
							</div>
							</div>
							<div class="col-sm-3 wp pl">
								<div class="form-group">
									<label>Enter Pass Marks</label>
									<input type='text' name="passmarks[]" class="w3-input w3-border batch">
								</div>
							</div>
							<div class="col-sm-3 wp pl">
								<div class="form-group">
									<label>Enter Total Marks</label>
									<input type='text' name="totalmarks[]" class="w3-input w3-border batch">
								</div>
							</div>
							<div class="col-sm-1 col-xs-2 wp pl">
								<label> &nbsp;</label><br>
								<i class="fa fa-plus-square" onclick="addMore()"></i><p></p>
							</div>
							
						</div>
					</div>
					<div id="sample"></div>


							<div class="form-group">
							<input type="submit" value="Add Subjects" class='fancy-btn small-btn' >
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

n=1;
function addMore(){
idd="id_"+n;
n++;
var div=document.createElement("div");
div.setAttribute("id",idd);
ele=document.querySelectorAll(".subjects");
lastbatchid=ele[ele.length-1].getAttribute("id");

var rand=Math.floor(Math.random() * 100000);

str=base.innerHTML.replace('id="subject"','id="'+lastbatchid+rand+'"');

str=str.replace("<p></p>","<i class='fa fa-minus-square' onclick=\"sample.removeChild(document.getElementById('"+idd+"'))\"></i>");

div.innerHTML=str;
sample.appendChild(div);
}



$('#form').submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data:formData,
                dataType:'json',
                contentType: false,
                processData: false,
                success: function(data) {
                if(data.status=="ok"){
                $("#form").trigger("reset");
                }
                $("#alertDialog").html(data.message);
                $("#alertDialog").dialog({modal:true});
                }
               });
  });

function loadSubjects(eid){
if(eid==""){subject.innerHTML="<option value=''>Select Subject</option>"; return;}
$.post({url:baseurl+"teacher/getsubjectsforexambycb",data:{'eid':eid},success:function(data){
	subject.innerHTML=data;
}}); 
}


</script>