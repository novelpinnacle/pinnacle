<div id="content">
<div class='container-fluid'>
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Posted Noticeboards</h4>
			</div>
			<div class="mycardbody">
				<div class='table-wrapper'>
				<table class='sc-table'>
				<tr><th>Date</th><th>Content</th><th>Courses</th><th>Edit</th><th>Delete</th></tr>	
				<?php 
				foreach ($data as $v) {
					
					echo "<tr><td>$v->date</td><td>$v->content</td><td>$v->courses</td><td><a href='".base_url()."teacher/editnoticeboard/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick=\"showDelete($v->id,this)\"></i></td></tr>";
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
function deleteData(nid,ele){
$.post({url:baseurl+'teacher/deletenoticeboard',data:{'nid':nid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}
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

</script>