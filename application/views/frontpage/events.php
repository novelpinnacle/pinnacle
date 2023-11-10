<div id="events" style="position:relative;top:-25px"></div>
<section class="events section" style="padding-bottom:40px">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="section-title">
							<h2>Upcoming <span>Events</span></h2>
							<p>Mauris at varius orci. Vestibulum interdum felis eu nisl pulvinar, quis ultricies nibh. Sed ultricies ante vitae laoreet sagittis. In pellentesque viverra purus. Sed risus est, molestie nec hendrerit hendreri </p>
						</div>
					</div>
				</div>

				<div class="owl-carousel ev">
					<?php foreach ($data as $v) { ?>
					<div class="item">
							<div class="single-event">
								<div class="head overlay">
									<img src="<?=base_url().$v->image?>">
									<a href="<?=base_url()?>home/event_single/<?=$v->id?>" class="btn"><i class="fa fa-search"></i></a>
								</div>
								<div class="event-content">
									<div class="meta">
										<span><i class="fa fa-calendar"></i><?=$v->dat?></span>
										<span><i class="fa fa-clock-o"></i><?=$v->tim?></span>
									</div>
									<div class="title">
										<h4><a href="<?=base_url()?>home/event_single/<?=$v->id?>"><?=$v->title?></a></h4>
										<p><?=$v->description?></p>
									</div>
								
								</div>
							</div>
					</div>
					<?php }?>


				</div>
			</div>
</section>