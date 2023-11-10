<style>
	.chapters{
		padding:2px 10px;
		padding-right: 20px;
		border-radius: 4px;
		display: inline-block;
		margin:3px;
		position: relative;
		border:1px solid #ddd;
	}
	div>.fa{
		position: absolute;
		right:5px;
		top:8px;
	}
</style>
<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Add chapter in subject</h4>
		</div>
		<div class="mycardbody">
			<form id="form" action="<?=base_url()?>teacher/savechapter" method="post">
				<div class="row">
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Select Batch</label>
							<select id="batch" name="bid" onchange="loadSubjects(this.value,subject)" class="w3-input w3-border batch">
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
							<select id="subject" name="subjectid" class="w3-input w3-border subject">
								<option value="">Select Subject</option>
							</select>
						</div>
					</div>
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Enter Chapter</label>
							<input type="text" name="chapter[]" class="w3-input w3-border">
						</div>
					</div>
					<div class="col-sm-3 col-xs-2 wp pl">
						<label> &nbsp;</label><br>
						<button type="button" class='btn btn-default btn-sm' onclick="addMore()">
						 	<i class='fa fa-plus-square'></i> Chapters
						</button>
					</div>
				</div>
				<div id="addhere"></div>
				<div class="col-sm-3 wp pl">
					<div class="form-group">
						<input type="submit" class="btn btn-default btn-sm" value="Submit">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="mycard" style="margin-top:20px">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Active Chapters</h4>
		</div>
		<div class="mycardbody">
		<table class="sc-table">
			<tr><th>Course Batch</th><th>Subject</th><th>Chapter</th></tr>
			<?php
				foreach ($chapters as $v) {
					echo "<tr><td>$v->course - $v->batch</td><td>$v->subject</td><td>$v->chapter</td></tr>";
				}
			 ?>
		</table>
		</div>
	</div>
</div>

<script>
	var n=1;
	function addMore(){
		var ele=document.createElement("div");
		var id="id_"+Math.floor(Math.random() * 100000);
		ele.id=id;
		ele.innerHTML='<div class="row">'+
			'<div class="col-sm-3"></div>'+
			'<div class="col-sm-3"></div>'+
			'<div class="col-sm-3 wp pl"><div class="form-group"><label>Enter Chapter</label>'+	
			'<input type="text" name="chapter[]" class="w3-input w3-border"></div></div>'+
			'<div class="col-sm-3 wp pl">'+
			'<label> &nbsp;</label><br>'+
			'<button type="button" class="btn btn-default btn-sm" onclick="addMore()">'+
			 	'<i class="fa fa-plus-square"></i> Chapters'+
			'</button> <button type="button" class="btn btn-default btn-sm" onclick="document.getElementById('+"'"+id+"'"+').remove()">'+
			 	'<i class="fa fa-minus-square"></i>'+
			'</button></div>';
		addhere.appendChild(ele);							
	}

var baseurl="<?=base_url()?>";
function loadSubjects(bid,ele){
	if(bid==""){ele.innerHTML=""; return;}
	$.post({url:baseurl+"teacher/getassignedsubjects",data:{'bid':bid},success:function(data){
		ele.innerHTML="<option value=''>Select Subject</option>"+data;
	}}); 
}
function deleteChapter(id,ele){
	$("#loading").show();
	$.post({url:baseurl+'teacher/deletechapter',data:{'id':id},success:function(data){
		$("#loading").hide();
		if(JSON.parse(data).status){ ele.remove();}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}
</script>
<script src="<?=base_url()?>js/erp-add-common.js"></script>