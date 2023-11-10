<div id="content">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Upload Videos</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/uploadvideos" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Title</label>
								<input type="text" name="title" class="form-control" placeholder="Title" required>
							</div>

							<div class='form-group'>
							<label class="w3-text-grey">Youtube Link</label>
								<textarea name="link" placeholder="Youtube video embed link" class="form-control"></textarea>
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
						<h4 class="mycardtitle">Active Videos</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
					<table class='sc-table'>
						<tr><th>Title</th><th>Link</th><th>Delete</th></tr>
						<?php foreach ($videos as $v) {
							echo "<tr><td>$v->title</td><td>$v->link</td><td><i class='fa fa-close' onclick='deleteVideo($v->id,this)'></i></td></tr>";
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
                	$("#form").trigger("reset");
                 }
                   Dialog(data.message);
                   refreshData();
                },
                error: function(data) {
                	
                }
               });
  });

function deleteVideo(vid,ele){
$.post({url:'<?=base_url()?>cms/deletevideos',data:{'vid':vid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}
function refreshData(){
$.get({url:'<?=base_url()?>cms/refreshvideos',success:function(data){loadtable.innerHTML=data;}});
}

</script>