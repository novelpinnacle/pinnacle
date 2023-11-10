<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Edit Homework (Update Batch,Subject or Chapter)</h4>
		</div>
		<div class="mycardbody">
			<form id="form" action="<?=base_url()?>teacher/updatehomework">
				<input type="hidden" name="homeworkid" value="<?=$hw->id?>" >
				<div class="row">
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Select Batch</label>
							<select id="batch" name="batchid" onchange="loadSubjects(this.value)" class="w3-input w3-border batch">
								<option value="">Select Batch</option>
								<?php
								foreach ($batches as $v) {
									if($v->id==$hw->batchid){$s="selected";}else{$s='';}
									echo "<option $s value='$v->id'>$v->batch</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Select Subject</label>
							<select id="subject" name="subjectid" onchange="loadChapters(this.value)" class="w3-input w3-border subject">
								<option value="">Select Subject</option>
							</select>
						</div>
					</div>
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Chapter</label>
							<select id="chapter" name="chapterid" class="w3-input w3-border" >
								<option value="">Select Chapter</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2 wp pl">
						<div class="form-group">
							<label> &nbsp;</label><br>
							<input type="submit" class="btn btn-default btn-sm" value="Update" >
						</div>
					</div>
					
				</div>
			</form>
		</div>
	</div>
	<div style="height:20px"></div>
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Edit Homework (Add More Lectures and Exercises)</h4>
		</div>
		<div class="mycardbody">
			<form id="moreform" action="<?=base_url()?>teacher/addmoreinhomework">
				<input type="hidden" id="hwid" name="homeworkid" value="<?=$hw->id?>">
				<div class="row w3-border itm" id="form_" style="margin-bottom:10px">
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Lecture No.</label>
							<input type="text" name="lectureno" class="w3-input w3-border lec" >
						</div>
					</div>
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Excercise</label>
							<input type="text" name="exercise[]" class="w3-input w3-border" >
						</div>
					</div>
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Question/Sections</label>
							<input type="text" name="questions[]" class="w3-input w3-border" >
						</div>
					</div>
					<div class="col-sm-3 col-xs-2 wp pl">
						<label> &nbsp;</label><br>
						<button type="button" class='btn btn-default btn-sm' onclick="addMoreExercise(this.parentElement.parentElement)"> <i class='fa fa-plus-square'></i> Exercise</button>
						<button type="button" class='btn btn-default btn-sm' onclick="addMore()"> <i class='fa fa-plus-square'></i> Lecture</button>
					</div>
					<div class="addInner" style="clear:both"></div>
				</div>
				<div id="sample"></div>
				<div class='form-group'>
					<input type="submit" value="Submit" class='w3-btn b-primary btn-sm' >
				</div>
			</form>
		</div>
	</div>

</div>

<script>
var baseurl="<?=base_url()?>";

$('#form').submit(function(evt) {
    evt.preventDefault();
    $("#loading").show();
    var formData = new FormData(this);
    $.ajax({
    type: 'POST',
    url: $(this).attr('action'),
    data:formData,
    dataType:'json',
    contentType: false,
    processData: false,
    success: function(data) {
    if(data.status){
    	
    }
    openModal({title:'Status',content:data.message});
    $("#loading").hide();
    }
   });
  });

function loadSubjects(bid){
	if(bid==""){subject.innerHTML=""; return;}
	$.post({url:baseurl+"teacher/getassignedsubjects",data:{'bid':bid},success:function(data){
		subject.innerHTML="<option value=''>Select Subject</option>"+data;
		subject.value="<?=$hw->subjectid?>";
	}}); 
}
function loadChapters(sid){
	if(sid==""){chapter.innerHTML=""; return;}
	$.post({url:baseurl+"teacher/getchaptersbysubjectid",data:{'subid':sid},success:function(data){
		chapter.innerHTML=data;
		chapter.value="<?=$hw->chapterid?>";
	}}); 
}

function getData(){
	data=[];
	forms=document.querySelectorAll(".itm");
	for(let i=0;i<forms.length;i++){
		 data.push($("#"+forms[i].getAttribute("id")+" :input").serialize());
	}
	return data;
}

$('#moreform').submit(function(evt) {
    evt.preventDefault();
    $("#loading").show();
    var formData = new FormData();
    j=0;
    for(let fd of getData()){
    	formData.append("data_"+j,fd.toString());
    	j++;
    }
    formData.append("count",getData().length);
    formData.append("homeworkid",hwid.value);
    $.ajax({
	    type: 'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    dataType:'json',
	    contentType: false,
	    processData: false,
	    success: function(data) {
	    if(data.status){
	    	$("#moreform").trigger("reset");
	    }
	    openModal({title:'Status',content:data.message});
	    $("#loading").hide();
	    }
   });
  });

n=1;
function addMore(){
	idd="id_"+n;
	n++;
	var div=document.createElement("div");
	div.setAttribute("id",idd);
	var rand=Math.floor(Math.random() * 100000);

	var lec=document.querySelectorAll(".lec");
	var lastLec=parseInt(lec[lec.length-1].value)+1;

	str='<div class="row w3-border itm" id="form_'+rand+'" style="margin-bottom:10px">'+
			'<div class="col-sm-3 wp pl">'+
				'<div class="form-group">'+
					'<label>Lecture No.</label>'+
					'<input type="text" value="'+lastLec+'" name="lectureno" class="w3-input w3-border lec" >'+
				'</div>'+
			'</div>'+
			'<div class="col-sm-3 wp pl">'+
				'<div class="form-group">'+
					'<label>Excercise</label>'+
					'<input type="text" name="exercise[]" class="w3-input w3-border" >'+
				'</div>'+
			'</div>'+
			'<div class="col-sm-3 wp pl">'+
				'<div class="form-group">'+
					'<label>Question/Sections</label>'+
					'<input type="text" name="questions[]" class="w3-input w3-border" >'+
				'</div>'+
			'</div>'+
			'<div class="col-sm-3 col-xs-2 wp pl">'+
				'<label> &nbsp;</label><br>'+
				'<button type=button class="btn btn-default btn-sm" onclick="addMoreExercise(this.parentElement.parentElement)"><i class="fa fa-plus-square"></i> Exercise</button> '+
				'<button type=button class="btn btn-default btn-sm" onclick="addMore()"><i class="fa fa-plus-square"></i> Lecture</button> <button type=button class="btn btn-default btn-sm" onclick="document.querySelector('+"'#"+ idd+"'"+ ').remove()"> <i class="fa fa-minus-square"></i> </button>'+
			'</div>'+
			'<div class="addInner" style="clear:both"></div>'+
		'</div>';
	div.innerHTML=str;
	sample.appendChild(div);
}

var i=1;
function addMoreExercise(ele){
	var addDiv=ele.getElementsByClassName("addInner")[0];
	var div=document.createElement("div");
	var id="id_"+i;
	div.id=id;
	i++;
	div.innerHTML='<div class="row" style="clear:both">'+
	'<div class="col-sm-3 wp pl"></div>'+
	'<div class="col-sm-3 wp pl">'+
		'<div class="form-group">'+
		'<label>Excercise</label>'+
			'<input type="text" name="exercise[]" class="w3-input w3-border" >'+
		'</div>'+
	'</div>'+
	'<div class="col-sm-3 wp pl">'+
		'<div class="form-group">'+
			'<label>Question/Sections</label>'+
			'<input type="text" name="questions[]" class="w3-input w3-border" >'+
		'</div>'+
	'</div>'+
	'<div class="col-sm-3 col-xs-2 wp pl">'+
		'<label> &nbsp;</label><br>'+
		'<button type=button class="btn btn-default btn-sm" onclick="addMoreExercise(this.parentElement.parentElement.parentElement.parentElement.parentElement)"><i class="fa fa-plus-square"></i> Excercise</button> <button type=button class="btn btn-default btn-sm" onclick="(document.querySelector('+"'"+'#'+id+''+"'"+').remove())"> <i class="fa fa-minus-square"></i></button>'+
	'</div>'+
'</div>';
addDiv.appendChild(div);
}

loadSubjects(<?=$hw->batchid?>);
loadChapters(<?=$hw->subjectid?>);
</script>

