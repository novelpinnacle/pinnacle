<div id="content">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Update FAQs</h4>
					</div>
					<div class="mycardbody">
						<form id="form" action="<?=base_url()?>cms/updatefaqs" method="post">
							<div class='form-group'>
							<label class="w3-text-grey">Question</label>
								<input type="text" name="question" value="<?=$faqs->question?>" class="form-control" placeholder="Question" required>
							</div>
							<input type="hidden" name="id" value="<?=$faqs->id?>">
							<div class='form-group'>
							<label class="w3-text-grey">Answer</label>
								<textarea name="answer" placeholder="Answer" class="form-control"><?=$faqs->answer?></textarea>
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
                 Dialog(data.message);
                }
               });
  });
</script>