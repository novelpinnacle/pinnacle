
<section class="our-features section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">		
				<div class="section-title">
				<h2>Our <span>Features</span></h2>
				<p>Features why should students choose Pinnacle Educare.</p>
				</div>
			</div>
		</div>	

		<div class="owl-carousel feat">
			<?php foreach ($data as $v){?>
			<div class="item">
				<div class="single-feature">
					<div class="feature-head">
						<img src="<?=base_url().'uploads/features/'.$v->image?>">
					</div>
					<h2><?=$v->title?></h2>
					<p><?=$v->description?></p>	
				</div>	
			</div>
		<?php }?>
		</div>
	</div>
</section>