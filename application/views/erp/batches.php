<div id="content">
		<div class="row">
			<div class="col-sm-4 wp pr">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Add New Batches</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>erp/savebatch" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Select Course</label>
								<select name="cid" class="w3-input w3-border" required>
								<option value="">Select Course</option>
								<?php 
								foreach ($courses as $v) {
									echo "<option value='$v->id'>$v->course</option>";
								}
								?>
								</select>
							</div>	
							<div class='form-group'>
							<label class="w3-text-grey">Batch Name</label>
								<input type="text" name="batch" class="w3-input w3-border" placeholder="Batch Name" required>
							</div>
							<div class="form-group">
							<input type="submit" value="Submit" class="btn btn-default btn-sm pull-right">
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-8 wp pl slideshow-col">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Active Batches</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
						<?php include 'erp_common/batches.php'; ?>
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
	$.post({url:baseurl+'erp/deletebatch',data:{'eid':eid},success:function(data){
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}
function refreshData(){
	$.get({url:baseurl+'erp/refreshbatch',success:function(data){loadtable.innerHTML=data;}});
}

</script>

