<div id="content">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Upload New Images</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/uploadimages" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Category</label>
								<input type="text" name="category" class="form-control" placeholder="Category" required>
							</div>
							<div class='form-group'>
							<div class='file-wrapper'>
							<input type="file" accept="image/x-png,image/gif,image/jpeg" required id="imagefile" onchange="$('#showselected').html('<b>Selected File:</b> '+this.files[0].name)" name="image[]" multiple>
							</div>
							
							<input type=button class='w3-btn w3-khaki btn-block' onclick="document.getElementById('imagefile').click()" value="Choose Images">

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
						<h4 class="mycardtitle">Active Images</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
					<table class='sc-table'>
						<tr><th>Image</th><th>Category</th><th>Delete</th></tr>
						<?php foreach ($images as $v) {
							echo "<tr><td style='width:100px;padding:2px'><img src='".base_url()."$v->image' class='thumbnail-img'></td><td>$v->category</td><td><i class='fa fa-close' onclick='deleteImage($v->id,this)'></i></td></tr>";
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
$('#form').submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                if(data.status=="ok"){
                $("#form").trigger("reset");
                  	showselected.innerHTML="";
                  }
                  Dialog(data.message);
                  refreshData();
                },
                error: function(data) {
                	
                }
               });
  });

function deleteImage(iid,ele){
$.post({url:'<?=base_url()?>cms/deleteimages',data:{'iid':iid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}
function refreshData(){
$.get({url:'<?=base_url()?>cms/refreshimages',success:function(data){loadtable.innerHTML=data;}});
}
</script>