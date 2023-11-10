<div id="content">
	<div class='container-fluid'>
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Assignments</h4>
			</div>
			<div class="mycardbody">
			<div class='table-wrapper'>
				<table class='sc-table'>
					<tr><th>Title</th><th>Subject</th><th>Download</th><th>By</th><th>Date</th></tr>
					<?php 
					foreach ($data as $v) {
						$name=!$v->name?$v->uname:$v->name;
						echo "<tr><td>$v->title</td><td>$v->subject</td><td><a href='".base_url().$v->path."'><i class='fa fa-download'></i></a></td><td>$name</td><td>$v->datetime</td></tr>";
					}
					?>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>