<div id="news" style="position:relative;top:-25px"></div>
		<section class="blog section" style="padding-top:20px">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Latest <span>News</span></h2>
							<p>Mauris at varius orci. Vestibulum interdum felis eu nisl pulvinar, quis ultricies nibh. Sed ultricies ante vitae laoreet sagittis. In pellentesque viverra purus. Sed risus est, molestie nec hendrerit hendreri </p>
						</div>
					</div>
				</div>
				<div class="owl-carousel news">
				<?php foreach($data as $v){ ?>
					<div class="item">
						<div class="single-blog">
								<div class="blog-head overlay">
									<div class="date">
										<h4><?=$v->d?><span><?=$v->m?></span></h4>
									</div>
									<img src="<?=$v->image?>">
								</div>
								<div class="blog-content">
									
									<div class="meta">
										<span><i class="fa fa-calendar"></i> <?=$v->dat?></span>
										<span><i class="fa fa-clock-o"></i> <?=$v->tim?></span>
									</div>
									<h4 class="blog-title"><a href="<?=base_url()?>home/blog_single/<?=$v->id?>"><?=$v->title?></a></h4>
									<p style=color:#666><?=$v->description?></p>
									<div class="button">
										<a href="<?=base_url()?>home/blog_single/<?=$v->id?>" class="w3-btn b-primary news-readmore">Read More <i class="fa fa-angle-double-right"></i></a>
									</div>
								</div>
							</div>
					</div>
					<?php }?>
				</div>
			</div>
		</section>