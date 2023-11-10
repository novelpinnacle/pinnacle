<style>
.video-gallery{
	padding-top: 50px;
}
.video-gallery .col-sm-6{
	margin-bottom: 30px;
}
.video-wrapper{
	background-color: #fff;
	padding: 10px;
	box-shadow: 0 0 10px rgba(0,0,0,.25);
}
.video-wrapper iframe{
	width: 100%;
	height: 300px;
	border:none;
}
.video-wrapper h1{
margin-top: 0;
font-size: 20px;
font-weight: 700;
margin-bottom: 10px;
}
</style>
<section class="section video-gallery">
<div class="section-title">
		<h2>Video <span>Gallery</span></h2>
</div>
<div class="container images" style="margin-top:50px;">
<div class="row">

<?php foreach ($videos as $v) { ?>
<div class="col-sm-6">
<div class="video-wrapper">
<h1><?=$v->title?></h1>
<iframe src="https://www.youtube.com/embed/<?=$v->link?>" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
</div>
</div>
<?php }?>


</div>
</div>

</section>