<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Workshop Entries</h4>
		</div>
		<div class="mycardbody">
			<div class='table-wrapper'>
				<table class='sc-table'>
					<tr><th>Name</th><th>F Name</th><th>F Mobile</th><th>Email</th><th>Phone</th><th>Class</th><th>School</th><th>City</th><th>Address</th></tr>
				<?php
				foreach ($workshop as $v) {
					echo "<tr><td>$v->name</td><td>$v->fname</td><td>$v->fmobile</td><td>$v->email</td><td>$v->phone</td><td>$v->class</td><td>$v->school</td><td>$v->city</td><td>$v->address</td></tr>";
				}
				 ?>
				</table>
			</div>
		</div>
	</div>
</div>