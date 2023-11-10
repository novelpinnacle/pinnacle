<div class='row'>
	<div>
		<div class="section-title">
		<h2>Student's <span>Testimonials</span></h2>
	</div>

<section class="testimonials tes section overlay" style="background-image: url(<?=base_url()?>images/library.jpg);padding-left:20px;padding-right:20px;">

		<div class="owl-carousel testi2">
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


<div>

<div class="section-title">
	<h2>Parent's <span>Testimonials</span></h2>
</div>

<section class="testimonials tes section overlay" style="background-image: url(<?=base_url()?>images/library.jpg);padding-left:20px;padding-right:20px;">

		<div class="owl-carousel testi2">
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
