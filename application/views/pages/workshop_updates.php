<style>
.mainr{
	margin-top: 20px;
}
#todayitems{
	box-shadow: 0 0 4px #889;
}
.single-it>img{
	height:auto;
}

.title-up{
	padding: 10px;
	font-size: 22px;
	background-color: #f1f1f1;
	margin-bottom: 5px;
}

#updates{
	padding: 5px;
		box-shadow: 0 0 4px #889;
}
#updates>img{
	display: block;
	max-width: 100%;
}
.datesrow{
	display: flex;
	padding:14px;
	margin-top:15px;
	box-shadow: 0 0 4px #888;
	justify-content: center;
}
.dates{
	padding:15px;
	font-size: 16px;
	color:#fff;
	border-radius: 4px;
	background-color: #f90;
	margin:5px;
}
.dates>a{
	text-decoration: none;
	color:#fff;
}
.alert>a{
	color:red;
	font-weight: 500;
}
</style>
<div class="container-fluid"><br>
	<div class="alert alert-info">
	Dear Participants, Download "Edmingle App" for live sessions of workshop. <a style="text-decoration:underline" href="https://play.google.com/store/apps/details?id=com.edmingle.engageapp&hl=en">"click here"</a> to download.
	To login into edmingle use User Name - "Registered Father's mobile No" Password - "pinnacle1234".
	For more details on edmingle <a href="https://docs.google.com/document/d/1xnP1WWm6HwAI8R7KQdaBiYUnou0rvfN0uL9i6jWhvHg/edit" style="text-decoration:underline">"click here"</a>
	</div>
</div>

<div class="row mainr">
	<div class="col-sm-9">
		<div id="todayitems">
			<div class="title-up"><?php if(isset($images[0])) {echo $images[0]->datetime;} ?></div>
			<div class="owl-carousel it">
				<?php foreach ($images as $v) { if($v->main==1)continue; ?>
				<div class="item">
					<div class="single-it">
						<img src="<?=base_url().$v->image?>">
					</div>
				</div>
			<?php } ?>	
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div id="updates">
			<div class="title-up">Itinerary</div>
			<?php if(isset($images[0])) {?>
				<img src="<?=base_url().$images[0]->image?>">
			<?php }?>
		</div>
	</div>
</div>

<div class="datesrow">
	<?php foreach ($dates as $v) {?>
		<div class="dates"><a href="<?=base_url()?>workshop/updates/<?=$v->datetime?>"><?=$v->showdate?></a></div>
	<?php }?>
</div>
