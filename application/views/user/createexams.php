<div id="content">
	<div class="container-fluid">
		<div class="row">
			<?php if($this->permissions["exam_new"]==1) {?>
			<div class="col-sm-3 wp pr">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Add New Exam</h4>
					</div>
					<div class="mycardbody" style=''>
						<form id="form" action="<?=base_url()?>user/saveexam" method="post" autocomplete='off'>
						<div class='form-group'>
							<label class="w3-text-grey">Enter Exam Name</label>
								<input type='text' name="examname" class="w3-input w3-border" required>
						</div>
						<div class='form-group'>
							<label class="w3-text-grey">Enter Exam Code</label>
								<input type='text' name="examcode" class="w3-input w3-border" required>
						</div>
						<div class='form-group'>
							<label class="w3-text-grey">Select Category</label>
								<select name="category" class="w3-input w3-border" required>
								<option value="1">Objective</option>
								<option value="2">Subjective</option>
								</select>
						</div>	

							<div class='form-group'>
							<label class="w3-text-grey">Select Course</label>
								<select name="cid" class="w3-input w3-border" required onchange="loadBatches(this.value)">
								<option value="">Select Course</option>
								<?php 
								foreach ($courses as $v) {
									echo "<option value='$v->id'>$v->course</option>";
								}
								?>
								</select>
							</div>
							<div class='form-group'>
								<label class="w3-text-grey">Select Batch</label>
								<select name="bid" class="w3-input w3-border" required id="batch">
									<option value="">Select Batch</option>
								</select>
							</div>	
							<div class='form-group'>
								<label class="w3-text-grey">Exam Date</label>
								<input type='text' autocomplete="off" name="examdate" class="w3-input datepicker w3-border" required>
							</div>
							<div class="form-group">
							<input type="submit" value="Add Exam" class='fancy-btn small-btn' >
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php }?>
			<?php if($this->permissions["exam_see"]==1) {?>
			<div class='col-sm-9 wp pl'>
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Active Exams</h4>
					</div>
					<div class="mycardbody" style=''>
						<div class="table-wrapper" id="loadhere">
							<table class='sc-table'>
								<tr><th>Exam Name</th><th>Exam Code</th><th>Category</th><th>Course Batch</th><th>Subjects</th>
								<?php if($this->permissions["exam_edit"]==1) {?><th>Edit</th><?php }?>
								<?php if($this->permissions["exam_del"]==1) {?><th>Delete</th><?php }?>
								</tr>
								<?php
									$arr=["2"=>"Subjective","1"=>"Objective"];
									foreach ($exams as $v) {
										echo "<tr><td>$v->examname</td><td>$v->examcode</td><td>".$arr[$v->category]."</td><td>$v->course $v->batch</td><td>$v->subjects</td>";
										if($this->permissions["exam_edit"]==1) {
										echo "<td><a href='".base_url()."user/editexam/$v->id'><i class='fa fa-pencil'></i></a></td>";
										}
										if($this->permissions["exam_del"]==1) {
										echo "<td><i class='fa fa-remove ' onclick=\"showDelete($v->id,this)\"></i></td>";
										}
										echo "</tr>";
									}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</div>

<script>
var baseurl="<?=base_url()?>";

$('#form').submit(function(evt) {
        evt.preventDefault();
        $("#form input[type=submit]").attr("disabled",true);
        var formData = new FormData(this);
        $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data:formData,
        cache:false,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(data) {
         if(data.status=="ok"){
        	$("#form").trigger("reset");
        	refreshData();
         }
         $("#form input[type=submit]").attr("disabled",false);
         openModal({title:'Status',content:data.message});
        }
       });
  });

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
$.post({url:baseurl+'user/deleteexam',data:{'eid':eid},success:function(data){
ele.parentElement.parentElement.style.display='none';
}});
}

function loadBatches(cid){
$.post({url:baseurl+"user/getbatchesbycourseid",data:{'cid':cid},success:function(data){
$("#batch").html("<option value=''>Select Batch</option>"+data);
}}); 
}

function refreshData(){
$.post({url:baseurl+"user/refreshexams",success:function(data){
	$("#loadhere").html(data);
}});	
}

</script>