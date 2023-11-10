<div id="content">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Upload New Slideshow</h4>
						<?php 
							$checked=0;			
							if($status==1){
								$checked="checked";
							}
						?>
							<label class="switch">
							<input type="checkbox" <?=$checked?> onchange="toggle('slideshow')">
							<span class="slider round"></span>
							</label>

					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/uploadslideshow" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Slideshow Title</label>
								<input type="text" name="title" class="form-control" placeholder="Slideshow Title" required>
							</div>
							<div class='form-group'>
							<label class="w3-text-grey">Slideshow Description</label>
								<textarea name="description" placeholder="Slideshow Description" class="form-control"></textarea>
							</div>
							<div class="row">
							<div class='col-sm-6 wp pr'>
								<div class='form-group'>
								<label class="w3-text-grey">1st Button Name</label>
									<input type="text" name="b1name" class="form-control" placeholder="1st Button Name">
								</div>
							</div>
							<div class="col-sm-6 wp pl">
								<div class='form-group'>
								<label class="w3-text-grey">1st Button Link</label>
									<input type="text" name="b1link" class="form-control" placeholder="1st Button Link">
								</div>
							</div>
							</div>
							<div class="row">
							<div class='col-sm-6 wp pr'>
								<div class='form-group'>
								<label class="w3-text-grey">2nd Button Name</label>
									<input type="text" name="b2name" class="form-control" placeholder="2nd Button Name">
								</div>
							</div>
							<div class="col-sm-6 wp pl">
								<div class='form-group'>
								<label class="w3-text-grey">2nd Button Link</label>
									<input type="text" name="b2link" class="form-control" placeholder="2nd Button Link">
								</div>
							</div>
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
			<div class="col-sm-8 slideshow-col">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Active Slideshows</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
					<table class='sc-table'>
						<tr><th>Image</th><th>Title</th><th>Description</th><th>Button 1</th><th>Button 2</th><th>Edit</th><th>Delete</th></tr>
						<?php foreach ($slideshow as $v) {
							echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->title</td><td>$v->description</td><td>$v->b1name</td><td>$v->b2name</td><td><a href='".base_url()."cms/editslideshow/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deleteSlideshow($v->id,this)'></i></td></tr>";
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
function deleteSlideshow(sid,ele){
$.post({url:baseurl+'cms/deleteslideshow',data:{'sid':sid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}
function refreshData(){
$.get({url:baseurl+'cms/refreshslideshow',success:function(data){loadtable.innerHTML=data;}});
}
</script>
<script src="<?=base_url()?>js/cms-add-common.js"></script>