<div id="content">
		<div class="row">
			<div class="col-sm-3 wp pr">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Assign Course &amp; Batches</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>erp/saveassigncb" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Select Course</label>
								<select name="cid" class="w3-input w3-border" required onchange="loadBatches(this.value)">
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
								<select name="bid" class="w3-input w3-border" required id="batch">
									<option value="">Select Batch</option>
								</select>
							</div>	
					
							<div class='form-group'>
							<label class="w3-text-grey">Select Teacher</label>
								<select name="tid" class="w3-input w3-border" required>
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
						<h4 class="mycardtitle">Assigned Courses &amp; Batches</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
						<?php include 'erp_common/assignedcb.php'; ?>
					</div>
					</div>
				</div>
			</div>

		</div>
</div>


<script src="<?=base_url()?>js/erp-add-common.js"></script>
<script>
var baseurl="<?=base_url()?>";

function deleteData(eid,ele){
	$.post({url:baseurl+'erp/deleteassigncb',data:{'eid':eid},success:function(data){
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}

function refreshData(){
	$.get({url:baseurl+'erp/refreshassigncb',success:function(data){loadtable.innerHTML=data;}});
}

function loadBatches(cid){
	$.post({url:baseurl+'erp/getbatchesbycourse',data:{'cid':cid},success:function(data){
		$("#batch").html("<option value=''>Select Batch</option>"+data);
	}});
}
</script>

