<?php include 'css/panel/teacherattendance.php'; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<div id="content">
	<div class='container-flui'>
		<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Attendance</h4>
			</div>
			<div class="mycardbody">
				<div class="row">
					<div class="col-sm-6 wp pr">
						<?php
							$CI =& get_Instance();
							$CI->load->library("studentattendance");
							echo $CI->studentattendance->show($attendance);
						?>
					</div>
					<div class="col-sm-6 wp pl">
						
							<div class="mycard">
								<div class="mycardheader b-primary">
									<h4 class="mycardtitle">Edit or Add Attendance</h4>
								</div>
								<div class="mycardbody" id="loadhere">

								</div>

							</div>
							
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" ></script>

<script>
var baseurl="<?=base_url()?>";
	var temp=0;
	var sid="<?=$sid?>";
	function showEditAttendance(date){
		temp=0;
		setTimeout(function(){
			if(temp==0){$("#loading").show();}
		},1000);
		
		$.post({url:baseurl+"user/studentattendancebyid",data:{'sid':sid,'date':date},success:function(data){
			createForm(JSON.parse(data));
			temp=1;
			$("#loading").hide();
		}}); 
	}
	function createForm(data){

		var form=document.createElement("form");
		form.id="updateform";
		var i=1;
		for(let r of data){	
			let formgroup="<div class='form-group'>";
			formgroup+="<label>Entry No "+i+"</label>";	
			formgroup+="<input class='w3-input w3-border dtp' name='entry_"+r.id+"' value='"+r.datetime+"'>";
			formgroup+="</div>";
			form.innerHTML+=formgroup;
			i++;
		}
		
		let label="<div class='form-group'><label>Add Entry</label>";
		let input = "<input type='text' name='newentry' placeholder='Add Entry' class='w3-input w3-border dtp'></div>";
		let button= "<div class='form-group'><input type='button' onclick='submitData()' class='btn btn-default' value='Submit'></div>";
		form.innerHTML+=label+input+button;
		
		loadhere.innerHTML="";
		loadhere.appendChild(form);
		loadhere.innerHTML+='<div class="alert alert-info"><b>Note:</b> To edit the date just edit the dates and click submit and to add new entry then enter date time in new entry field and then click submit. To delete the existing dates then empty the field and click submit.</div>';

		 $('.dtp').datetimepicker({
		 	format:'YYYY-MM-DD HH:mm:ss'
		 });

	}

	createForm([]);

	function submitData(){
		$.post({url:baseurl+"user/updatestudentattendance",data:$("#updateform").serialize()+"&userid="+sid,success:function(data){
			openModal({title:'Update Status',content:JSON.parse(data).message});
		}});
	}

</script>