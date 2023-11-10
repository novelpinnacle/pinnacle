<style>
	.more-plus{
		position:absolute;top:5px;right:20px;font-size:18px;cursor:pointer;
	}
	.more-minus{
		position:absolute;top:5px;right:0px;font-size:18px;cursor:pointer
	}
</style>
<div id="content">
		<div class="row">
			<div class="col-sm-4 wp pr">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Add New Subjects</h4>
					</div>
					<div class="mycardbody" style=''>
						<form id="form" action="<?=base_url()?>erp/savesubject" method="post">
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

					<div id="addhere">
				
							<div class='form-group' style='position: relative;'>
							<label class="w3-text-grey">Subject Name</label>
							
							<i class='fa fa-plus' onclick="addMore()" style='position:absolute;right:0;font-size:18px;top:5px;cursor:pointer'></i>

								<input type="text" name="subject[]" class="w3-input w3-border" placeholder="Subject Name" required>
							</div>

					</div>


							<div class="form-group">
							<input type="submit" value="Submit" class="btn btn-default btn-sm pull-right">
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-8 wp pl slideshow-col">
				<div class="mycard">
					<div class="mycardheader b-primary">
						<h4 class="mycardtitle">Active Subjects</h4>
					</div>
					<div class="mycardbody">
					<div class='table-wrapper' id="loadtable">
						<?php include 'erp_common/subjects.php'; ?>
					</div>
					</div>
				</div>
			</div>

		</div>
</div>


<script src="<?=base_url()?>js/erp-add-common.js"></script>
<script>
var baseurl="<?=base_url()?>";

function loadBatches(cid){
	$.post({url:baseurl+'erp/getbatchesbycourse',data:{'cid':cid},success:function(data){
		$("#batch").html("<option value=''>Select Batch</option>"+data);
	}});
}

var n=1;
function addMore(){
	var ele=document.createElement("div");
	idd="id_"+n;
	ele.setAttribute("id",idd);
	ele.innerHTML=
	"<div class='form-group' style='position:relative'>"+
		"<label class='w3-text-grey'>Subject Name</label>"+
		  "<i class='fa fa-plus more-plus' onclick='addMore()'></i>"+
		  "<i class='fa fa-minus more-minus' onclick=\"addhere.removeChild(document.getElementById('"+idd+"'))\"></i>"+
		  "<input type='text' name='subject[]' class='w3-input w3-border' placeholder='Subject Name' required>"+
	"</div>";
	addhere.appendChild(ele);
	n++;
}

</script>

