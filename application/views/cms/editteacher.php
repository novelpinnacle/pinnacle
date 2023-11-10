<div id="content">
<div class="container">
		<div class="mycard" style="max-width:300px;">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Update Teacher</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/updateteacher" method="post">
							<div class="form-group text-center">
							<img src="<?=base_url().$teacher->image?>" id="showimg" style='width:100%;'>
							</div>
							<div class='form-group'>
							<label class="w3-text-grey">Teacher Name</label>
								<input type="text" name="name" class="form-control" placeholder="Name" value="<?=$teacher->name?>" required>
							</div>
							<div class='form-group'>
							<label class="w3-text-grey">Teacher Designation</label>
								<input type="text" name="designation" class="form-control" placeholder="Designation" value="<?=$teacher->designation?>" required>
							</div>
							<input type="hidden" name="tid" value="<?=$teacher->id?>">
							<div class='form-group'>
							<label class="w3-text-grey">Teacher Description</label>
								<textarea name="description" placeholder="Teacher Description" class="form-control"><?=$teacher->description?></textarea>
							</div>
														<div class='form-group'>
							<div>
							<input type="file" id="imagefile" onchange="$('#showselected').html('<b>Selected File:</b> '+this.files[0].name)" style="position:absolute;left:-2000px;" name="image">
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
</div>
<script>
	var baseurl="<?=base_url()?>";
</script>
<script>
$('#form').submit(function(evt) {
                evt.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {
                 if(data.status=="ok"){
                  	showselected.innerHTML="";
                  	$("#imagefile").val('');
                  }
          	if(data.newimg!=""){
          		showimg.src=baseurl+data.newimg;	
          	}
                   Dialog(data.message);
                }
               });
  });
  </script>