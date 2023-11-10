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
	td .sc-table th{
		border-top: none;
	}
</style>
<div id="content">
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Posted Homework</h4>
			</div>
			<div class="mycardbody">
				<div class='table-wrapper'>
				<table class='sc-table'>
				<tr><th>Subject</th><th>Chapter</th><th>Lecture, Exercise and Questions</th><th>Edit</th><th>Delete</th><th>Date</th></tr>	
				<?php
				$arr=[]; 

				foreach ($data as $v) {
					$gd=$v->data;

					$temp=explode("=", $gd);

						$str="<table class='sc-table'><tr><th>Lecture No.</th><th>Exercise</th><th>Questions</th><th>Action</th></tr>";
						$td="";
						foreach ($temp as $t) {
							if($t=="")continue;
							$lectureno=explode("-", $t)[0];
							$exer=explode("-", $t)[1];
							$ques=explode("-", $t)[2];
							$id=explode("-", $t)[3];
							$td.="<tr><td contentEditable onblur=\"updateData($id,'lectureno',this.innerText)\">$lectureno</td><td contentEditable  onblur=\"updateData($id,'exercise',this.innerText)\">$exer</td><td contentEditable  onblur=\"updateData($id,'questions',this.innerText)\">$ques</td><td><i class='fa fa-remove' onclick='deleteEntry($id,this)'></i></td></tr>";
						}
						$str.=$td;
						$str.="</table>";
						if($gd==null){$str="";}
					echo "<tr><td>$v->subject</td><td>$v->chapter</td><td style='padding:0px 0'>$str</td></td><td><a href='".base_url()."user/edithomework/$v->id'><i class='fa fa-pencil'></i></a></td><td><i class='fa fa-close' onclick=\"showDelete($v->id,this)\"></i></td><td>$v->datetime</td></tr>";
					$arr[]=$v->id;
				}
				 ?>
				</table>
				</div>	
			</div>
	</div>
</div>

<script>
var baseurl="<?=base_url()?>";
function deleteData(id,ele){
	$.post({url:baseurl+'user/deletehomework',data:{'id':id},success:function(data){
		if(JSON.parse(data).status){ ele.parentElement.parentElement.style.display='none';}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}
	}});
}
function deleteEntry(id,ele){
	$.post({url:baseurl+'user/deletehomeworkentry',data:{'id':id},success:function(data){
		if(JSON.parse(data).status){ ele.parentElement.parentElement.style.display='none';}
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

 function updateData(id,column,value){
 	$.post({url:baseurl+'user/updatehomeworkentry',data:{id:id,column:column,data:value},success:function(data){
			
	}});	
 }

</script>