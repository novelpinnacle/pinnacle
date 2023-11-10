<footer>
	<div class="container">
		<div class="row">
			<div class="col-20">
				<h3>About Us</h3>
					<a href='<?=base_url()?>our-vision'> Values and vision</a><br>
					<a href='<?=base_url()?>aims-and-responsibility'> Aims and Responsibilities</a><br>
					<a href='<?=base_url()?>our-faculty'> Our Team</a><br>
					<a href='<?=base_url()?>why-pinnacle'> Why Pinnacle</a><br>
					<a href='<?=base_url()?>testimonials'> Testimonials</a>
			</div>
	
			<div class="col-20">
				<h3>Our Courses</h3>
					<a href='<?=base_url()?>home/ourcourses#!/8th'>Class 8th</a><br>
					<a href='<?=base_url()?>home/ourcourses#!/9th'>Class 9th</a><br>
					<a href='<?=base_url()?>home/ourcourses#!/10th'>Class 10th</a><br>
					<a href='<?=base_url()?>home/ourcourses#!/11th'>Class 11th</a><br>
					<a href='<?=base_url()?>home/ourcourses#!/12th'>Class 12th</a>
			</div>
			<div class="col-20">
				<h3>Admission</h3>
					<a href='<?=base_url()?>admission-process'>Admission Process</a><br>
					<a href='<?=base_url()?>admission-sample-papers'>Sample Papers</a><br>
					<a href='<?=base_url()?>admission-register'>Register</a>
			</div>
	
		</div>
	</div>
</footer>
<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-4 wp">
				<div>Pinnaclo Educare - 2019 &copy; All Rights Reserved.</div>
			</div>
			 <div class="col-sm-5 wp hidden-xs">
				<a href='<?=base_url()?>privacy-policy'>Privacy Policy</a>
				<a href='<?=base_url()?>terms-and-conditions'>Terms and Conditions</a>
				<a href='<?=base_url()?>refund-and-cancellation'>Refund &amp; Cancellation</a>
			</div> 
			<div class="col-sm-3 text-center">
				<a href="#"><i class="fa fa-twitter"></i></a>
				<a href="#"><i class="fa fa-facebook"></i></a>
				<a href="#"><i class="fa fa-google-plus"></i></a>
				<a href="#"><i class="fa fa-linkedin"></i></a>
				<a href="#"><i class="fa fa-youtube"></i></a>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="modalDialog" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
         
        </div>
      </div>
    </div>
</div>

<div id='loading'>
	<div id="loading-wrapper"></div>
	<i class='fa fa-spinner fa-spin loading'></i>
	<div  id="loadingtext">Loading...</div>
</div>

<?php 
//if(isset($frontpage)){
//	echo "<div id='resultmodal'>
//			<img src='".base_url()."images/results.jpg'><i onclick='this.parentElement.remove()' class='fa fa-remove'></i></div>";
//
//}
?>

<script>

function openModal(options){
	if(options.title!=undefined){$("#modalDialog .modal-title").text(options.title);}
	if(options.content!=undefined){$("#modalDialog .modal-body").html(options.content);}
	if(options.width!=undefined){$("#modalDialog .modal-dialog").css("width",options.width);}
	$("#modalDialog").modal({backdrop:'static'});
}

</script>

<script type="text/javascript" src="<?=base_url()?>js/owl.carousel.js"></script>
 <script>
 var config={
			autoplay:true,
			autoplayTimeout:3500,
			autoplayHoverPause:true,
			items:1,
			smartSpeed: 600,
			loop:true,
			merge:true,
			margin:5,
			nav:true,
			dots:false,
			navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
			responsive:{
				300: {
					nav:false,
					items:1
				},
				768: {
					nav:false,
				},
				1170: {
					nav:true,
				},
			}
		};
		$('.owl-carousel.testi').owlCarousel(config);
		config.items=2;
		$('.owl-carousel.testi2').owlCarousel(config);
		config.items=5;
		config.margin=10;
		$('.owl-carousel.news,.owl-carousel.feat,.owl-carousel.ev').owlCarousel(config);
		config.items=4;
		$('.owl-carousel.toppers').owlCarousel(config);
		config.items=3;
		$('.owl-carousel.it').owlCarousel(config);
		
  </script>
</body>
</html>