<div id="content">
<div class="container">
		<div class="mycard" style="max-width:300px;">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Update Feature</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/updatefeature" method="post">
							<div class="form-group text-center">
							<img src="<?=base_url().$feature->image?>" id="showimg" style='width:100%;'>
							</div>
							<div class='form-group'>
								<label class="w3-text-grey">Feature Title</label>
								<input type="text" name="title" class="form-control" placeholder="Feature Title" value="<?=$feature->title?>" required>
							</div>
							<input type="hidden" name="fid" value="<?=$feature->id?>">
							<div class='form-group'>
							<label class="w3-text-grey">Feature Description</label>
								<textarea name="description" placeholder="Feature Description" class="form-control"><?=$feature->description?></textarea>
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
                 	$("#imagefile").val('');
                  	showselected.innerHTML="";
                  }
          	if(data.newimg!=""){
          		showimg.src=baseurl+data.newimg;	
          	}
                   Dialog(data.message);
                }
               });
  });
  </script>