<div id="content">
<div class='container-fluid'>
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Search Students</h4>
			</div>
			<div class="mycardbody">
				<div class='table-wrapper'>
				<table class='sc-table'>
				<tr><th>Date</th><th>Content</th><th>Courses</th>
				<?php if($this->permissions["nb_edit"]==1) {?>
				<th>Edit</th>
				<?php }?>
				<?php if($this->permissions["nb_del"]==1) {?>
				<th>Delete</th>
				<?php }?>
				</tr>	
				<?php 
				foreach ($data as $v) {
					
					echo "<tr><td>$v->date</td><td>$v->content</td><td>$v->courses</td>";
					if($this->permissions["nb_edit"]==1) {
						echo "<td><a href='".base_url()."user/editnoticeboard/$v->id'><i class='fa fa-pencil'></i></a></td>";
					}
					if($this->permissions["nb_del"]==1) {
						echo "<td><i class='fa fa-close' onclick=\"showDelete($v->id,this)\"></i></td>";
					}
					echo "</tr>";
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
$.post({url:baseurl+'user/deletenoticeboard',data:{'nid':nid},success:function(data){
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