<style>
.row.labels{
		font-size: 20px;
		margin-top: 10px;
	}
	.box-label{
		font-size: 17px;
		display: inline-block;
		border-bottom: 1px solid #333;
		text-align: center;
	}
</style>
<div id="content">
	<div class="container-fluid">
		<?php 
			if(!$exams){
				echo "<div class='alert alert-danger'>No Exams Available</div>";
			}
		?>
		<div class="mycard"  style="display:<?=$exams?'block':'none'?>" >
				<div class="mycardheader b-primary">
					<h4 class="mycardtitle">Tests</h4>
				</div>
				<div class="mycardbody"> 
					<div class="row labels">
						<div class="col-sm-3">
							<div style="padding-left:15px">Exam Name</div>
						</div>
						<div class="col-sm-3">
							<div class="text-center">Percentage</div>
						</div>
						<div class="col-sm-3">
							<div class="text-center">Marks</div>
						</div>
						<div class="col-sm-3">
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
							                  	<div class="col-sm-3">
							                  		<div><?=$v->examname?></div>
							                  	</div>
							                  	<div class="col-sm-3 text-center">
							                  		<div ><?=round(($v->marks/$v->totalmarks)*100)?>%</div>
							                  	</div>
							                  	<div class="col-sm-3 text-center">
							                  		<div><?=$v->marks.'/'.$v->totalmarks?></div>
							                  	</div>
							                  	<div class="col-sm-3 text-right">
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