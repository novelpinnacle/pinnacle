<style>
	.dashboard-boxes{
		background: #fff;
		height:auto;
		padding:10px;
	}
	.profile-width{
		width:37.33%;
	}
	.profile-width-2{
		width:61.66%;
	}

	#profile-image-wrapper{
		
	}
	.profiletable{
		width: 100%;
		margin-top: 10px;
		table-layout: fixed;
		border-collapse: collapse;
	}
	.single th{
		width: 30%;
	}
	.profiletable th,.profiletable td{
		padding:2px;
		border-bottom: 1px solid #e7e7e7;
		font-size: 14px;
	}
	#notification-box{
		height:68%;
		padding: 10px;
		border:.5px solid #e6e6e6;
		border-bottom-width: .25px;
	}
	#notis{
		overflow-y: auto;
		height: 140px;
		
		padding:5px;
	}
	#attendance-box{
		height: 32%;
		padding: 10px;
		border:.5px solid #e6e6e6;
	}

	.notice{
		background: #fff;
		padding:4px;
		box-shadow: 0 0 2px rgba(0,0,0,0.25);
		margin-bottom: 10px;
		color:#555;
	}
	.notice:last-child{
		margin-bottom: 0;
	}
	.noticefooter{
		background: #fff;
		padding-top:5px;
		border-top:1px solid #ddd;
		color:#888;
		font-size: 12px;
	}
	.box-label{
		font-size: 17px;
		display: inline-block;
		border-bottom: 1px solid #333;
		text-align: center;
	}
	#percent-wrapper{
		height:30px;
		width:100%;
		overflow: hidden;
		margin-top: 10px;
		border:1px solid #f2f2f2;
	}
	#present,#absent{
		height: 28px;
		float: left;
		color:#fff;
	}
	#present{
		background: green;	
	}
	#absent{
		background: red;
	}
	.row.labels{
		font-size: 1.25em;
		margin-top: 10px;
	}
	#examname-title{
		padding-left: 15px;
	}
	@media screen and (max-width: 768px){
		.profile-width-2,.profile-width{
			width: 100%;
			padding:0;	
		}
		.row.labels{
			font-size: 10px;
		}
		#examname-title{
			padding-left: 10px;
		}
	}
</style>
<div id="content">
	<div class='container-fluid'>
		<div class="row">
			<div class="col-sm-6">
				<div class="dashboard-boxes">
					<div class="row">
						<div class="col-sm-4 profile-width">
							<div id="profile-image-wrapper" >
							<?php if($profile->image!="no") {?>
								<img src="<?=base_url().$profile->image?>" class="img-responsive">
							<?php }
									?>
							</div>
						</div>
						<div class="col-sm-8 profile-width-2">
								<table class='profiletable single'>
									<tr><th>Name</th><td><?=$profile->name?></td></tr>
									<tr><th>Roll No.</th><td><?=$profile->rollno?></td></tr>
									<tr><th>Phone</th><td><?=$profile->phone?></td></tr>
									<tr><th>Email</th><td><?=$profile->email?></td></tr>
									<tr><th>Course</th><td><?=$profile->coursename?></td></tr>
									<tr><th>Batch</th><td><?=$profile->batchname?></td></tr>
									<tr><th>Session</th><td><?=$profile->fy?></td></tr>
								</table>
						</div>
					</div>
					<table class='profiletable hidden-xs'>
						<tr><th>Father Name</th><td><?=$profile->fname?></td><th>Father Mobile</th><td><?=$profile->fmobile?></td></tr>
						<tr><th>D.O.B</th><td><?=$profile->dob?></td><th>Gender</th><td><?=$profile->gender?></td></tr>
						<tr><th>City</th><td><?=$profile->city?></td><td></td><td></td></tr>
					</table>
					<table class='profiletable visible-xs'>
						<tr><th>Father Name</th><td><?=$profile->fname?></td></tr>
						<tr><th>Father Mobile</th><td><?=$profile->fmobile?></td></tr>
						<tr><th>D.O.B</th><td><?=$profile->dob?></td></tr><tr>
						<tr><th>Gender</th><td><?=$profile->gender?></td></tr>
						<tr><th>City</th><td><?=$profile->city?></td></tr>
					</table>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="dashboard-boxes" style="height:303px;">
					<div id="notification-box">
						<div class="text-center" style="margin-bottom:10px">
							<div class="box-label">Noticeboard</div>
						</div>
						<div id="notis">
						<?php 
							foreach ($noticeboard as $v) {
								$by=$v->name;
								if($v->name==null){
									$by=$v->uname;
								}
								if($v->uname==null && $v->name==null){
									$by="Admin";
								}
								echo "<div class='notice'>$v->content <div class='noticefooter'><b>By : </b> $by $v->datetime </div></div>";
							}
						?>
						</div>

					</div>
					<div id="attendance-box">
						<div class="text-center">
							<div class="box-label">Attendance Percentage</div>
							
							<div id="percent-wrapper">
								<div id="present" style="width:<?=$attendance?>%"><?=$attendance?>%</div>
								<div id="absent" style="width:<?=100-$attendance?>%"><?=100-$attendance?>%</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div  class="col-sm-12" style="margin-top:20px;display:<?=$exams?'block':'none'?>">
				<div class="dashboard-boxes">
					<div class="text-center">
						<div class="box-label">
							Test Reports
						</div>
				    </div> 
				    <div class="row labels">
				    	<div class="col-xs-3 wp">
				    		<div id='examname-title'>Exam Name</div>
				    	</div>
				    	<div class="col-xs-3 wp">
				    		<div class="text-center">Percentage</div>
				    	</div>
				    	<div class="col-xs-3 wp">
				    		<div class="text-center">Marks</div>
				    	</div>
				    	<div class="col-xs-3 wp">
				    		<div class="text-right" style="padding-right:15px">Rank</div>
				    	</div>
				    </div>
				    <div class="panel-group" id="accordion" style="margin-top:10px">
							<?php foreach($exams as $v){?>
							
					          <div class="panel panel-default" style="margin-top:5px">
						            
						            <div class="panel-heading">
						            	<a style="text-decoration:none" data-toggle="collapse" data-parent="#accordion" href="#col<?=$v->exam_id?>">
							              <h4 class="panel-title">
							                  <div class="row">
							                  	<div class="col-xs-3 wp">
							                  		<div><?=$v->examname?></div>
							                  	</div>
							                  	<div class="col-xs-3 wp text-center">
							                  		<div ><?=round(($v->marks/$v->totalmarks)*100)?>%</div>
							                  	</div>
							                  	<div class="col-xs-3 wp text-center">
							                  		<div><?=$v->marks.'/'.$v->totalmarks?></div>
							                  	</div>
							                  	<div class="col-xs-3 wp text-right">
							                  		<div>
							                  		<?php
							                  			$CI =& get_Instance();
							                  			$CI->load->library("ranks");
							                  			echo $CI->ranks->getOverAllRank($v->exam_id,$v->marks);

							                  		?>		
							                  		</div>
							                  	</div>
							                  </div>
							              </h4>
							              </a>
						            </div>
						     
						            <div id="col<?=$v->exam_id?>" class="panel-collapse collapse">
							              <div class="panel-body">
							              	<table class="sc-table">

							              	<tr><th>Subject</th><th>Marks</th>
							              <?php if($v->category==1){ ?>	<th>Correct</th><th>Wrong</th>
							              	<?php }?>
							              	<th>Total</th><th>Rank</th></tr>
							              	<?php 
							              	$CI->load->library("studentlibrary");
							              	$result=$CI->studentlibrary->getSubjectMarks($v->exam_id);
							              	foreach ($result as $val) {

							              		echo "<tr><td>$val->subject</td><td>$val->marks</td>";
							              		if($v->category==1){echo "<td>$val->correct</td><td>$val->wrong</td>";}
							              		echo "<td>$val->totalmarks</td><td>".$CI->ranks->getRank($val->eid,$val->subjectid,$val->marks)."</td></tr>";
							              	}
							              	?>
							              	</table>
							              </div>
						            </div>
					          </div>
					          
					          <?php
					      }
					          ?>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>