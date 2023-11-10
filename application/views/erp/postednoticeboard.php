 <div id="content">
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Search Students</h4>
			</div>
			<div class="mycardbody">
				<div class='table-wrapper'>
					<table class='sc-table'>
					<tr><th>Date</th><th>Content</th><th>Upload By</th><th>Edit</th><th>Delete</th></tr>	
						
						<?php 
						foreach ($data as $v) {
							$name="";
							if($v->name1==null){
								$name=$v->name2;
							}
							if($v->name2==null){
								$name=$v->name1;
							}
							if($v->name1==null && $v->name2==null){
								$name="Admin";
							}
							echo "<tr><td>$v->date</td><td>$v->content</td><td>$name</td><td><a class='btn btn-default btn-sm' href='".base_url()."erp/editnoticeboard/$v->id'><i class='fa fa-pencil'></i></a></td><td><button  onclick=\"showDelete($v->id,this)\" class='btn btn-default btn-sm'><i class='fa fa-close'></i></button></td></tr>";
						}
						 ?>
					</table>
				</div>	
			</div>
	</div>
</div>

<script>
var baseurl="<?=base_url()?>";
function deleteData(nid,ele){
	$.post({url:baseurl+'erp/deletenoticeboard',data:{'nid':nid},success:function(data){
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
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