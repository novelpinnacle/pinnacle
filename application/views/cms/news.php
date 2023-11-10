<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/DateTimePicker.css" />
<script type="text/javascript" src="<?=base_url()?>js/DateTimePicker.js"></script>
<div id="content">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Upload Latest News</h4>
						<?php 
							$checked=0;			
							if($status==1){
								$checked="checked";
							}
						?>
							<label class="switch">
							<input type="checkbox" <?=$checked?> onchange="toggle('news')">
							<span class="slider round"></span>
							</label>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/uploadnews" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Title</label>
								<input type="text" name="title" class="form-control" placeholder="Title" required>
							</div>

							<div class='form-group'>
							<label class="w3-text-grey">News Date</label>
								<input type="text" name="datetime"  data-field="datetime" class="form-control" placeholder="news Date" required>
							</div>
							
							<div class='form-group'>
							<label class="w3-text-grey">News Description</label>
								<textarea name="description" placeholder="news Description" class="form-control"></textarea>
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
						<h4 class="mycardtitle">Active News</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
					<table class='sc-table'>
						<tr><th>Image</th><th>Title</th><th>Description</th><th>Date</th><th>Edit</th><th>Delete</th></tr>
						<?php foreach ($news as $v) {
							echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->title</td><td>$v->description</td><td>$v->datetime</td><td><a href='".base_url()."cms/editnews/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deletenews($v->id,this)'></i></td></tr>";
						} 
						?>
					</table>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="dtBox"></div>

<script>
var baseurl="<?=base_url()?>";
function deletenews(eid,ele){
$.post({url:baseurl+'cms/deletenews',data:{'eid':eid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}
function refreshData(){
$.get({url:baseurl+'cms/refreshnews',success:function(data){loadtable.innerHTML=data;}});
}
$( function() {
    $("#dtBox").DateTimePicker({dateTimeFormat: "yyyy-MM-dd hh:mm:ss"});
 });
</script>
<script src="<?=base_url()?>js/cms-add-common.js"></script>