<section class="section toppers" style="padding-bottom:0">
	<div class="container">
	<div class="section-title">
			<h2>Our <span>CBSE Results</span></h2>
			<p>Our Students who got highest Marks in CBSE Results</p>
	</div>

	<div class="owl-carousel toppers">
	<?php foreach ($data as $v){?>
		<div class="item">
			<div class="topper-wrapper single-topper">
				<div class="topper-image-wrapper">
				<img style='width:140px;height:140px;display:inline-block;' src="<?=base_url().'uploads/results/'.$v->image?>">
				</div>
				<div class="topper-content">
					<h2><?=$v->name?></h2>
					<p><?=$v->classdetails?></p>
					<p><?=$v->marks?></p>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
	</div>
</section>