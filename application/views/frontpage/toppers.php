<section class="section toppers" style="padding-bottom:0">
	<div class="container">
		<div class="section-title">
			<h2>Our Shining <span>Stars</span></h2>
			<p>All the students are from classroom program</p>
		</div>

		<div class="owl-carousel toppers">
			<?php foreach ($data as $v){?>
				<div class="item">
					<div class="topper-outer-padding">
						<div class="topper-wrapper single-topper">
							<div class="topper-image-wrapper">
								<img style='width:140px;height:140px;display:inline-block;' src="<?=base_url().'uploads/toppers/'.$v->image?>">
							</div>
							<div class="topper-content">
								<h2><?=$v->name?></h2>
								<p><?=$v->classdetails?></p>
								<p id = "toppercontentcollege"><?=$v->marks?></p>
							</div>
						</div>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
</section>