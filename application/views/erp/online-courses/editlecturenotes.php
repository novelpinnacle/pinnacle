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
<script>
var batchobj={};
var subjectobj={};

var baseurl="<?=base_url()?>";

function loadBatches(cid,ele){
	$.post({url:baseurl+'erp/getbatchesbycourse',data:{'cid':cid},success:function(data){
		ele.innerHTML="<option value=''>Select Batch</option>"+data;
	}});
}

function loadSubjects(bid,subjectid,co,ba){
	cid=co.value;
	$.post({url:baseurl+'erp/getsubjectsbycb',data:{'cid':cid,'bid':bid},success:function(data){
		subjectid.innerHTML="<option value=''>Select Subject</option>"+data;
	}});
}

</script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.css" />
<div id="content">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Edit Lecture Notes</h4>
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>erp/updatevideolecture">
				<input type="hidden" name="id" value="<?=$data->id?>">
					<div class="row">
						<div class="col-sm-6 wp pr">
							<div class="form-group">
								<label>Title</label>
								<input type="text" name="title" value="<?=$data->title?>" class="w3-input w3-border">
							</div>
						</div>
						<div class="col-sm-2 wp">
							<div class="form-group">
								<label style="margin-bottom:8px">Downloadable?</label><br>
								<label><input type="radio" <?=$data->downloadable?'checked':''?> name="downloadable" value="1"> Yes</label>
								&nbsp;&nbsp;
								<label><input type="radio" <?=$data->downloadable?'':'checked'?> name="downloadable" value="0"> No</label>
							</div>
						</div>
						<div class="col-sm-2 wp">
							<div class="form-group">
								<label>&nbsp; </label><br>
								<input type="submit" value="Update" class="btn btn-default btn-sm" >
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div style="height:20px"></div>
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Update Course,Batch,Subject or From and To time</h4>
			</div>
			<div class="mycardbody">
			<?php $i=0;
			foreach ($lecturedata as $v) { ?>
			
				<div class="row">
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Course <span>*</span></label>
							<select id="e_course_<?=$v->id?>" name="courseid[]" class="w3-input w3-border course " onchange="loadBatches(this.value,e_batch_<?=$v->id?>)">
							<option value="">Select Course</option>
							<?php 
							foreach ($courses as $c) {
								echo "<option ".($c->id==$v->courseid?'selected':'')." value='$c->id'>$c->course</option>";
							}
							?>
							</select>
							
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
						<label class="w3-text-grey">Select Batch</label>
							<select id="e_batch_<?=$v->id?>" name="batchid[]" class="w3-input w3-border batch" onchange="loadSubjects(this.value,e_subject_<?=$v->id?>,<?='e_course_'.$v->id?>,e_batch_<?=$v->id?>)">
								<option value="">Select Batch</option>
							</select>
						</div>	
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
						<label class="w3-text-grey">Subject Name <span>*</span></label>
							<select id="e_subject_<?=$v->id?>" name="subjectid[]" class="w3-input w3-border subject" required>
							<option value="">Select Subject</option>
							</select>
						</div>
					</div>
					<script>
						loadBatches(<?=$v->courseid?>,e_batch_<?=$v->id?>);
						loadSubjects(<?=$v->batchid?>,e_subject_<?=$v->id?>,e_course_<?=$v->id?>,e_batch_<?=$v->id?>);
						batchobj["e_batch_<?=$v->id?>"]=<?=$v->batchid?>;
						subjectobj["e_subject_<?=$v->id?>"]=<?=$v->subjectid?>;
					</script>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">From <span>*</span></label>
							<input type="text" id="e_fromtime_<?=$v->id?>" data-field="datetime" autocomplete="off" data-format="yyyy-mm-dd hh:mm:ss" class="w3-input w3-border" value="<?=$v->fromtime?>" required>
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label class="w3-text-grey">To <span>*</span></label>
							<input type="text" id="e_totime_<?=$v->id?>" data-field="datetime" autocomplete="off" data-format="yyyy-mm-dd hh:mm:ss" class="w3-input w3-border" value="<?=$v->totime?>" required>
						</div>
					</div>
					<div class="col-sm-1 wp pl" style="position:relative;">
						<label> &nbsp;	</label><br>
						<input type=button onclick="updateEntry(<?=$v->id?>,e_course_<?=$v->id?>.value,e_batch_<?=$v->id?>.value,e_subject_<?=$v->id?>.value,e_fromtime_<?=$v->id?>.value,e_totime_<?=$v->id?>.value)" value=Update class="btn btn-default btn-sm">
					</div>
					
				</div>

			<?php $i++; }
			?>
			</div>
		</div>
		<div style="height:20px"></div>
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Add More Courses In Lecture Notes</h4>
			</div>
			<div class="mycardbody">
				<form id="form2" action="<?=base_url()?>erp/addCBSInLectures">
				<input type="hidden" name="id" value="<?=$data->id?>" >
					<div id="base">
					<div class="row">
						<div class="col-sm-2 wp pr">
							<div class='form-group'>
								<label class="w3-text-grey">Select Course <span>*</span></label>
								<select id="course" name="courseid[]" class="w3-input w3-border course" onchange="loadBatches(this.value,batch)">
								<option value="">Select Course</option>
								<?php 
								foreach ($courses as $v) {
									echo "<option value='$v->id'>$v->course</option>";
								}
								?>
								</select>
							</div>
						</div>
						<div class="col-sm-2 wp pr">
							<div class='form-group'>
							<label class="w3-text-grey">Select Batch</label>
								<select id="batch" name="batchid[]" class="w3-input w3-border batch" onchange="loadSubjects(this.value,subject,course,batch)">
									<option value="">Select Batch</option>
								</select>
							</div>	
						</div>
						<div class="col-sm-2 wp pr">
							<div class='form-group'>
							<label class="w3-text-grey">Subject Name <span>*</span></label>
								<select id="subject" name="subjectid[]" class="w3-input w3-border subject" required>
								<option value="">Select Subject</option>
								</select>
							</div>
						</div>
						<div class='col-sm-2 wp pr'>
							<div class='form-group'>
								<label class="w3-text-grey">From <span>*</span></label>
								<input type="text" name="fromtime[]" data-field="datetime" autocomplete="off" data-format="yyyy-mm-dd hh:mm:ss" class="w3-input w3-border" required>
							</div>
						</div>
						<div class='col-sm-2 wp pr'>
							<div class='form-group'>
								<label class="w3-text-grey">To <span>*</span></label>
								<input type="text" name="totime[]" data-field="datetime" autocomplete="off" data-format="yyyy-mm-dd hh:mm:ss" class="w3-input w3-border" required>
							</div>
						</div>
						<div class="col-sm-1 wp pl" style="position:relative;">
						<i class="fa fa-plus-square" style="font-size:30px;position:absolute;top:27px" onclick="addMore()"></i>
						<i></i>
						</div>
						
					</div>
					</div>
					<div id="sample"></div>
					<div class="form-group">
						<input type="submit" value="Add" class="btn btn-default btn-sm" >
					</div>
				</form>
			</div>
		</div>
		<div style="height:20px"></div>
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Update Notes File</h4>
			</div>
			<div class="mycardbody">
				<form id="form3" action="<?=base_url()?>erp/updateLectureFile">
					<input type="hidden" name="id" value="<?=$data->id?>" >

						<div class="row">
							<div class="col-sm-3 wp pr">
								<div class="form-group">
									<label>Choose File</label>
									<input type="file" id="imagefile" onchange="$('#showselected').html('Selected File:<b> '+this.files[0].name+'</b>')" name="file" style="position:absolute;left:-2000px">
										<input type="button" value="Choose File" onclick="imagefile.click()" class="btn btn-default btn-sm btn-block">
								</div>
							</div>
							<div class="col-sm-3 wp pr">
								<div class="form-group">
								<label>&nbsp; </label><br>
									<input type="submit" value="Submit" class="btn btn-default btn-sm btn-block">
								</div>
							</div>
							<div class="col-sm-6 wp pr"> </div>
							<div class="col-sm-12 wp pr">
								<div id="showselected"></div>
								<div id="myProgress">
									<div id="myBar">10%</div>
								</div>
								<h4 id="progressstatus"></h4>
							</div>
						</div>


				</form>
			</div>
		</div>
</div>
<div id="dtBox"></div>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.js"></script>
<script>
$(document).ready(function()
		{
			$("#dtBox").DateTimePicker();
		});
function updateEntry(id,c,b,s,f,t){	
	$.post({url:baseurl+'erp/updatelecturecbsft',dataType:'json',data:{'id':id,'cid':c,'bid':b,'sid':s,'fromtime':f,'totime':t},success:function(data){
		openModal({title:'Status',content:data.message});
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
	
$('#form2').submit(function(evt) {
        evt.preventDefault();
        $("#form2 input[type=submit]").attr("disabled",true);
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
	         $("#form2 input[type=submit]").attr("disabled",false);
	        	openModal({title:'Status',content:data.message});
	         }
       });
  });



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
div.innerHTML=div.innerHTML.replace("<i></i>","<i class='fa fa-minus-square' style='font-size:30px;position:absolute;top:27px;left:40px'"+
				" onclick=this.parentElement.parentElement.innerHTML=''></i>");
sample.appendChild(div);
}
	
$('#form3').submit(function(evt) {
	    evt.preventDefault();
	    $("#form3 input[type=submit]").attr("disabled",true);
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
	$("#form3 input[type=submit]").attr("disabled",false);
	openModal({title:'Status',content:JSON.parse(event.target.responseText).message});
}

function errorHandler(event){
	openModal({title:'Status',content:"Error Occured"});
}
function abortHandler(event){
	openModal({title:'Status',content:"Cancelled Or Aborted"});
}

setTimeout(function(){
	for(let o in batchobj){
		document.getElementById(o).value=batchobj[o];
	}	
	for(let o in subjectobj){
		document.getElementById(o).value=subjectobj[o];
	}		
},1000);

</script>