<div id="content">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Upload New Teacher</h4>
						<?php 
							$checked=0;			
							if($status==1){
								$checked="checked";
							}
						?>
							<label class="switch">
							<input type="checkbox" <?=$checked?> onchange="toggle('teachers')">
							<span class="slider round"></span>
							</label>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/uploadteacher" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Name</label>
								<input type="text" name="name" class="form-control" placeholder="Teacher Name" required>
							</div>

							<div class='form-group'>
							<label class="w3-text-grey">Teacher Designation</label>
								<input type=text name="designation" placeholder="Teacher Designation" class="form-control">
							</div>
							<div class='form-group'>
							<label class="w3-text-grey">Teacher Description</label>
								<textarea name="description" placeholder="Teacher Description" class="form-control"></textarea>
							</div>
							
							<div class='form-group'>
							
							<div class='file-wrapper'>
							<input type="file" accept="image/x-png,image/gif,image/jpeg" required id="imagefile" onchange="$('#showselected').html('<b>Selected File:</b> '+this.files[0].name)" name="image">
							</div>
							
							<input type=button class='w3-btn w3-khaki btn-block' onclick="document.getElementById('imagefile').click()" value="Choose Image">

							<div style="margin-top:10px;" id="showselected"></div>
							</div>

							<div class="form-group">
							<input type="submit" value="Upload" class="w3-btn b-primary btn-block" >
							</div>

						</form>
					</div>
				</div>

			</div>
			<div class="col-sm-9 slideshow-col">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Active Teacher</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
					<table class='sc-table'>
						<tr><th>Image</th><th>Name</th><th>Designation</th><th>Description</th><th>Edit</th><th>Delete</th></tr>
						<?php foreach ($teachers as $v) {
							echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->name</td><td>$v->designation</td><td>$v->description</td><td><a href='".base_url()."cms/editteacher/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteTeacher($v->id,this)'></i></td></tr>";
						} ?>
					</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
var baseurl="<?=base_url()?>";
function deleteTeacher(tid,ele){
$.post({url:baseurl+'cms/deleteteacher',data:{'tid':tid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}
function refreshData(){
$.get({url:baseurl+'cms/refreshteacher',success:function(data){loadtable.innerHTML=data;}});
}
</script>
<script src="<?=base_url()?>js/cms-add-common.js"></script>