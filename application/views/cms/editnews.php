<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/DateTimePicker.css" />
<script type="text/javascript" src="<?=base_url()?>js/DateTimePicker.js"></script>

<div id="content">
<div class="container">
		<div class="mycard" style="max-width:300px;">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Update News</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/updatenews" method="post">
							<div class="form-group text-center" style="padding:0 16%">
							<img src="<?=base_url().$news->image?>" id="showimg" style='width:100%;'>
							</div>
							<div class='form-group'>
							<label class="w3-text-grey">News Title</label>
								<input type="text" name="title" class="form-control" placeholder="Title" value="<?=$news->title?>" required>
							</div>
								<div class='form-group'>
								<label class="w3-text-grey">News Date</label>
								<input type="text" name="datetime"  data-field="datetime"  class="form-control" placeholder="Date Time" value="<?=$news->datetime?>" required>
							</div>
							<input type="hidden" name="eid" value="<?=$news->id?>">
							<div class='form-group'>
							<label class="w3-text-grey">News Description</label>
								<textarea name="description" placeholder="news Description" class="form-control"><?=$news->description?></textarea>
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
<div id="dtBox"></div>
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


$( function() {
    $("#dtBox").DateTimePicker({dateTimeFormat: "yyyy-MM-dd hh:mm:ss"});
  } );
</script>