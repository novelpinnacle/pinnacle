<style>
.flex-row{
	display: flex;
	flex-wrap: wrap;
}
.box-wrapper{
//	width:33.33%;
	padding:0 10px;
	margin-bottom: 20px;
}
.box{
	background-color: #fff;
	border-radius: 5px;
}
.box-content {
	padding:40px;
	text-align: center;
		font-size: 60px;
	font-weight: 500;
}

.box-footer{
	position: relative;
	color:#fff;
	font-size: 18px;
	padding:10px 20px;
	background: #380202;
	border-radius: 0 0 5px 5px;
}
.box-footer a{
	position: absolute;
	right:10px;
	top:8px;
}
.box-footer button{
	position: absolute;
	right:50px;
	top:8px;
}
@media screen and (max-width: 768px){
	.box-wrapper{
	//	width: 100%;
	}
}
#info{
	display: none;
}
</style>
<div id="content">
	<div class="flex-row">
		<div class='box-wrapper col-xs-12 col-sm-4'>
			<div class="box">
				<div class='box-content'>
					<?=$students?>
				</div>
				<div class="box-footer">
					Students Count <button onclick="loadDashboardInfo('student-count')" class='btn btn-default btn-sm'><i class='fa fa-eye'></i></button> <a href="<?=base_url()?>erp/addstudents" class='btn btn-default btn-sm'><i class='fa fa-plus'></i></a>
				</div>
			</div>
		</div>
		<div class='box-wrapper col-xs-12 col-sm-4'>
			<div class="box">
				<div class="box-content">
					<?=$teachers?>
				</div>
				<div class="box-footer">
					Teacher Count <a href="<?=base_url()?>erp/addteachers" class='btn btn-default btn-sm'><i class='fa fa-plus'></i></a>
				</div>
			</div>
		</div>
		<div class='box-wrapper col-xs-12 col-sm-4'>
			<div class="box">
				<div class="box-content">
				<?=$staff?>
				</div>
				<div class="box-footer">
					Staff Count <a href="<?=base_url()?>erp/adduser" class='btn btn-default btn-sm'><i class='fa fa-plus'></i></a>
				</div>
			</div>
		</div>
		<div class='box-wrapper col-xs-12 col-sm-4'>
			<div class="box">
				<div class="box-content">
					<?=$contact?>
				</div>
				<div class="box-footer">
					Contact Enqueries
				</div>
			</div>
		</div>
		<div class='box-wrapper col-xs-12 col-sm-4'>
			<div class="box">
				<div class="box-content">
					<?=$videos?>
				</div>
				<div class="box-footer">
					Video Courses  <button onclick="loadDashboardInfo('video-count','video')" class='btn btn-default btn-sm'><i class='fa fa-eye'></i></button>  <a href="<?=base_url()?>erp/videolectures" class='btn btn-default btn-sm'><i class='fa fa-plus'></i></a>
				</div>
			</div>
		</div>
		<div class='box-wrapper col-xs-12 col-sm-4'>
			<div class="box">
				<div class="box-content">
					<?=$notes?>
				</div>
				<div class="box-footer">
					PDF Notes <button onclick="loadDashboardInfo('video-count','pdf')" class='btn btn-default btn-sm'><i class='fa fa-eye'></i></button> <a href="<?=base_url()?>erp/lecturenotes" class='btn btn-default btn-sm'><i class='fa fa-plus'></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="mycard" id="info">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle" id="infotitle"></h4>
		</div>
		<div class="mycardbody" id="setinfo">

		</div>
	</div>

</div>

<script>
	var baseurl="<?=base_url()?>";
	function loadDashboardInfo(type,cat=""){
		$("#loading").show();
		$.get({url:baseurl+"erp/loaddashboardinfo/"+type+"/"+cat,dataType:'json',success:function(data){
			$("#loading").hide();
			info.style.display='block';
			if(type=="student-count"){
				processStudentCount(data);
			}
			if(type=="video-count"){
				processVideoCount(data,cat);
			}

		}});
	}

	function processStudentCount(data){
		infotitle.innerHTML='Students Count By Course &amp; Batch ';
		var table="<table class='sc-table'><tr><th>Course</th><th>Batch</th><th>Count</th></tr>";
			for(let d of data){
				var tr="<tr>";
				tr+="<td>"+d.course+"</td>";
				tr+="<td>"+d.batch+"</td>";
				tr+="<td>"+d.cnt+"</td></tr>";
				table+=tr;
			}
			table+="</table>";
			setinfo.innerHTML=table;
	}

	function processVideoCount(data,cat){
		infotitle.innerHTML=(cat=='video'?'Videos':'Notes')+' Count By Course,Batch  &amp; Subject ';
		var table="<table class='sc-table'><tr><th>Course</th><th>Batch</th><th>Subject</th><th>Count</th></tr>";
			for(let d of data){
				var tr="<tr>";
				tr+="<td>"+d.course+"</td>";
				tr+="<td>"+d.batch+"</td>";
				tr+="<td>"+d.subject+"</td>";
				tr+="<td>"+d.cnt+"</td></tr>";
				table+=tr;
			}
			table+="</table>";
			setinfo.innerHTML=table;
	}

</script>