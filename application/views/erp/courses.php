<div id="content">
		<div class="row">
			<div class="col-sm-4 wp pr">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Add New Course</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>erp/savecourse" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Course Name</label>
								<input type="text" name="course" class="w3-input w3-border" placeholder="Course Name" required>
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
						<h4 class="mycardtitle">Active Courses</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
						<?php include 'erp_common/courses.php'; ?>
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
	$.post({url:baseurl+'erp/deletecourse',data:{'eid':eid},success:function(data){
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}

function refreshData(){
	$.get({url:baseurl+'erp/refreshcourse',success:function(data){loadtable.innerHTML=data;}});
}

</script>

