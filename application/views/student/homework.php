<style>
	td .sc-table tr:last-child td{
		border-bottom:none;
	}

	td .sc-table th,td .sc-table td{
		padding: 1 10px;
		line-height: 1.4em;
		font-size: 12px;
		border:1px solid #ddd;
	}


	.mob{
		margin-bottom: 20px;
		box-shadow: 0 0 5px 0px rgba(0,0,0,.25);
	}
	.mob td{
		border:1px solid #ddd;
	}
	.sc-table.in th{	
		border-top:none;
	}
	.sc-table.in th:first-child{
		border-left: none;
	}
	.sc-table.in th:last-child{
		border-right: none;
	}
	.sc-table.in td:first-child{
		border-left: none;
	}
	.sc-table.in td:last-child{
		border-right: none;
	}
</style>
<div id="content">
<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Homework</h4>
			</div>
			<div class="mycardbody">
			<?php if(!isMobile()){?>
				<div class='table-wrapper'>
					<table class='sc-table'>
						<tr><th>Subject</th><th>Chapter</th><th>Lecture,Exercise and Question</th></tr>	
						<?php
						
						foreach ($data as $v) {
							$gd=$v->data;
							$temp=explode("=", $gd);
								$str="<table class='sc-table'><tr><th>Lecture No.</th><th>Exercise</th><th>Questions</th></tr>";
								$td="";
								foreach ($temp as $t) {
									$lectureno=explode("-", $t)[0];
									$exer=explode("-", $t)[1];
									$ques=explode("-", $t)[2];
									$td.="<tr><td>$lectureno</td><td>$exer</td><td>$ques</td></tr>";
								}
								$str.=$td;
								$str.="</table>";
							echo "<tr><td>$v->subject</td><td>$v->chapter</td><td style='padding:4px 0'>$str</td></td></tr>";
							
						}
						 ?>
					</table>
				</div>	
			<?php } else{?>

					<?php 
						foreach ($data as $v) {
							$gd=$v->data;
							$temp=explode("=", $gd);
							$tr="";
							foreach ($temp as $t) {
									$lectureno=explode("-", $t)[0];
									$exer=explode("-", $t)[1];
									$ques=explode("-", $t)[2];
								$tr.="<tr><td>$lectureno</td><td>$exer</td><td>$ques</td></tr>";
							}
							echo "<table class='sc-table mob'>";
							echo "<tr><th>Subject</th><th>Chapter</th></tr>";
							echo "<tr><td>$v->subject</td><td>$v->chapter</td></tr>";	
							echo "<tr><td colspan=2 style=padding:0><table class='sc-table in'><tr><th>Lecture</th><th>Exercise</th><th>Chapter</th></tr>$tr</table></td></tr>";
							echo "</table>";
						}
					?>


				<?php }?>
			</div>
	</div>
</div>