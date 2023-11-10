<style>
#myProgress {
  display: none;
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 10%;
  height: 30px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}

</style>
<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">New Assignment</h4>
			</div>
			<div class="mycardbody">
			<form id="form" action="<?=base_url()?>user/uploadassignment">
				<div class='form-group'>
					<label>Enter Title</label>
					<input type="text" name="title" class='w3-input w3-border'>
				</div>

				<div id="base">
				<div class="row">

				<div class="col-sm-3 wp">

				<div class="form-group">
				<label>Select Course</label>
					<select id="course" class="w3-input w3-border course" name="course[]" onchange="loadBatches(this.value,batch)">
					<option value="">Select Course</option>
						<?php 
						foreach ($courses as $v) {
							echo "<option value='$v->id'>$v->course</option>";
						}
						?>
					</select>
				</div>
				</div>
				<div class="col-sm-3 wp pl">
				<div class="form-group">
					<label>Select Batch</label>
					<select id="batch" class="w3-border w3-input batch" name="batch[]" onchange="loadSubjects(this.value,subject,course,batch)">
					<option value="">Select Batch</option>
					</select>
				</div>
				</div>

				<div class="col-sm-3 wp pl">
				<div class="form-group">
				<label>Select Subject</label>
				<select class="w3-border w3-input subject" name='subject[]' id='subject'>
					<option value="">Select Subject</option>
				</select>
				</div>
				</div>
				<div class="col-sm-1 wp pl" style="position:relative;">
				<i class="fa fa-plus-square" style="font-size:30px;position:absolute;top:27px" onclick="addMore()"></i>
				</div>
				</div>
				</div>
				<div id="sample" ></div>

				<div class='form-group'>
				<div class="row">
					<div class='col-sm-3 wp pr'>
						<label>Choose File</label>
						<input type="file" name="assignment" style='position: absolute;left:-2000px' id="tfile" onchange="$('#showselected').html('<b>Selected File:</b> '+this.files[0].name)" >

						<input type="button" class='fancy-btn small-btn btn-block' value="Choose File"  onclick="document.getElementById('tfile').click()" >
					</div>
						<div class='col-sm-3 wp'>
							<label>&nbsp; </label><br>
							<input type='submit' class='fancy-btn small-btn btn-block' value="Upload">
						</div>
				</div>
				</div>
				<div class="form-group">
					<div id="showselected"></div>
				</div>
				<div id="myProgress">
					<div id="myBar">10%</div>
				</div>
				<h4 id="progressstatus"></h4>

			</form>
			</div>
		</div>
	</div>
</div>



<script >

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

}

function addMore(){
var div=document.createElement("div");

ele=document.querySelectorAll(".batch");
lastbatchid=ele[ele.length-1].getAttribute("id");

ele2=document.querySelectorAll(".subject");
lastsubjectid=ele2[ele2.length-1].getAttribute("id");

ele3=document.querySelectorAll(".course");
lastcourseid=ele3[ele3.length-1].getAttribute("id");

var rand=Math.floor(Math.random() * 100000);

str=base.innerHTML.replace('id="batch"','id="'+lastbatchid+rand+'"');
str=str.replace('id="subject"','id="'+lastsubjectid+rand+'"');
str=str.replace('id="course"','id="'+lastcourseid+rand+'"');

str=str.replace('onchange="loadBatches(this.value,batch)"','onchange="loadBatches(this.value,'+lastbatchid+rand+')"');
str=str.replace('onchange="loadSubjects(this.value,subject,course,batch)"','onchange="loadSubjects(this.value,'+lastsubjectid+rand+','+lastcourseid+rand+','+lastbatchid+rand+')"');


div.innerHTML=str;
sample.appendChild(div);

}
$('#form').submit(function(evt) {
	    evt.preventDefault();
	    $("#form input[type=submit]").attr("disabled",true);
		var formdata = new FormData(this);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", $(this).attr('action'));
		ajax.send(formdata);
  });

function progressHandler(event){
	$("#myProgress").css("display","block");
	var percent = (event.loaded / event.total) * 100;
	$("#myBar").css("width",Math.round(percent)+"%");
	$("#myBar").text(Math.round(percent)+"%");
	$("#progressstatus").html("Uploaded "+event.loaded+" bytes of "+event.total);
}

function completeHandler(event){
	$("#myBar").css("width","0%");
	$("#myProgress").css("display","none");
	$("#progressstatus").html("");
	$("#showselected").html("");
	$("#form input[type=submit]").attr("disabled",false);
	openModal({title:'Status',content:JSON.parse(event.target.responseText).message});
}

function errorHandler(event){
	openModal({title:'Status',content:"Error Occured"});
}
function abortHandler(event){
	openModal({title:'Status',content:"Cancelled Or Aborted"});
}

</script>