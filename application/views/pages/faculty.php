<div id="faculty" style="position:relative;top:-35px">
</div>
<div class="container">
	<section class="section team">
		<div class="container">
			<div class="row shadow">
				<div class="col-sm-12">
					<div class="section-title">
						<h2>Our Awesome <span>Teachers</span></h2>
						<p>Pinnacle educare houses one of thefinest educators with extraordinary pedalogy and with experience of academics as well as industrial exposure, they hold the capacity to transform the education in India.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php $n=0; foreach ($data as $v) {?>
					<div class="col-lg-3 col-md-6 col-sm-12">
						<!-- Single Team -->
						<div class="single-team">
							<img src="<?=base_url().$v->image?>" alt="#">
							<div class="team-hover">
								<h4><?=$v->name?><span><?=$v->designation?></span></h4>
								<p><?=$v->description?></p>
							</div>
						</div>
						<!--/ End Single Team -->
					</div>
					<?php $n=1;} ?>
				
			</div>
		</div>
	</section>
</div>
