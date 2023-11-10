<style>
	.fa-remove{
		cursor: pointer;
		color:red;
	}
</style>
<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Active Assignments</h4>
			</div>
			<div class="mycardbody">
			<div class="table-wrapper">
				<table class='sc-table'>
					<tr><th>Title</th><th>Courses,Batches and Subjects</th><th>Download</th>
					 <?php if($this->permissions["ass_del"]==1){?><th>Delete</th><?php }?>
					 <?php if($this->permissions["ass_edit"]==1){?><th>Edit</th><?php }?>
					<th>Date</th></tr>
					<?php 
					foreach ($assignments as $v) {
						echo "<tr><td>$v->title</td><td><table class='sc-table'><tr><th>Batch</th><th>Subject</th>";
						if($this->permissions["ass_del"]==1){ echo "<th>Delete</th>";}
						echo "</tr>$v->cbs</table></td><td><a href='".base_url().$v->path."'><i class='fa fa-download'></i></a></td>";
						if($this->permissions["ass_del"]==1){
							echo "<td><i class='fa fa-remove' onclick=\"showDelete($v->id,this)\"></i></td>";
						}
						if($this->permissions["ass_edit"]==1){
							echo "<td><a href='".base_url()."user/editassignment/$v->id'><i class='fa fa-pencil'></i></a></td>";
						}

						echo "<td>$v->datetime</td></tr>";
					}
					?>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>

<script>
var baseurl="<?=base_url()?>";

	function showDelete(delid,ele){
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      modal:true,
      buttons: {
        "Delete": function() {
        deleteData(delid,ele);
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
 }


function deleteData(eid,ele){
$.post({url:baseurl+'user/deleteassignment',data:{'eid':eid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}

	function showDelete2(delid,ele){
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      modal:true,
      buttons: {
        "Delete": function() {
        deleteData2(delid,ele);
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
 }

 function deleteData2(eid,ele){
$.post({url:baseurl+'user/deleteassignmentsubject',data:{'eid':eid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}


</script>