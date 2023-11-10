
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
<?php for($i=0;$i<count($data);$i++){?>
    <li data-target="#myCarousel" data-slide-to="<?=$i?>" class="<?=$i==0?'active':''?>"></li>
<?php }?>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner prevent-copy">

  <?php
  $n=0;
  foreach ($data as $v) {
  ?>
    <div class="item <?=$n==0?'active':''?> overlay">
      <img src="<?=base_url().'uploads/slideshow/'.$v->image?>" alt="<?=$v->title?>">
      <div class="slider-text animated slideInUp">
			<h1><?=$v->title?></h1>
		<p><?=$v->description?></p>
		<div class="button">
    <?php 
    if(!empty($v->b1name)){
      echo "<a href='$v->b1link' class='w3-btn b-primary'>$v->b1name</a>";
    }
    if(!empty($v->b2name)){
       echo "<a href='$v->b2link' class='w3-btn w3-white'>$v->b2name</a>";
    }
    ?>
			
		</div>
	</div>
    </div>
    <?php $n=1; }?>


  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>