<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Contact Queries <span style=font-size:16px;></span></h4>
		</div>
		<div class="mycardbody">
			<div class='table-wrapper'>
				<table class='sc-table'>
					<tr><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Date</th><th>Delete</th></tr>
				<?php
				foreach ($data as $v) {
					echo "<tr><td>$v->name</td><td>$v->email</td><td>$v->phone</td><td>$v->message</td><td>$v->date</td><td><button class='btn btn-default btn-sm' onclick='deleteQuery($v->id,this)' ><span class='fa fa-remove'></span></button></td></tr>";
				}
				 ?>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
var baseurl="<?=base_url()?>";

function deleteQuery(id,ele){
	$.post({url:baseurl+'erp/deletequery',data:{'id':id},success:function(data){
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}

</script>