<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Finished Lectures <span style=font-size:16px;></span></h4>
		</div>
		<div class="mycardbody">
			<div class="row chat-row">
				<div class="col-sm-3 wp chat-thumb-wrapper">
					<div class="form-group">
						<select class="w3-input w3-border" onchange="getFinishedLectures(this.value)">
							<option value="">Select Course &amp; Batch</option>
							<?php 
							foreach ($cb as $v) {
								echo "<option value=$v->id>$v->course - $v->batch</option>";
							}
							?>
						</select>
					</div>
				</div>
			</div>
			<div id="loadhere"></div>
		</div>
	</div>
</div>
<script>
var baseurl="<?=base_url()?>";
	function getFinishedLectures(bid){
		if(bid==""){return;}
		$("#loading").show();
		$.get({url:baseurl+"erp/getfinishedlectures/"+bid,success:function(data){
			$("#loading").hide();
			$("#loadhere").html(data);
		}});
	}
</script>