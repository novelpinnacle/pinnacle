<style>
	.more-plus{
		position:absolute;top:5px;right:20px;font-size:18px;cursor:pointer;
	}
	.more-minus{
		position:absolute;top:5px;right:0px;font-size:18px;cursor:pointer
	}
</style>
<div id="content">
		<div class="row">
			<div class="col-sm-3 wp pr">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Assign Subjects</h4>
					</div>
					<div class="mycardbody" style=''>
						<form id="form" action="<?=base_url()?>erp/saveassignsub" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Select Course</label>
								<select name="cid" class="w3-input w3-border" required id="cid" onchange="loadBatches(this.value)">
								<option value="">Select Course</option>
								<?php 
								foreach ($courses as $v) {
									echo "<option value='$v->id'>$v->course</option>";
								}
								?>
								</select>
							</div>
							<div class='form-group'>
							<label class="w3-text-grey">Select Batch</label>
								<select name="bid" class="w3-input w3-border" required id="batch" onchange="loadSubjects()">
									<option value="">Select Batch</option>
								</select>
							</div>	
			
				
							<div class='form-group'>
							<label class="w3-text-grey">Subject Name</label>
								<select  name="sid" class="w3-input w3-border" required id="subject">
								<option value="">Select Subject</option>
								</select>
							</div>


							<div class='form-group'>
							<label class="w3-text-grey">Select Teacher</label>
								<select name="tid" class="w3-input w3-border" required >
								<option value="">Select Teacher</option>
								<?php 
								foreach ($teachers as $v) {
									echo "<option value='$v->tid'>$v->name</option>";
								}
								?>
								</select>
							</div>
							<div class="form-group">
							<input type="submit" value="Submit" class="btn btn-default btn-block">
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-9 wp pl slideshow-col">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Assigned Subjects</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
						<?php include 'erp_common/assignedsubjects.php'; ?>
					</div>
					</div>
				</div>
			</div>

		</div>
</div>


<script src="<?=base_url()?>js/erp-add-common.js"></script>
<script>
var baseurl="<?=base_url()?>";

function refreshData(){
	$.get({url:baseurl+'erp/refreshassignsub',success:function(data){loadtable.innerHTML=data;}});
}

function deleteData(eid,ele){
	$.post({url:baseurl+'erp/deleteassignsub',data:{'eid':eid},success:function(data){
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}

function loadBatches(cid){
	$.post({url:baseurl+'erp/getbatchesbycourse',data:{'cid':cid},success:function(data){
		$("#batch").html("<option value=''>Select Batch</option>"+data);
	}});
}

function loadSubjects(){
	courseid=$("#cid").val();
	batchid=$("#batch").val();
	$.post({url:baseurl+'erp/getsubjectsbycb',data:{'cid':courseid,'bid':batchid},success:function(data){
		$("#subject").html("<option value=''>Select Subject</option>"+data);
	}});
}
</script>

