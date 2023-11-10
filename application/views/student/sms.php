<div id="content">
	<div class='container-fluid'>
	<div style="display:<?=$sms?'none':'block'?>" class="alert alert-danger">No Records Found</div>
		<div class="mycard" style="display:<?=$sms?'block':'none'?>">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">SMSs Recieved for Exam Reports</h4>
			</div>
			<div class="mycardbody">
				<table class="sc-table">
					<tr><th>Exam Name</th><th>Message</th><th>Mobile</th><th>SMS Date</th><th>Exam Date</th></tr>
					<?php
						foreach ($sms as  $v) {
							echo "<tr><td>$v->examname</td><td>$v->msg</td><td>$v->number</td><td>$v->smsdate</td><td>$v->examdate</td</tr>";
						}
					 ?>
				</table>
			</div>
		</div>
	</div>
</div>