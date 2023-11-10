<style>
label span{
	color:#FF5733;	
}
.mycardheader button{
		position: absolute;
		right: 10px;
		top:11px;
}
.mycard{
	margin-bottom: 50px;
}

</style>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.css" />
<div id="content">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Upload Video Lecture</h4>
			</div>
			<div class="mycardbody">
			
				<form id="form" action="<?=base_url()?>erp/savevideolecture" method="post" autocomplete="off">
					<div class="row">
						<div class='col-sm-6 wp pr'>
							<div class='form-group'>
								<label class="w3-text-grey">Video Title <span>*</span></label>
								<input type="text" name="title" data-title class="w3-input w3-border" required>
							</div>
						</div>
						<div class='col-sm-6 wp pr'>
							<div class='form-group'>
								<label class="w3-text-grey">Video ID <span>*</span></label>
								<input type="text" name="videoid" data-vid class="w3-input w3-border" required>
							</div>
						</div>
						
					</div>
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
								<input type="text" name="fromtime[]" data-field="datetime"  data-format="yyyy-mm-dd hh:mm:ss" class="w3-input w3-border" required>
							</div>
						</div>
						<div class='col-sm-2 wp pr'>
							<div class='form-group'>
								<label class="w3-text-grey">To <span>*</span></label>
								<input type="text" name="totime[]" data-field="datetime"  data-format="yyyy-mm-dd hh:mm:ss" class="w3-input w3-border" required>
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
								<input type="submit" value="Submit" class="btn btn-default">
							</div>
						</div>	
					</div>
				</form>
			</div>
		</div>

		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Active Videos</h4>
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
								<button class="btn btn-default btn-sm" onclick="getRecords(course2.value,batch2.value,subject2.value)"><i class="fa fa-search"></i> Search</button>
							</div>
						</div>
					</div>
				<div class="table-wrapper" style="max-height:30vh">
					<table class="sc-table load" id="setvideolecture">
						
					</table>
				</div>
			</div>
		</div>
</div>


<div class="modal" id="lectureModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title" id="lecturetitle"></h4>
        </div>
        <div class="modal-body">
     	 	<iframe id="lectureIframe" style="width:100%;height:400px" frameborder="0"></iframe>   
        </div>
      </div>
    </div>
</div>

<div id="dtBox"></div>

<script src="<?=base_url()?>js/erp-add-common.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.js"></script>
<script>
$(document).ready(function()
		{
			$("#dtBox").DateTimePicker();
		});

function deleteVideo(id,ele){
	$.post({url:baseurl+'erp/deletevideo',data:{'id':id},success:function(data){
		openModal({title:'Status',content:JSON.parse(data).message});
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}

function deleteCBS(id,ele){
	$.post({url:baseurl+'erp/deletevideocbs',data:{'id':id},success:function(data){
		openModal({title:'Status',content:JSON.parse(data).message});
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}

var baseurl="<?=base_url()?>";

function loadBatches(cid,ele){
$.post({url:baseurl+'erp/getbatchesbycourse',data:{'cid':cid},success:function(data){
	ele.innerHTML="<option value=''>Select Batch</option>"+data;
}});
}

function loadSubjects(bid,subjectid,co,ba){
	cid=co.value;
	bid=ba.value;
	$.post({url:baseurl+'erp/getsubjectsbycb',data:{'cid':cid,'bid':bid},success:function(data){
		subjectid.innerHTML="<option value=''>Select Subject</option>"+data;
	}});
}

function getRecords(cid,bid,sid){
	$("#loading").css("display","block");
	$.post({url:baseurl+'erp/getlecturesbycbs/video',data:{'cid':cid,'bid':bid,'sid':sid},success:function(data){
		setvideolecture.innerHTML=data;
		$("#loading").css("display","none");
	}});
}

function showLecture(src,title){
	lecturetitle.innerHTML=atob(title);
	lectureIframe.src="https://www.youtube.com/embed/"+src;
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