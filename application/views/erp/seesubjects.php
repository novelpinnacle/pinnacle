<div id="content">
	<div class="container-fluid">
		<div class="row">
		<div class="col-sm-3"></div>
			<div class="col-sm-6">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Subjects in <?=isset($course->course)?$course->course:''?> <?=isset($batch->batch)?$batch->batch:''?></h4>
					</div>
					<div class="mycardbody">
						<?php if(!empty($subjects)) {?>
						<table class="sc-table">
							<tr><th>Subject</th><th>Edit</th><th>Delete</th></tr>
							<?php
							foreach ($subjects as $v) {
								echo "<tr><td>$v->subject</td><td><a class='btn btn-default btn-sm' href='".base_url()."erp/editsubject/$v->id/$v->cid/$v->bid'><i class='fa fa-pencil'></i></a></td><td><button class='btn btn-default btn-sm'><i class='fa fa-close' onclick=\"showDelete($v->id,this)\"></i></button></td></tr>";
							}
							 ?>
						</table>
						<?php }else{echo "<div class='alert alert-info'>Subjects Not Added Yet</div>";} ?>
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
	$.post({url:baseurl+'erp/deletesubjects',data:{'eid':eid},success:function(data){
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}
</script>