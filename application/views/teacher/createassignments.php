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

.fa{
	margin-left: 5px;
	margin-top:4px;
	font-size: 1.4em;
}

</style>
<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">New Assignment</h4>
			</div>
			<div class="mycardbody">
			<form id="form" action="<?=base_url()?>teacher/uploadassignment">
				<div class='form-group'>
					<label>Enter Title</label>
					<input type="text" name="title" class='w3-input w3-border'>
				</div>

				<div id="base">
				<div class="row">

				<div class="col-sm-3 wp pl">
				<div class="form-group">
					<label>Select Batch</label>
					<select id="batch" class="w3-border w3-input batch" name="batch[]" onchange="loadSubjects(this.value,subject)">
					<option value="">Select Batch</option>
					<?php
					foreach ($batches as $v) {
						echo "<option value='$v->id'>$v->batch</option>";
					}
					?>
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
				<label>&nbsp; </label><br>
				<i class="fa fa-plus-square"  onclick="addMore()"></i><p></p>
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

function loadSubjects(bid,ele){
	if(bid==""){ele.innerHTML="<option value=''>Select Subject</option>"; return;}
	$.post({url:baseurl+"teacher/getassignedsubjects",data:{'bid':bid},success:function(data){
		ele.innerHTML=data;
	}}); 
}

n=1;
function addMore(){
	idd="id_"+n;
	n++;
	var div=document.createElement("div");
	div.setAttribute("id",idd);
	var rand=Math.floor(Math.random() * 100000);
	str=base.innerHTML.replace('id="subject"','id="rand'+rand+'"');
	str=str.replace('onchange="loadSubjects(this.value,subject)"','onchange="loadSubjects(this.value,rand'+rand+')"');
	str=str.replace("<p></p>","<i class='fa fa-minus-square' onclick=\"sample.removeChild(document.getElementById('"+idd+"'))\"></i>"); 
	div.innerHTML=str;
	sample.appendChild(div);

	$("#rand"+rand).html("<option value=''>Select Subject</option>");
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