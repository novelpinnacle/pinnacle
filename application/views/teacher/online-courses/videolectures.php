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
</style>

<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Video Lectures</h4>
		</div>
		<div class="mycardbody">
			<form id="form" action="<?=base_url()?>teacher/getLecturesByCBS/video">
				<div class="row">
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Select Batch</label>
							<select id="batch" class="w3-border w3-input batch" name="batch[]" onchange="loadSubjects(this.value,subject)">
								<option value="">Select Batch</option>
								<?php
								foreach ($batches as $v) {
									echo "<option value='$v->id'>$v->batch</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="col-sm-3 wp pl">
						<div class="form-group">
							<label>Select Subject</label>
							<select class="w3-border w3-input subject" id='subject'>
								<option value="">Select Subject</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2 wp pl">
						<div class="form-group">
							<label>&nbsp; </label><br>
							<input type="button" onclick="loadData()" value="Search" class="btn btn-default btn-sm" >
						</div>
					</div>
				</div>
			</form>
			<div class="table-wrapper" style="max-height:75vh;">
				<table class="sc-table load" id="setvideolecture">
					
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="lectureModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title" id="lecturetitle"></h4>
        </div>
        <div class="modal-body">
     	 	<iframe id="lectureIframe" style="width:100%;height:400px" frameborder="0"></iframe>   
        </div>
      </div>
    </div>
</div>

<script>
var baseurl="<?=base_url()?>";

function loadSubjects(bid,ele){
	if(bid==""){ele.innerHTML="<option value=''>Select Subject</option>"; return;}
	$.post({url:baseurl+"teacher/getassignedsubjects",data:{'bid':bid},success:function(data){
		ele.innerHTML=data;
	}}); 
}

function loadData(){
	$.post({url:baseurl+"teacher/getLecturesByCBS/video",data:{'bid':batch.value,'sid':subject.value},success:function(data){
		setvideolecture.innerHTML=data;
	}});
}

function showLecture(src,title){
	lecturetitle.innerHTML=atob(title);
	lectureIframe.src="https://www.youtube.com/embed/"+src;
	$("#lectureModal").modal();
}


</script>