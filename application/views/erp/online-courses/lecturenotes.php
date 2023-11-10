<style>
label span{
	color:#FF5733;	
}
.mycardheader button{
	position: absolute;
	right: 10px;
	top:11px;
}

#myProgress {
  display: none;
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 0%;
  height: 8px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}

.mycard{
	margin-bottom: 10px;
}

td .sc-table tr:last-child td{
	border-bottom: none;
}

</style>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.css" />
<div id="content">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Upload Lecture Notes</h4>
				<!-- <button id="addbtn" onclick="addForm()" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add</button> -->
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>erp/uploadlecturenotes">
					<div class="row">
						<div class="col-sm-3 wp pr">
							<div class="form-group">
								<label>Title <span>*</span></label>
								<input type="text" name="title" class="w3-input w3-border" required>
							</div>
						</div>
						<div class="col-sm-3 wp">
							<div class="form-group">
								<label style="margin-bottom:8px">Downloadable?</label><br>
								<label><input type="radio" name="downloadable" value="1"> Yes</label>
								&nbsp;&nbsp;
								<label><input type="radio" name="downloadable" value="0"> No</label>
							</div>
						</div>
					</div>
					<div id="base">
					<div class="row">
						<div class="col-sm-2 wp pr">
							<div class='form-group'>
								<label class="w3-text-grey">Select Course <span>*</span></label>
								<select required name="courseid[]" id="course" class="w3-input w3-border course" onchange="loadBatches(this.value,batch)">
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
								<select name="batchid[]" id="batch" class="w3-input w3-border batch" onchange="loadSubjects(this.value,subject,course,batch)">
									<option value="">Select Batch</option>
								</select>
							</div>	
						</div>
						<div class="col-sm-2 wp pr">
							<div class='form-group'>
							<label class="w3-text-grey">Subject Name <span>*</span></label>
								<select  name="subjectid[]" id="subject" class="w3-input w3-border subject" required>
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

		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Active Notes</h4>
			</div>
			<div class="mycardbody">

				<div class="row">
						<div class="col-sm-3 wp pr">
							<div class='form-group'>
								<label class="w3-text-grey">Select Course</label>
								<select id="course2" name="courseid" class="w3-input w3-border course" onchange="loadBatches(this.value,batch2)">
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
							<label class="w3-text-grey">Select Batch</label>
								<select id="batch2" name="batch" class="w3-input w3-border batch" onchange="loadSubjects(this.value,subject2,course2,batch2)">
									<option value="">Select Batch</option>
								</select>
							</div>	
						</div>
						<div class="col-sm-3 wp pr">
							<div class='form-group'>
							<label class="w3-text-grey">Subject Name</label>
								<select id="subject2" name="subject" class="w3-input w3-border subject">
								<option value="">Select Subject</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3 wp">
							<div class="form-group">
								<label> &nbsp;</label><br>
								<button class="btn btn-default btn-sm" onclick="getRecords(course2.value,batch2.value,subject2.value)" ><i class='fa fa-search'></i> Search</button>
							</div>
						</div>
					</div>
				<div class="table-wrapper" style="max-height:34vh">
					<table class="sc-table load" id="loadhere">
						
					</table>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="modal" id="lectureModal" role="dialog">
    <div class="modal-dialog" style="width:1000px">
	      <div class="modal-content" >
		        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">×</button>
			          <h4 class="modal-title" id="lecturetitle"></h4>
		        </div>
		        <div class="modal-body">
		     	 	<iframe id="lectureIframe" style="width:100%;height:75vh" frameborder="0"></iframe>   
		        </div>
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
	if(JSON.parse(event.target.responseText).status)
		$(".sc-table.load").append(JSON.parse(event.target.responseText).data);
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

<script>
	var baseurl="<?=base_url()?>";
	function loadBatches(cid,ele){
		$.post({url:baseurl+'erp/getbatchesbycourse',data:{'cid':cid},success:function(data){
			ele.innerHTML="<option value=''>Select Batch</option>"+data;
		}});
	}

	function deleteCBS(id,ele){
		$.post({url:baseurl+'erp/deletevideocbs',data:{'id':id},success:function(data){
			openModal({title:'Status',content:JSON.parse(data).message});
			ele.parentElement.parentElement.style.display='none';
		}});
	}

	function loadSubjects(bid,subjectid,co,ba){
		cid=co.value;
		bid=ba.value;
		$.post({url:baseurl+'erp/getsubjectsbycb',data:{'cid':cid,'bid':bid},success:function(data){
			subjectid.innerHTML="<option value=''>Select Subject</option>"+data;
		}});
	}
	/*Actually it is delete Note*/
	function deleteVideo(id,ele){
		$.post({url:baseurl+'erp/deletenote',data:{'id':id},success:function(data){
			openModal({title:'Status',content:JSON.parse(data).message});
				if(JSON.parse(data).status){
					ele.parentElement.parentElement.style.display='none';
				}
				else{
					openModal({title:'Status',content:JSON.parse(data).message});
				}
		}});
	}

	function getRecords(cid,bid,sid){
		$("#loading").css("display","block");
		$.post({url:baseurl+'erp/getlecturesbycbs/pdf',data:{'cid':cid,'bid':bid,'sid':sid},success:function(data){
			loadhere.innerHTML=data;
			$("#loading").css("display","none");
		}});
	}

	function showLecture(src,title,dw){
		lecturetitle.innerHTML=atob(title);
		lectureIframe.src="<?=base_url()?>pdf/web/viewer.html?file="+"<?=base_url()?>"+src+"&download="+(dw==1?'true':'false');
		$("#lectureModal").modal();
	}

	function addMore(){
		var div=document.createElement("div");
		var rand=Math.floor(Math.random() * 1000000);
		str=base.innerHTML.replace('id="batch"','id="BID'+rand+'"');
		str=str.replace('id="subject"','id="SID'+rand+'"');
		str=str.replace('id="course"','id="CID'+rand+'"');
		str=str.replace('onchange="loadBatches(this.value,batch)"','onchange="loadBatches(this.value,'+"BID"+rand+')"');
		str=str.replace('onchange="loadSubjects(this.value,subject,course,batch)"','onchange="loadSubjects(this.value,'+"SID"+rand+','+"CID"+rand+','+"BID"+rand+')"');
		div.innerHTML=str;
		div.innerHTML=div.innerHTML.replace("<i></i>","<i class='fa fa-minus-square' style='font-size:30px;position:absolute;top:27px;left:40px'"+
						" onclick=this.parentElement.parentElement.innerHTML=''></i>");
		sample.appendChild(div);
	}

</script>