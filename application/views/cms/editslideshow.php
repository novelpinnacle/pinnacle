<div id="content">
<div class="container">
		<div class="mycard" style="max-width:400px;">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Update Slideshow</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/updateslideshow" method="post">
							<div class="form-group text-center">
							<img src="<?=base_url().$slideshow->image?>" id="showimg" style='width:90px;'>
							</div>
							<div class='form-group'>
								<label class="w3-text-grey">Slideshow Title</label>
								<input type="text" name="title" class="form-control" placeholder="Slideshow Title" value="<?=$slideshow->title?>" required>
							</div>
							<input type="hidden" name="sid" value="<?=$slideshow->id?>">
							<div class='form-group'>
							<label class="w3-text-grey">Slideshow Description</label>
								<textarea name="description" placeholder="Slideshow Description" class="form-control"><?=$slideshow->description?></textarea>
							</div>
							<div class="row">
							<div class="col-sm-6 wp pr">
							<div class='form-group'>
							<label class="w3-text-grey">1st Button Name</label>
								<input type="text" name="b1name" class="form-control" placeholder="1st Button Name" value="<?=$slideshow->b1name?>" >
							</div>
							</div>
							<div class="col-sm-6 wp pl">
							<div class='form-group'>
							<label class="w3-text-grey">1st Button Link</label>
								<input type="text" name="b1link" class="form-control" placeholder="1st Button Link" value="<?=$slideshow->b1link?>" >
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-sm-6 wp pr">
							<div class='form-group'>
							<label class="w3-text-grey">2nd Button Name</label>
								<input type="text" name="b2name" class="form-control" placeholder="2nd Button Name" value="<?=$slideshow->b2name?>" >
							</div>
							</div>
							<div class="col-sm-6 wp pl">
							<div class='form-group'>
							<label class="w3-text-grey">2nd Button Link</label>
								<input type="text" name="b2link" class="form-control" placeholder="2nd Button Link" value="<?=$slideshow->b2link?>" >
							</div>
							</div>
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