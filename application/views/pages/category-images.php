<style>
.image-gallery img{
	width: 100%;
	height: 150px;
}
.image-gallery .col-sm-3{
margin-bottom: 20px;
}
.image-gallery{
	padding-top: 50px;
}
.image-wrapper{
	box-shadow: 0 0 10px rgba(0,0,0,0.25);
}
</style>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/magnific-popup.css">
<section class="section image-gallery">
	<div class="container images">
	<div class="section-title">
		<h2><?=isset($images[0]->category)?$images[0]->category:""?> <span>Images</span></h2>
	</div>

		<div class="row popup-gallery" style="margin-top:50px;">
			
			<?php 
			foreach($images as $v) {?>
			<div class="col-sm-3">
				<div class='image-wrapper'>
					<a href='<?=base_url().$v->image?>'><img src='<?=base_url().$v->image?>'></a>
				</div>
			</div>

			<?php }?>

		</div>
	</div>
</section>
<script src="<?=base_url()?>js/jquery.magnific-popup.min.js"></script>
<script>
      $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
          delegate: 'a',
          type: 'image',
          tLoading: 'Loading image #%curr%...',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          },
          image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
              return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
            }
          }
        });
      });

</script>