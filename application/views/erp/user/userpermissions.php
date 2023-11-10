<style>
body{
	background-color: #fff;
}
[type=checkbox]{
	width: 17px;
	height: 17px;
	position: relative;
	top: 4px;
}
.panel-body{
	padding:10px 15px;
}
label{
	font-weight: 400;
}
</style>
<div id="content">
	<div class="mycard">
	   	<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Update Permissions of <?=$user_id?></h4>
		</div>
		<div class="mycardbody">			
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">Attendance Permissions</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['att_new']?'checked':''?> value="att_new" > New</label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['att_see']?'checked':''?> value='att_see' > See</label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['att_edit']?'checked':''?> value="att_edit" > Edit</label>
							</div>
							<!-- <div class="col-sm-3">
								<label><input type="checkbox"  value="" > Delete</label>
							</div> -->
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Noticeboard Permissions</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['nb_new']?'checked':''?> value="nb_new"  > New </label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['nb_see']?'checked':''?> value="nb_see" > See</label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['nb_edit']?'checked':''?> value="nb_edit" > Edit</label>
							</div>
							 <div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['nb_del']?'checked':''?> value="nb_del" > Delete</label>
							</div> 
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Timetable Permissions</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['tt_new']?'checked':''?> value="tt_new" > New </label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['tt_see']?'checked':''?> value="tt_see" > See</label>
							</div>
							<!-- <div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['tt_edit']?'checked':''?> value="tt_edit" > Edit</label>
							</div> -->
							 <div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['tt_del']?'checked':''?> value="tt_del" > Delete</label>
							</div>  
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Exam Permissions</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['exam_new']?'checked':''?> value="exam_new" > New </label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['exam_see']?'checked':''?> value="exam_see" > See</label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['exam_edit']?'checked':''?> value="exam_edit" > Edit</label>
							</div>
							 <div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['exam_del']?'checked':''?> value="exam_del" > Delete</label>
							</div> 
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['exam_ins']?'checked':''?> value="exam_ins" > Insert Marks</label>
							</div> 
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['exam_sms']?'checked':''?> value="exam_sms" > Send SMS</label>
							</div> 
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['marks_see']?'checked':''?> value="marks_see" > See Marks</label>
							</div> 
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Assignment Permissions</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['ass_new']?'checked':''?> value="ass_new" > New </label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['ass_see']?'checked':''?> value="ass_see" > See</label>
							</div>
							<div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['ass_edit']?'checked':''?> value="ass_edit" > Edit</label>
							</div>
							 <div class="col-sm-3">
								<label><input type="checkbox" <?=$permissions['ass_del']?'checked':''?>  value="ass_del" > Delete</label>
							</div> 
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<script>
var baseurl="<?=base_url()?>";
var user_id="<?=$user_id?>";
function updatePermission(per_name){
	$.post({url:baseurl+'erp/updatepermission',data:{'per_name':per_name,'user_id':user_id},success:function(data){
		
	}});
}

$('input[type=checkbox]').change(function(){
    updatePermission(this.value);
});

</script>