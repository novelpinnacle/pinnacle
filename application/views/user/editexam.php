<?php if($exam){?>
<style>
	.examsubs{
		margin-bottom: 5px;
		font-size:16px;
	}
	.examsubs>div{
		float: left;
		width: 50%;
	}
	.examsubs i.fa{
		color:red;
		display: inline-block;
		padding: 6px 10px;
		background-color: #f00;
		color:#fff;
		cursor: pointer;	
	}
</style>
<div id="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Edit Exam <b><?=$exam->examname?></b></h4>
					</div>
					<div class="mycardbody">
					<form id="form">
						<div class='form-group'>
							<label>Exam Name</label>
							<input type="text" name="examname" class='w3-input w3-border' value="<?=$exam->examname?>">
						</div>
						<div class="form-group">
							<label>Exam Date</label>
							<input type="text" name="examdate" class="w3-input w3-border datepicker" value="<?=$exam->examdate?>">
						</div>
						<div class='form-group'>
							<label>Category</label>
							<select  name="category" class='w3-input w3-border'>
							<option value="1" <?=$exam->category=='1'?'selected':''?> >Objective</option>
							<option value="2" <?=$exam->category=='2'?'selected':''?> >Subjective</option>
							</select>
						</div>
						<input type="hidden" name="id" value="<?=$exam->id?>">
						<div class='form-group'>
						<label>Subjects</label>
						<div class='table-wrapper'>
							<table class='sc-table'>
							<tr><th>Subject</th><th>Pass Marks</th><th>Total Marks</th><th>Delete</th></tr>
							<?php
							foreach ($subjects as $v) {
								echo "<tr><td>$v->subject</td><td><input class='w3-input w3-border' value='$v->passmarks' name='passmarks-$v->id'></td><td><input class='w3-input w3-border' value='$v->totalmarks' name='totalmarks-$v->id'></td><td><i class='fa fa-close' onclick=\"showDelete($v->id,this)\"></i></td></tr>";
							}
							 ?>
							 </table>
							 </div>
						</div>

						<div class='form-group' >
							<input type="button" onclick="updateExam()" class='fancy-btn small-btn' value="Update Exam" >
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var baseurl="<?=base_url()?>";

function updateExam(){
$.post({url:baseurl+'user/updateexam',cache:false,dataType: 'json',data:$("#form").serialize(),success:function(data){
	  	 openModal({title:'Status',content:data.message});
}});	
}

function deleteData(eid,ele){
$.post({url:baseurl+'user/deleteexamcb',data:{'ecbid':eid},success:function(data){
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
 <?php }else{echo "<div id='content'><div class='container-fluid'><div class='alert alert-danger'>Exam is not Found</div></div></div>";}?>