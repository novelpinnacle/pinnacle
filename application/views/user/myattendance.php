<?php include 'css/panel/teacherattendance.php'; ?>
<style>
.entries{
	padding:10px;
	box-shadow: 0 0 3px #888;
	margin-bottom:15px;
	border-radius: 4px;
}
#det{
	display: none;
}
</style>
<div id="content">
	<div class='container-fluid'>
		<div class="mycard">
			<div class="mycardheader b-primary">
					<h4 class="mycardtitle">Attendance</h4>
			</div>
			<div class="mycardbody">
				<div class="row">
					<div class="col-sm-6 wp pr">
						<?php
							$CI =& get_Instance();
							$CI->load->library("teacherattendance");
							echo $CI->teacherattendance->show($attendance);
						?>
					</div>
					<div class="col-sm-6 wp pl">
						<div class="mycard" id='det'>
							<div class="mycardheader b-primary">
								<h4 class="mycardtitle">Detail</h4>
							</div>
							<div class="mycardbody" id="loadhere">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var baseurl="<?=base_url()?>";
	function loadDetails(date){
		$.post({url:baseurl+'user/attendancebydate',data:{'date':date},success:function(data){
			createView(JSON.parse(data));
		}});
	}

	function createView(data){

		loadhere.innerHTML="";
		det.style.display=data.length?'block':'none';
		for(let e of data){
			let entry="<div class='entries'>"+e.fdate+"</div>";
			loadhere.innerHTML+=entry;
		}

	}

</script>