 <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ruq98uymgipvjwwsmgyh10anvp4ctfjjuxvs7ariqle7s7wg"></script>
  <script>
	tinymce.init({
		selector: 'textarea',
		height: 350
	});
  </script>

<div id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Update Noticeboard <span style=font-size:16px;></span></h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>erp/updatenoticeboard" method="post">
							<input type="hidden" name="nid" id="noticeid" value="<?=$data->id?>">
							<div class='form-group'>
								<textarea id="content"><?=$data->content?></textarea>
							</div>
							<div class='form-group'>
								<input type="submit" value="Update" class='w3-btn b-primary' >
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

$('#form').submit(function(evt) {
    evt.preventDefault();
    var formData = new FormData();
    formData.append("content",getContent());
    formData.append("nid",$("#noticeid").val());
    $.ajax({
	    type: 'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    dataType:'json',
	    contentType: false,
	    processData: false,
	    success: function(data) {
	       openModal({title:'Status',content:data.message});
	    }
   });
  });

function getContent(){
	x = document.getElementById("content_ifr");
	y = (x.contentWindow || x.contentDocument);
	if (y.document){y = y.document;}
	var cont=y.body.innerHTML;
	return cont;
}

</script>