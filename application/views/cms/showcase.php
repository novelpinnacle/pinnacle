<div id="content">
<div class="row">
<div class="col-sm-4"></div>
<div class="col-sm-4">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Create Showcase</h4>
						<?php 
							$checked=0;			
							if($status==1){
								$checked="checked";
							}
						?>
							<label class="switch">
							<input type="checkbox" <?=$checked?> onchange="toggle('showcase')">
							<span class="slider round"></span>
							</label>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/createshowcase" method="post">
							<?php if($showcase!=null) {?>
								<div class="form-group text-center">
									<img id="showimg" src="<?=base_url().$showcase->image?>" style='width:100px'>
								</div>
							<?php } ?>
							<div class="form-group">
							<label>Showcase Title</label>
							<input type="text" name="title" class="w3-input w3-border" value="<?=$showcase==null?'':$showcase->title?>">
							</div>
							<div class="form-group">
							<label>Showcase Description</label>
							<textarea name="description" class="w3-input w3-border"><?=$showcase==null?'':$showcase->description?></textarea>
							</div>
							<div class="row">
							<div class="col-sm-6 wp pr">
							<div class="form-group">
							<label>Button Name</label>
							<input type="text" name="bname" class="w3-input w3-border" value="<?=$showcase==null?'':$showcase->bname?>">
							</div>
							</div>
							<div class="col-sm-6 wp pl">
							<div class="form-group">
							<label>Button Link</label>
							<input type="text" name="blink" class="w3-input w3-border" value="<?=$showcase==null?'':$showcase->blink?>">
							</div>
							</div>
							</div>

							<div class="form-group">
									<div class='file-wrapper'>
							<input type="file" accept="image/x-png,image/gif,image/jpeg"  id="imagefile" onchange="$('#showselected').html('<b>Selected File:</b> '+this.files[0].name)" name="image">
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