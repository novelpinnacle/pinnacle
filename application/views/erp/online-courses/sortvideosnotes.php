<style>
 #sortable {
 	 list-style-type: none; 
 	 margin: 0;
 	 padding: 0;
 	 width: 60%; 
 }
 #sortable li { 
  	margin: 0 3px 3px 3px; 
  	padding: 3px; padding-left: 1.5em; 
  	font-size: 1em;  
  	position: relative;
 }
  #sortable li span { position: absolute; margin-left: -1.3em;top:12px; }
  label span{
  	color:red;
  }
  </style>

<div id="content">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Sort Videos/Notes</h4>
			</div>
			<div class="mycardbody">
				<div class="row">
					<div class="col-sm-3 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Course <span>*</span></label>
							<select name="courseid" class="w3-input w3-border" id="cid" onchange="loadBatches(this.value)" required>
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
						<label class="w3-text-grey">Select Batch <span>*</span></label>
							<select name="batchid" class="w3-input w3-border" id="bid"  onchange="loadSubjects()" required>
								<option value="">Select Batch</option>
							</select>
						</div>	
					</div>
					<div class="col-sm-3 wp pr">
							<div class='form-group'>
							<label class="w3-text-grey">Subject Name <span>*</span></label>
								<select  name="subjectid" class="w3-input w3-border" id="subject" required>
									<option value="">Select Subject</option>
								</select>
							</div>
						</div>
					<div class="col-sm-3 wp ">
						<div class="form-group">
							<label>&nbsp; </label><br>
							<button class="btn btn-default btn-sm" value="Load Records" onclick="loadData()" ><i class="fa fa-search"></i> Load Records</button>
						</div>
					</div>
				</div>

				<div id="showin" style="display:none">
					<h3>Sort Videos And Notes</h3>
					<ul id="sortable">
						
					</ul>
					<div style="height:10px"></div>
					<button class="btn btn-default" value="Submit" onclick="submitData()">Save</button>
				</div>

			</div>
		</div>
</div>

<script>
var baseurl="<?=base_url()?>";

function loadBatches(cid){
$.post({url:baseurl+'erp/getbatchesbycourse',data:{'cid':cid},success:function(data){
	$("#bid").html("<option value=''>Select Batch</option>"+data);
}});
}

function loadData(){
	let courseid=$("#cid").val();
	let batchid=$("#bid").val();	
	let subjectid=$("#subject").val();

	if(courseid=="" || batchid=="" || subjectid==""){
		openModal({title:'Alert',content:"<b class='w3-text-red'>Please Choose All Options</b>"});
		return;
	}

	showin.style.display="none";
	$.post({url:baseurl+'erp/getvideosnotes',data:{'cid':courseid,'bid':batchid,'subjectid':subjectid},success:function(data){
			if(JSON.parse(data).status==false){
				openModal({title:'Alert',content:JSON.parse(data).message});
				return;
			}
			var data=JSON.parse(data).data;
			var ele=document.getElementById("sortable");
			ele.innerHTML="";
			if(data.length>0){
				showin.style.display="block";
			}else{
				showin.style.display="none";
			}
			for(let i=0;i<data.length;i++){
				icon="";
				if(data[i].type=="pdf"){
					icon="<i class='fa fa-file-pdf-o'></i>";
				}
				if(data[i].type=="video"){
					icon="<i class='fa fa-file-video-o'></i>";
				}
				ele.innerHTML+="<li class='ui-state-default' data-id='"+data[i].id+"'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>"+data[i].title+" "+icon+"</li>";
			}
	}});
}

function loadSubjects(){
	courseid=document.querySelector("#cid").value;
	batchid=document.querySelector("#bid").value;
	$.post({url:baseurl+'erp/getsubjectsbycb',data:{'cid':courseid,'bid':batchid},success:function(data){
		$("#subject").html("<option value=''>Select Subject</option>"+data);
	}});
}

function submitData(){
	var eles=document.querySelectorAll("#sortable li");
	var arr=[];
	for(var i=0;i<eles.length;i++){
		arr.push(eles[i].getAttribute("data-id")+"-"+(i+1));
	}
	$.post({url:baseurl+'erp/sortVideoNotes',data:{'arr':arr+""},success:function(data){
		openModal({title:'Status',content:JSON.parse(data).message});
	}});
}

</script>

<script>
$( function() {
	$( "#sortable" ).sortable();
	$( "#sortable" ).disableSelection();
} );
</script>