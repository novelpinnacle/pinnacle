<div id="content">
	<div class="row">
		<div class="col-sm-4 wp">
			<div class="mycar">
					<div class="mycardheader b-primary" style="margin:0">
						<h4 class="mycardtitle">Register Student From Home</h4>
							<?php 
								$checked=0;			
								if($addstudents==1){
									$checked="checked";
								}
							?>
							<label class="switch">
							<input type="checkbox" <?=$checked?> onchange="toggle('regstudents')">
							<span class="slider round"></span>
							</label>
					</div>
			</div>
		</div>
	</div>
</div>
<script>
baseurl="<?=base_url()?>";
function toggle(section){
 	$.post({url:baseurl+'cms/togglesections',data:{"section":section}});
}
</script>