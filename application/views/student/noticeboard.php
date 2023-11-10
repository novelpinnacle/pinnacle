<style>
	.notice{
		background: #fff;
		padding:10px;
		padding-bottom: 5px;
		box-shadow: 0 0 4px rgba(0,0,0,0.25);
		margin-bottom: 20px;
		color:#555;
	}
	.noticefooter{
		background: #fff;
		padding-top:5px;
		border-top:1px solid #ddd;
		color:#888;
		font-size: 12px;
	}
</style>
<div id="content">
<div class='container-fluid'>
<?php
	foreach ($data as $v) {
		if($v->name==null){$v->name="Admin";}
		echo "<div class='notice'>$v->content <div class='noticefooter'><b>By : </b> $v->name $v->datetime </div></div>";
	}
?>
</div>
</div>