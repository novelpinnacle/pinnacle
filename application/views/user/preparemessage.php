<style>
#text{
	height:200px;
}
#showoutput{
	height:200px;
	padding: 5px 10px;
	border:1px solid #d7d7d7;
}
#tags{
	padding: 10px;
	background-color: var(--main-bg-color1);
	color:var(--main-bg-color2);
}
#tags-body{
	padding:10px;
	border:1px solid #f2f2f2;
}
#tags-body button{
	margin-bottom: 10px;
	margin-right: 5px;
}
.form-group{
	position: relative;
}
.tl{
	position: absolute;
	right: 0px;
	top:-5px;
	width: 200px;	
}
legend {
    width:inherit; /* Or auto */
    padding:0 4px; /* To give a bit of padding on the left and right */
    border-bottom:none;
    margin-bottom: 0;
    font-size: 14px;
}
</style>
<div id="content">
	<div class="container-fluid">
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Prepare &amp; Send Report [<?=$exam->examname?> - <?=$exam->course?>- <?=$exam->batch?>]</h4>
			</div>
			<div class="mycardbody">
				<div class="row">
					<div class="col-sm-8">
						<form id="form">
							<div class="form-group">
								<label>Type Report</label>
								
								<select class="w3-input w3-border tl" id='seltemp' onchange="setTemplate(this.value)">
									<option value="">Select Template</option>
									<?php 
									foreach ($templates as $v) {
										echo "<option value='".base64_encode($v->template)."-$v->id-$v->name'>$v->name</option>";
									}
									?>
								</select>
								
								<textarea class='w3-input w3-border' id="text" name="text" onkeyup="showOutput(this.value)"></textarea>
							</div>
							<input type="hidden" name="eid" value="<?=$examid?>">
							<div class="form-group">
								<label>Output</label>
								<div id="showoutput"></div>
							</div>
							<div class="form-group">
								<input type="button" id="sendreport" value="Send Report" onclick="$('#report-dialog').dialog()" class="w3-btn b-primary">
								<button onclick="event.preventDefault();showTemp();" class="w3-btn w3-border"><span class="glyphicon glyphicon-save"></span> Save Template</button>
								<button id="ut" style="display:none" class="w3-btn w3-border">Update Template</button>
							</div>
							<div id="status"></div>
						</form>
					</div>
					<div class="col-sm-4">
						<div id="tags">Tags Available</div>
						<div id="tags-body">
							<button class='btn btn-default' onclick="insertTag('<name>')">S.Name</button>
							<button class='btn btn-default' onclick="insertTag('<exam-name>')">Ex. Name</button>
							<button class='btn btn-default' onclick="insertTag('<exam-date>')">Ex. Date</button>
							<button class='btn btn-default' onclick="insertTag('<exam-rank>')">Ex. Rank</button>
							<button class='btn btn-default' onclick="insertTag('<exam-marks>')">Ex. Marks</button>
							<button class='btn btn-default' onclick="insertTag('<exam-total>')">Ex. Total</button>
							<?php $objective=$exam->category==1; foreach($subjects as $subject){?>
							<fieldset>
								<legend><?=ucfirst($subject)?></legend>
								<button class='btn btn-default' onclick="insertTag('<<?=$subject?>-marks>')">Marks</button>
								<?php if($objective) {?>
								<button class='btn btn-default' onclick="insertTag('<<?=$subject?>-correct>')">Correct</button>
								<button class='btn btn-default' onclick="insertTag('<<?=$subject?>-wrong>')">Wrong</button>
								<?php } ?>
								<button class='btn btn-default' onclick="insertTag('<<?=$subject?>-rank>')">Rank</button>
								<button class='btn btn-default' onclick="insertTag('<<?=$subject?>-percentage>')">%age</button>
								<button class='btn btn-default' onclick="insertTag('<<?=$subject?>-total>')">Total</button>
							</fieldset>
							<?php }?>
								
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
<div id="tempdialog" class='jquery-dialog' title="Save Template">
	<form id="tempform" action="<?=base_url()?>user/savetemplate">
		<div class='form-group'>
			<label>Enter Template Name</label>
			<input name="name" id="nm" class='w3-input w3-border'>
		</div>
		<input type="hidden" name="template" id="template">
		<div class='form-group'>
			<input type="submit" value="Submit" style='padding:2px 4px;' class='fancy-btn btn-block'>
		</div>
	</form>
</div>
<div id="updatedialog" class="jquery-dialog" title="Update Template">
	<form id="updateform" action="<?=base_url()?>user/updatetemplate">
			<div class='form-group'>
				<label>Enter Template Name</label>
				<input  name="name" id="tempname" class='w3-input w3-border'>
			</div>
			<input type="hidden" name="id" id="tempid">
			<input type="hidden" name="template" id="templateupdate">
			<div class='form-group'>
				<input type="submit" value="Submit" style='padding:2px 4px;' class='fancy-btn btn-block'>
			</div>
	</form>
</div>
<div id="report-dialog" class="jquery-dialog" title="Report Medium">
	<div class="form-group">
		<label><input type="radio" <?=($exam->sms_status==1 || $exam->sms_status==3)?'disabled':''?> name="medium" value="sms"> SMS</label>
		<label><input type="radio" <?=($exam->sms_status==2 || $exam->sms_status==3)?'disabled':''?> name="medium" value="email"> Email</label>
		<label><input type="radio"  <?=($exam->sms_status!=0)?'disabled':''?> name="medium" value="both"> Both</label>
	</div>
	<input type="button" onclick="sendReport()" value="Send Report" class="fancy-btn btn-block" >
</div>

<script>

	function showTemp(){
		template.value=$("#text").val();
		$("#tempdialog").dialog();
	}

	function showOutput(val){
		val=replaceTags(val);
		showoutput.innerHTML=val;
	}

	function setTemplate(val){
		template=atob(val.split("-")[0]);
		$("#text").val(template);
		showOutput(template);

		templateid=val.split("-")[1];
		$("#ut").css("display","inline-block");
		$("#ut").click(function(event) {
		event.preventDefault();
			$("#tempid").val(templateid);
			$("#tempname").val(val.split("-")[2]);
			$("#templateupdate").val($("#text").val());
			$("#updatedialog").dialog();	
		});

	}

	function replaceTags(val){
		val=val.replace(/<name>/g,"Rajdeep Singh");
		val=val.replace(/<exam-name>/g,"First Exam");
		val=val.replace(/<exam-rank>/g,"2");
		val=val.replace(/<exam-marks>/g,"220");
		val=val.replace(/<exam-total>/g,"420");
		val=val.replace(/<exam-date>/g,"13-Mar-2020 12:30:00 PM");
	
		<?php 
			foreach($subjects as $subject){?>
				val= val.replace(/<<?=$subject?>-percentage>/g,"70%");
				val= val.replace(/<<?=$subject?>-marks>/g,"90");
				val= val.replace(/<<?=$subject?>-correct>/g,"87");
				val= val.replace(/<<?=$subject?>-wrong>/g,"13");
				val= val.replace(/<<?=$subject?>-rank>/g,"2");	
				val= val.replace(/<<?=$subject?>-total>/g,"120");				
		<?php } ?>				

		return val;
	}

	function insertTag(tag){
	    var cursorPos = $('#text').prop('selectionStart');
	    var v = $('#text').val();
	    var textBefore = v.substring(0,  cursorPos);
	    var textAfter  = v.substring(cursorPos, v.length);
	    $('#text').val(textBefore + tag + textAfter);
	    showoutput.innerHTML=replaceTags($("#text").val());
	}

	var baseurl="<?=base_url()?>";


	function sendReport(){
		$("#loading").css("display","block");
        $("#form input[type=button]").attr("disabled",true);
        formdata=$("#form").serialize();
        formdata+="&medium="+$("input[name='medium']:checked").val();
        $.ajax({
            type: 'POST',
            url: baseurl + "user/sendexamreport",
            data:formdata,
            cache:false,
	        dataType: 'json',
	        contentType:'application/x-www-form-urlencoded',
	        processData: false,
            success: function(data) {
	             if(data.status==true){
	            	$("#form").trigger("reset");
	             }
	             $("#form input[type=button]").attr("disabled",false);
	             $("#loading").css("display","none");
	             $("#report-dialog").dialog("close");
	             openModal({title:'Status',content:data.message});
            }
       });
	}

	$('#tempform').submit(function(evt) {
        evt.preventDefault();
        $("#loading").css("display","block");
        $("#tempform input[type=submit]").attr("disabled",true);
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
	    	if(data.status==true){
	    		$("#tempdialog").dialog("close");
	    	}
	        $("#tempform input[type=submit]").attr("disabled",false);
	        $("#loading").css("display","none");
	        openModal({title:'Status',content:data});
        }
       });
	});

	$("#updateform").submit(function(evt){
		evt.preventDefault();
		$.ajax({
	        type: 'POST',
	        url: $(this).attr('action'),
	        data:$("#updateform").serialize(),
	        cache:false,
	        dataType: 'json',
	        contentType:'application/x-www-form-urlencoded',
	        processData: false,
	        success: function(data) {
		    	if(data.status==true){
		    		$("#updatedialog").dialog("close");
		    	}
		    	openModal({title:'Status',content:data.message});
		        $("#loading").css("display","none");
	        }
       });	
	});


</script>