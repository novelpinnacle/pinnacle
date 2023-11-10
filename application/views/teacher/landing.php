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
	.profiletable th,.profiletable td{
		padding:2px;
		border-bottom: 1px solid #e7e7e7;
		font-size: 14px;
	}
	#notification-box{
		height:68%;
		padding: 10px;
		border:.5px solid #e6e6e6;
	}
	#notis{
		overflow-y: auto;
		height: 140px;
		padding:5px;
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

	.box-label{
		font-size: 17px;
		display: inline-block;
		border-bottom: 1px solid #333;
		text-align: center;
	}
	.row.labels{
		font-size: 20px;
		margin-top: 10px;
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
							<?php if($profile->image!="no"){?>
								<img src="<?=base_url().$profile->image?>" class="img-responsive">
							<?php }?>
							</div>
						</div>
						<div class="col-sm-8 profile-width-2">
								<table class='profiletable'>
									<tr><th>Name</th><td><?=$profile->name?></td></tr>
									<tr><th>Phone</th><td><?=$profile->phone?></td></tr>
									<tr><th>Email</th><td><?=$profile->email?></td></tr>
								</table>
						</div>
					</div>
					<table class='profiletable'>
						<tr><th>D.O.B</th><td><?=$profile->dob?></td><th>Gender</th><td><?=$profile->gender?></td></tr>
					</table>

					<div class="box-label" style="margin-top:10px">
						Assigned Courses And Batches
					</div>
					<table class="profiletable">
						<tr><th>Course</th><th>Batch</th>
						<?php 
						foreach ($cb as $v) {
							echo "<tr><td>$v->course</td><td>$v->batch</td></tr>";
						}
						?>
					</table>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="dashboard-boxes">
					<div id="notification-box">
						<div class="text-center" style="margin-bottom:10px">
							<div class="box-label">To Do List</div>
						</div>
						<div id="notis">
							<?php 
							foreach ($schedule as $v) {
								echo "<div class='notice'>Your $v->subject Lecture in $v->course $v->batch from $v->printfrom to $v->printto </div>";
							}
							?>
							<?php 
							foreach ($admissions as $v) {
								echo "<div class='notice'>Call $v->name on $v->phone his enquiry is for Course $v->course in Session $v->academicyear.Child Name is $v->childname. Last Time Reponse Was $v->response </div>";
							}
							?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>