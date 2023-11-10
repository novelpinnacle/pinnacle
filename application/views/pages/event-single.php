<?php  if(!empty($data)){?>
<style>
.events .single-event{
	box-shadow: 0 0 10px rgba(0,0,0,.25);
	height: auto;
}
.event-content h2 a:hover{
	text-decoration: none;
}
/* Events Meta */
.events.single .book-now {
	overflow: hidden;
}
.events.single .book-now .button {
	float: left;
}
.events.single .book-now .button .btn{
	margin-top:0px;
} 
#event-img-wrapper{
	padding: 3px;
}
#event-img-wrapper img{
	width:100%;
	display: block;
}
.events .event-content{
	margin-top: 0;
}

</style>
<section class="events single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="single-event">
						
						<div id='event-img-wrapper'>
						<img src="<?=base_url().$data->image?>">
						</div>

							<div class="event-content">
								<div class="meta"> 
									<span><i class="fa fa-calendar"></i><?=$data->dat?></span>
									<span><i class="fa fa-clock-o"></i><?=$data->tim?></span>
								</div>
								<h2><a href="event-single.html"><?=$data->title?></a></h2>
								<p><?=$data->description?></p>
								
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-12">
					
					</div>
				</div>
			</div>
		</section>

		<?php }else{
			echo "<div class='text-center'><div style='margin:40px;display:inline-block' class='alert alert-danger'>Event Does Not Exist</div></div>";
			} ?>