<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Student's Complaints</h4>
		</div>
		<div class="mycardbody">
		<div class='table-wrapper'>
			<table class='sc-table'>
				<tr><th>To</th><th>Name</th><th>Class</th><th>Email</th><th>Phone</th><th>Complaint</th><th>Date</th><th>Response</th><th>Response Time</th></tr>
				<?php foreach ($data as $v) {
					if($v->response==""){$v->rtime="";}
					$btn="<input type='button' style='padding:2px 4px;width:100px' value='Response' class='fancy-btn' onclick=\"openResponse($v->id,this)\" >";
					if($v->response!==""){
						$btn="$v->response";
					}
					if($v->tname==null){$v->tname="Admin";}
					echo "<tr><td>$v->tname</td><td>$v->name</td><td>$v->course $v->batch</td><td>$v->email</td><td>$v->phone</td><td>$v->complaint</td><td>$v->date</td><td>$btn</td><td>$v->rtime</td></tr>";
				} ?>
			</table>
		</div>
		</div>
	</div>
</div>
<div id="responsedialog" class='jquery-dialog' title="Write a Response">
	<form id="resform">
		<div class='form-group'>
			<textarea name='response' id='res' style='height:150px;' class='w3-input w3-border'></textarea>
		</div>
		<input type="hidden" name="cid" id="cid">
		<div class='form-group'>
			<input type="button" value="Submit" style='padding:2px 4px;' class='fancy-btn btn-block' onclick="giveResponse()">
		</div>
	</form>
</div>

<script>
	var baseurl="<?=base_url()?>";
	var ele="";
	function openResponse(cid,el){
		ele=el;
		$("#cid").val(cid);
		$("#responsedialog").dialog();
	}
	function giveResponse(){
		$.post({url:baseurl+"erp/saveresponse",cache:false,dataType: 'json',data:$("#resform").serialize(),success:function(data){
			if(data.status=="ok"){
				$("#responsedialog").dialog("close");
				ele.parentElement.innerHTML=$("#res").val();
			}
			$("#alertDialog").html(data.message);
			$("#alertDialog").dialog({title:'Alert Message'});

		}});
	}
</script>