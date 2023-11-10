<style>
	.fa-remove{
		cursor: pointer;
		color:red;
	}

	td .sc-table tr:last-child td{
		border-bottom:none;
	}

	td .sc-table th,td .sc-table td{
		padding: 1 10px;
		line-height: 1.4em;
		font-size: 12px;
		border:1px solid #ddd;
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
					<tr><th>Title</th><th >Batches and Subjects</th><th>Download</th><th>Delete</th><th>Edit</th><th>Date</th></tr>
					<?php 
					foreach ($assignments as $v) {
						echo "<tr><td>$v->title</td><td style='padding:4px 0px'><table class='sc-table'><tr><th>Batch</th><th>Subject</th><th>Delete</th></tr>$v->cbs</table></td><td><a href='".base_url().$v->path."'><i class='fa fa-download'></i></a></td><td><i class='fa fa-remove' onclick=\"showDelete($v->id,this)\"></i></td><td><a href='".base_url()."teacher/editassignment/$v->id'><i class='fa fa-pencil'></i></a></td><td>$v->datetime</td></tr>";
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
$.post({url:baseurl+'teacher/deleteassignment',data:{'eid':eid},success:function(data){
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
$.post({url:baseurl+'teacher/deleteassignmentsubject',data:{'eid':eid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}


</script>