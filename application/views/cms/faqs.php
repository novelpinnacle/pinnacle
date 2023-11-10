<div id="content">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Upload FAQs</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/uploadfaqs" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Question</label>
								<input type="text" name="question" class="form-control" placeholder="Question" required>
							</div>

							<div class='form-group'>
							<label class="w3-text-grey">Answer</label>
								<textarea name="answer" placeholder="Answer" class="form-control"></textarea>
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
						<h4 class="mycardtitle">Active FAQs</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
					<table class='sc-table'>
						<tr><th>Question</th><th>Answer</th><th>Edit</th><th>Delete</th></tr>
						<?php foreach ($faqs as $v) {
							echo "<tr><td>$v->question</td><td>$v->answer</td><td><a href='".base_url()."cms/editfaqs/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick='deletefaqs($v->id,this)'></i></td></tr>";
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
                	 document.getElementById("form").reset();
                 }
                   Dialog(data.message);
                   refreshData();
                },
                error: function(data) {
                	
                }
               });
  });

function deletefaqs(fid,ele){
$.post({url:'<?=base_url()?>cms/deletefaqs',data:{'fid':fid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}
function refreshData(){
$.get({url:'<?=base_url()?>cms/refreshfaqs',success:function(data){loadtable.innerHTML=data;}});
}

</script>