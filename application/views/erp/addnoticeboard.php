 <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ruq98uymgipvjwwsmgyh10anvp4ctfjjuxvs7ariqle7s7wg"></script>
  <script>
	tinymce.init({
		selector: 'textarea',
		height: 350
	});
  </script>

<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Post New Noticeboard <span style=font-size:16px;>This will be for all courses and batches's students</span></h4>
		</div>
		<div class="mycardbody">
			<form id="form" action="<?=base_url()?>erp/savenoticeboard" method="post">
				<div class='form-group'>
					<textarea id="content"></textarea>
				</div>
				<div class='form-group'>
					<input type="submit" value="Submit" class='btn btn-default ' >
				</div>
			</form>
		</div>
	</div>
</div>
<script>

$('#form').submit(function(evt) {
    evt.preventDefault();
    if(getContent().replace( /(<([^>]+)>)/ig, '')==""){
    	openModal({title:'Status',content:'Noticeboard cannot be empty'});
    	return;
    }

    $("#loading").show();
    var formData = new FormData();
    formData.append("content",getContent());
    $.ajax({
	    type: 'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    dataType:'json',
	    contentType: false,
	    processData: false,
	    success: function(data) {
		   if(data.status=="ok"){
		   	$("#form").trigger("reset");
		   }
		   openModal({title:'Status',content:data.message});
		   $("#loading").hide();
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