<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Post New Home Work</h4>
		</div>
		<div class="mycardbody">
			<form id="form" action="<?=base_url()?>teacher/savehomework" method="post">
					<div id="bsc_base">
					<div class="row bscform" id="bscformid">
						<div class="col-sm-3 wp pl">
							<div class="form-group">
								<label>Select Batch</label>
								<select id="batch" name="batchid" onchange="loadSubjects(this.value,subject)" class="w3-input w3-border batch">
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
								<select id="subject" name="subjectid" onchange="loadChapters(this.value,chapter)" class="w3-input w3-border subject">
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
						<div class="col-sm-3 wp pl">
							<div class="form-group">
								<label>&nbsp; </label><br>
								<button type="button" class='btn btn-default btn-sm' onclick="addMoreBSC()"> <i class='fa fa-plus-square'></i></button>
							</div>
						</div>
					</div>
					</div>
					<div id="bsc"></div>
					<div id="base">
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

function loadChapters(sid,chap){
	if(sid==""){chap.innerHTML=""; return;}
	$.post({url:baseurl+"teacher/getchaptersbysubjectid",data:{'subid':sid},success:function(data){
		chap.innerHTML=data;
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

function getBSCData(){
	data=[];
	forms=document.querySelectorAll(".bscform");
	for(let i=0;i<forms.length;i++){
		 data.push($("#"+forms[i].getAttribute("id")+" :input").serialize());
	}
	return data;
}

$('#form').submit(function(evt) {
    evt.preventDefault();
    $("#loading").show();
    var formData = new FormData();
    j=0;
    for(let fd of getData()){
    	formData.append("data_"+j,fd.toString());
    	j++;
    }
    formData.append("count",getData().length);

    formData.append("bsc_count",getBSCData().length);
    k=0;
    for(let fd of getBSCData()){
    	formData.append("bscdata_"+k,fd.toString());
    	k++;
  //  		formData.append("batch",$("#batch").val());
		// formData.append("subject",$("#subject").val());
		// formData.append("chapter",$("#chapter").val()); 	
    }
   
    
    $.ajax({
	    type: 'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    dataType:'json',
	    contentType: false,
	    processData: false,
	    success: function(data) {
	    if(data.status){
	    	$("#form").trigger("reset");
	    }
	    openModal({title:'Status',content:data.message});
	    $("#loading").hide();
	    }
   });

  });

var baseurl="<?=base_url()?>";
function loadSubjects(bid,ele){
	if(bid==""){ele.innerHTML=""; return;}
	$.post({url:baseurl+"teacher/getassignedsubjects",data:{'bid':bid},success:function(data){
		ele.innerHTML="<option value=''>Select Subject</option>"+data;
	}}); 
}





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

nn=1;
function addMoreBSC(){
	var div=document.createElement("div");
	var idd="id_"+nn;
	nn++;
	div.id=idd;
	var bs=bsc_base.innerHTML;
	bs=bs.replace(`id="bscformid"`,`id="bscformid_${idd}"`);
	bs=bs.replace(`id="batch"`,`id=batch_${idd}`);
	bs=bs.replace(`id="subject"`,`id=subject_${idd}`);
	bs=bs.replace(`id="chapter"`,`id="chapter_${idd}"`);
	bs=bs.replace(`onchange="loadSubjects(this.value,subject)"`,`onchange="loadSubjects(this.value,subject_${idd})"`);
	bs=bs.replace(`onchange="loadChapters(this.value,chapter)"`,`onchange="loadChapters(this.value,chapter_${idd})"`);
	div.innerHTML=bs;
	bsc.appendChild(div);
}

</script>

