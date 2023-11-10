<style>
.image-gallery img{
	width: 100%;
}
.image-gallery .col-sm-3{
margin-bottom: 20px;
}
.image-wrapper{
	box-shadow: 0 0 10px rgba(0,0,0,0.25);
}
.cat-title{
	padding:10px 10px;
}
.cat-title h4{
	margin:0;
	font-size: 17px;
	font-weight: 700;
}
</style>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/magnific-popup.css">
<div class="container images">
<section class="section image-gallery">
		<div class="row">
			
			<?php 
			foreach($images as $v) {?>
			
			<div class="col-sm-3 wp">

				<div class='image-wrapper'>
					<a href="<?=base_url()?>home/gallery_images/<?=$v->category?>">
					<div class='cat-title'><h4><?=$v->category?> Images</h4></div>
					<img src='<?=base_url().$v->image?>'>
					</a>
				</div>
			</div>

			<?php }?>

		</div>

</section>
</div>