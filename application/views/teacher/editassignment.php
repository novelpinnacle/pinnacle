<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Edit Assignment</h4>
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>teacher/updateassignment">
				<input type="hidden" name="aid" value="<?=$assignment->id?>">
				<div class='form-group'>
					<label>Enter Title</label>
					<input type="text" name="title" value="<?=$assignment->title?>" class='w3-input w3-border'>
				</div>
				<div class="alert alert-info"><b>if you want to add subjects in Assignment then select the desired subjects.Otherwise leave it as it is.</b></div>
				<div id="base">
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
				<select class="w3-border w3-input subject" name='subject[]' id='subject'>
					<option value="">Select Subject</option>
				</select>
				</div>
				</div>
				<div class="col-sm-1 wp pl" style="position:relative;">
				<i class="fa fa-plus-square" style="font-size:30px;position:absolute;top:27px" onclick="addMore()"></i>
				</div>
				</div>
				</div>
				<div id="sample" ></div>	


				<div class='form-group'>
				<div class="alert alert-info"><b>If you want to change Assignment's file then select new file otherwise leave it as it is.</b></div>
				<div class="row">

					<div class='col-sm-3 wp pr'>
						<label>Choose File</label> 
						<input type="file" name="assignment" style='position: absolute;left:-2000px' id="tfile" onchange="$('#showselected').html('<b>Selected File:</b> '+this.files[0].name)" >

						<input type="button" class='fancy-btn small-btn btn-block' value="Choose File"  onclick="document.getElementById('tfile').click()" >
					</div>
						<div class='col-sm-3 wp'>
							<label>&nbsp; </label><br>
							<input type='submit' class='fancy-btn small-btn btn-block' value="Update">
						</div>
				</div>
				</div>
				<div class="form-group">
				<div id="showselected"></div>
				</div>			

				</form>
			</div>
		</div>
	</div>
</div>

<script >

var baseurl="<?=base_url()?>";
function loadSubjects(bid,ele){
	$.post({url:baseurl+"teacher/getassignedsubjects",data:{'bid':bid},success:function(data){
		ele.innerHTML=data;
	}}); 
}

n=1;
function addMore(){
	idd="id_"+n;
	n++;
	var div=document.createElement("div");
	div.setAttribute("id",idd);
	var rand=Math.floor(Math.random() * 100000);
	str=base.innerHTML.replace('id="subject"','id="rand'+rand+'"');
	str=str.replace('onchange="loadSubjects(this.value,subject)"','onchange="loadSubjects(this.value,rand'+rand+')"');
	str=str.replace("<p></p>","<i class='fa fa-minus-square' onclick=\"sample.removeChild(document.getElementById('"+idd+"'))\"></i>"); 
	div.innerHTML=str;
	sample.appendChild(div);

	$("#rand"+rand).html("<option value=''>Select Subject</option>");
}


$('#form').submit(function(evt) {
                evt.preventDefault();
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
                  	showselected.innerHTML="";
                  }
                   $("#alertDialog").html(data.message);
                   $("#alertDialog").dialog({title:'Alert'});
                },
                error: function(data) {
                	
                }
               });
  });

</script>