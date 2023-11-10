<?php if(!isMobile()){ ?>
<div class='row'>
	<div class="col-sm-6 wp">
		<div class="section-title wp">
			<h2>Student's <span>Testimonials</span></h2>
		</div>
	</div>
	<div class="col-sm-6 wp">
		<div class="section-title wp">
			<h2>Parent's <span>Testimonials</span></h2>
		</div>
	</div>
</div>
<div class="row tes overlay">
	<div class='col-sm-6 wp' >
		<section class="testimonials section " style="padding:40px 20px">
				<div class="owl-carousel testi">
					<?php foreach ($student as $v){?>
					<div class="item">
						<div class="single-testimonial">
								<img src="<?=base_url().$v->image?>" alt="#">
								<div class="main-content">
									<h4 class="name"><?=$v->name?></h4>
									<p><?=$v->description?></p>
								</div>
						</div>
					</div>
					<?php }?>
				</div>
		</section>
	</div>
	<div class='col-sm-6 wp' >
		<section class="testimonials section " style="padding:40px 20px">
				<div class="owl-carousel testi">
					<?php foreach ($parent as $v){?>
					<div class="item">
						<div class="single-testimonial">
								<img src="<?=base_url().'uploads/testimonials/'.$v->image?>" alt="#">
								<div class="main-content">
									<h4 class="name"><?=$v->name?></h4>
									<p><?=$v->description?></p>
								</div>
						</div>
					</div>
					<?php }?>
				</div>
		</section>
	</div>
</div>
<?php } else{?>
<div class="section-title wp">
	<h2>Student's <span>Testimonials</span></h2>
</div>
<div class="row tes overlay">
	<div class='col-sm-12 wp' >
		<section class="testimonials section " style="">
				<div class="owl-carousel testi">
					<?php foreach ($student as $v){?>
					<div class="item">
						<div class="single-testimonial">
								<img src="<?=base_url().$v->image?>" alt="#">
								<div class="main-content">
									<h4 class="name"><?=$v->name?></h4>
									<p><?=$v->description?></p>
								</div>
						</div>
					</div>
					<?php }?>
				</div>
		</section>
	</div>
</div>

<div class="section-title wp">
	<h2>Parent's <span>Testimonials</span></h2>
</div>
<div class="row tes overlay">
	<div class='col-sm-6 wp' >
		<section class="testimonials section " style="padding:40px 20px">
			<div class="owl-carousel testi">
				<?php foreach ($parent as $v){?>
				<div class="item">
					<div class="single-testimonial">
						<img src="<?=base_url().$v->image?>" alt="#">
						<div class="main-content">
							<h4 class="name"><?=$v->name?></h4>
							<p><?=$v->description?></p>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</section>
	</div>
</div>
<?php }?>