<div id="content">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Add New Topper</h4>
						<?php 
							$checked=0;			
							if($status==1){
								$checked="checked";
							}
						?>
							<label class="switch">
							<input type="checkbox" <?=$checked?> onchange="toggle('toppers')">
							<span class="slider round"></span>
							</label>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/uploadtopper" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Name</label>
								<input type="text" name="name" class="form-control" placeholder="Sanjay Mishra" required>
							</div>
							<div class='form-group'>
							<label class="w3-text-grey">Class Details</label>
								<input type=text name="classdetails" placeholder="Like CBSE 10th 2019" class="form-control">
							</div>
								<div class='form-group'>
							<label class="w3-text-grey">Marks</label>
								<input type="text" name="marks" class="form-control" placeholder="Like 94%" required>
							</div>
							
							<div class='form-group'>
							
							<div class='file-wrapper'>
							<input type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg" required id="imagefile" onchange="$('#showselected').html('<b>Selected File:</b> '+this.files[0].name)" name="image">
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
						<h4 class="mycardtitle">Active Toppers</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
					<table class='sc-table'>
						<tr><th>Image</th><th>Name</th><th>Class</th><th>Marks</th><th>Edit</th><th>Delete</th></tr>
						<?php foreach ($toppers as $v) {
							echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->name</td><td>$v->classdetails</td><td>$v->marks</td><td><a href='".base_url()."cms/edittopper/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteTopper($v->id,this)'></i></td></tr>";
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
function deleteTopper(tid,ele){
$.post({url:baseurl+'cms/deletetopper',data:{'tid':tid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}
function refreshData(){
$.get({url:baseurl+'cms/refreshtopper',success:function(data){loadtable.innerHTML=data;}});
}
</script>
<script src="<?=base_url()?>js/cms-add-common.js"></script>