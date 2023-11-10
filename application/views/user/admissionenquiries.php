<style>
	.mycardheader button{
		position: absolute;
		right: 10px;
		top:5px;
	}
	label span{
		color:red;
	}
	label{
		font-weight: 500;
	}

	td .fa{
		font-size: 12px;
    color:#000;
	}
	table.dataTable tbody td {
    	padding: 6px 10px;
    	position: relative;
	}
	td button{
		position: absolute;
		top:2px;
	}
	td button:nth-child(1){
		left:10px;
	}
	td button:nth-child(2){
		left:40px;
	}
	td button:nth-child(3){
		left:70px;
	}
	td button:nth-child(4){
		left:100px;
	}

	#follow-details{
		background: #f4f4f4;
		height:400px;
		padding:5px 10px;
	}
	#follow-details h4{
		font-family: 'Roboto';
		font-size: 18px;
		font-weight: 400;
		line-height: 1.1;
		margin-bottom: 5px;
	}
	#follow-details span{
		font-size: 12px;
		color:#888;
	}
	#followModal .modal-body{
		padding: 0 0 0 10px;
	}
	
	#dates{
		padding-top: 10px;
	}
	#dates p i.fa{
		font-size: 18px;
	}
	#dates p{
		margin-bottom: 5px;
		color:#555;
		font-size: 13px;
	}
	#infos{
		padding-top: 10px;
	}
	#infos label{
		font-weight: 500;
		font-size: 13px;
		display: block;
		line-height: 1.5em;
	}
	#infos label span{
		color:inherit;
		font:inherit;
	}

	#showresponses{
		margin-top: 10px;
		max-height: 140px;
		padding: 5px;
		overflow-y: auto;
	}
	.response-item{
		padding:5px 0 0 5px;
		box-shadow: 0 0 1px rgba(0,0,0,.24);
		margin-bottom: 5px;
	}
	.response-footer{
		padding:0;
		margin-top: 5px;
		font-size: 12px;
		color:#888;
		border-top: 1px solid #ddd;
	}
	

	#fullinfo .modal-dialog{
		width: 800px;
	}

  .form-group{
    position: relative;
  }
  .del{
   position: absolute;
    right: 7px;
    font-size: 25px;
    bottom: 4px;
    cursor: pointer;
  }


</style>

<div id="content">
	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Search Criteria</h4>
		</div>
		<div class="mycardbody">
		
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						<label>Enquiry Date</label>
						<input type="text" class="w3-input w3-border datepicker" autocomplete="off" id="s_enquirydate">
					 <i class="fa fa-remove del" onclick="s_enquirydate.value=''"></i>
          </div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>From Source</label>
						<select class="w3-input w3-border" id="s_source">
						<option value="">Select</option>
          					<option>From Students</option>
          					<option>From Advertisement</option>
          					<option>From Parents</option>
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>Status</label>
						<select class="w3-input w3-border" id="s_status">
							<option value="">Select</option>
							<option value="1">Active</option>
							<option value="2">Joined</option>
							<option value="3">Not Joined</option>
						</select>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<label>&nbsp; </label><br>
						<button type="button" class="btn btn-default btn-sm" onclick="searchRecords()" ><i class='fa fa-search'></i> Search</button>
					</div>
				</div>
			</div>
		
		</div>
	</div>

<div style="height:20px"></div>

	<div class="mycard">
		<div class="mycardheader b-primary">
			<h4 class="mycardtitle">Admission Enquiries</h4>
			<button id="addbtn" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add</button>
		</div>
		<div class="mycardbody">
			<table id="table" class="table table-stripped table-bordered">
				<thead>
					<tr><th>Name</th><th>Phone</th><th>Source</th><th>Enquiry Date</th><th>Status</th><th>Actions</th></tr>
				</thead>
				<tbody id="recordsbody">
				<?php
				$status=[1=>"Active",2=>"Joined",3=>"Not Joined"];


				foreach ($records as $v) {
  				$style="background-color:white";
          if($v->status==2){$style="background-color:#4bb543;color:white;";}
          if($v->status==3){$style="background-color:#ff9494;color:white;";}
					echo "<tr style='$style'><td>$v->name</td><td>$v->phone</td><td>$v->source</td><td>$v->edate</td><td>".$status[$v->status]."</td>
						<td>
						<button class='action' onclick='fullInfo($v->id)'><i class='fa fa-eye'></i></button>
						<button class='action' onclick='followUp($v->id)'><i class='fa fa-phone'></i></button>
						<button class='action'  onclick='editEnquiry($v->id)'><i class='fa fa-pencil'></i></button>
						<button class='action' onclick='deleteAdmissionEnquiry($v->id,this.parentElement.parentElement)'><i class='fa fa-remove'></i></button>
						</td></tr>";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>

</div>


  <!-- Modal -->
  <div class="modal " id="addModal" role="dialog">
    <div class="modal-dialog" style="width:60%">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Admission Enquiry</h4>
        </div>
        <div class="modal-body">
        <form id="enquiryform" action="<?=base_url()?>user/save_admission_enquiry">
          	<div class="row">
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Name<span> *</span></label>
          				<input type="text" name="name" class="w3-input w3-border" autocomplete="off" required>
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Phone<span> *</span></label>
          				<input type="text" name="phone" class="w3-input w3-border" autocomplete="off" required>
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Email</label>
          				<input type="email" name="email" class="w3-input w3-border" autocomplete="off">
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Enquiry Date</label>
          				<input type="text" name="enquirydate" readonly class="w3-input w3-border datepicker" autocomplete="off">
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Academic Year</label>
          				<select name="academicyear" class="w3-input w3-border">
          					<option value="">Select</option>
          					<option>2019-2020</option>
          					<option>2018-2019</option>
          				</select>
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Source <span>*</span></label>
          				<select name="source" class="w3-input w3-border" required>
          					<option value="">Select</option>
          					<option>From Students</option>
          					<option>From Advertisement</option>
          					<option>From Parents</option>
          				</select>
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Course</label>
          				<select name="course" class="w3-input w3-border">
          					<option value="">Select</option>
          					<?php 
          					foreach ($courses as $v) {
          						echo "<option value='$v->id'>$v->course</option>";
          					}
          					?>
          				</select>
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Assign To</label>
          				<select name="assignedto" class="w3-input w3-border">
          					<option value="">Select</option>
          					<?php 
          					foreach ($faculty as $v) {
          						echo "<option value='$v->id'>$v->name</option>";
          					}
          					?>
          				</select>
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>Name Of Child</label>
          				<input type="text" name="childname" class="w3-input w3-border" autocomplete="off">
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
          				<label>No. of Child</label>
          				<input type="number" name="childno" class="w3-input w3-border" autocomplete="off">
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
	          			<label>Address</label>
	          			<textarea name="address" style="height:50px" class="w3-input w3-border"></textarea>
          			</div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
	          			<label>Note</label>
	          			<textarea name="note" style="height:50px" class="w3-input w3-border"></textarea>
          			</div>
          		</div>
          		
          		<div class="col-sm-10">
          			<div style="padding-top:10px">
          				<div id="res" class="text-right"></div>
          			</div>
          		</div>
          		<div class="col-sm-2 text-right">
          			<div class="form-group" style="position:relative">
          				<input type="submit" class="w3-btn w3-border" style="position:relative;top:3px" value="Save Enquiry">
          			</div>
          		</div>
          	</div>
        </form>
        </div>
       <!--  <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>


  <div class="modal" id="followModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Follow Up Admission Enquiry</h4>
        </div>
        <div class="modal-body">
          	<div class="row">
          		<div class="col-sm-8 wp pr" style="padding-top:10px">
          			<form id="followform" action="<?=base_url()?>user/savefollowup">
          			<input type="hidden" name="aeid" >
          			<div class="row">
          				<div class="col-sm-6 wp pr">
          					<div class="form-group">
          						<label>Follow Up Date <span>*</span></label>
          						<input type="text" name="followdate" class="w3-input w3-border datepicker" required autocomplete="off">
          					</div>
          				</div>
          				<div class="col-sm-6 wp pl">
          					<div class="form-group">
          						<label>Next Follow Up Date <span>*</span></label>
          						<input type="text" name="nextdate" class="w3-input w3-border datepicker" required autocomplete="off">
          					</div>
          				</div>
          				<div class="col-sm-6 wp pr">
          					<div class="form-group">
          						<label>Response <span>*</span></label>
          						<textarea name="response" class="w3-input w3-border" required></textarea>
          					</div>
          				</div>
          				<div class="col-sm-6 wp pl">
          					<label>Note</label>
          					<p id="f_note"></p>
          				</div>
          				<div class="col-sm-10 wp text-right">
          					<div id="followres"></div>
          				</div>
          				<div class="col-sm-2 wp text-right">
          					<input type="submit" value="Save" class="btn btn-default btn-">
          				</div>
          			</div>
          			</form>

          			<div id="showresponses" >

          			</div>

          		</div>
          		<div class="col-sm-4 wp pl">
          			<div id="follow-details">
          				<div class="row">
          					<div class="col-xs-6 wp pr">
	          					<h4 style="margin-bottom:10px">Summary</h4>
	          					<span>Created By Jashan</span>
                       <div style='font-size: 15px;color:#4bb543;' id='su'></div>
          					</div>
          					<div class="col-xs-6 wp pl">
	          					<h4>Status</h4>
	          					<select class="w3-input w3-border" id="follow-status">
                        <option value="">Select</option>
	          						<option value="1">Active</option>
	          						<option value="2">Joined</option>
	          						<option value="3">Not Joined</option>
	          					</select>
          				      <div class="text-right" style="margin-top:5px">
                          <input type="button" onclick="changeStatus($('#follow-status').val())" value="Update Status" class="btn btn-default btn-sm" >
                  	   </div>
                    </div>

          				</div>

          				<div id='dates'>
	          				<p><i class="fa fa-calendar-plus-o"></i> &nbsp;Enquiry Date: <span id='f_ed'></span></p>
	          				<p><i class="fa fa-calendar-plus-o"></i> &nbsp;Last Follow Up Date: <span id='f_lfd'></span></p>
	          				<p><i class="fa fa-calendar-plus-o"></i> &nbsp;Next Follow Up Date: <span id="f_nfd"></span></p>
          				</div>

          				<div id="infos">
          					<label>Phone : <span id="f_phone"></span></label>
          					<label>Reference : <span id="f_source"></span></label>
          					<label>For : <span id="f_for"></span></label>
          					<label>Assigned : <span id="f_assigned"> </span></label>
          					<label>Name of Child(s) : <span id="f_childname"></span> </label>
          					<label>No. Of Child : <span id="f_childno"></span></label>
          				</div>

          			</div>
          		</div>
          	</div>
        </div>
      </div>
    </div>
  </div>

    <div class="modal " id="fullinfo" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Full Information of <span id='fullof'></span></h4>
        </div>
        <div class="modal-body">
          	<table class="table">
          		<tr>
          			<th>Name</th><td id="full_name"></td><th>Email</th><td id="full_email"></td><th>Phone</th><td id="full_phone"></td>
          		</tr>
          		<tr>
          			<th>Source</th><td id="full_source"></td><th>Academic Year</th><td id="full_academicyear"></td><th>Course</th><td id="full_course"></td>
          		</tr>
          		<tr>
          			<th>Enquiry Date</th><td id="full_enquirydate"></td><th>Child Name</th><td id="full_childname"></td><th>No. of Child</th><td id="full_childno"></td>
          		</tr>
          		<tr>
          			<th>Assigned To</th><td id="full_assignedto"></td><th>Address</th><td id="full_address"></td><th>Status</th><td id="full_status"></td>
          		</tr>
              <tr><th>Note</th><td id="full_note" colspan="5"></td></tr>
          	</table>
        </div>
      </div>
      
    </div>
  </div>

<script>
var dataobj={};
<?php
foreach ($records as $v) {
	echo "dataobj[$v->id]=".json_encode($v).";";
}
?>
</script>

<script>
function getWithoutFormatDate(str){
  let today = new Date(str);
  let dd = String(today.getDate()).padStart(2, '0');
  let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  let yyyy = today.getFullYear();
  let datestring=yyyy+"-"+mm+"-"+dd;
  return datestring;
}

var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
var datestring=yyyy+"-"+mm+"-"+dd;



var baseurl="<?=base_url()?>";

function changeStatus(status){
  
  $.post({url:baseurl+"user/updateenquirystatus",data:{'id':activeFollowId,'status':status},success:function(data){
      data=JSON.parse(data);
          if(data.status){
            $("#su").text("Status Updated");
            dataobj[activeFollowId].status=status;
            setTimeout(function(){
              $("#su").html("");
              $("#followModal").modal("hide");
            },1000);
            
          }
          if(status==2 && data.status){
            let data=dataobj[activeFollowId];
            let passdata={fathername:data.name,studentname:data.childname,address:data.address,fathermobile:data.phone,email:data.email,course:data.course};
            window.location=baseurl+"user/addstudents/?data="+btoa(JSON.stringify(passdata));
          }
    }});


}

function searchRecords(){
  $("#loading").css("display","block");
	let ed=$("#s_enquirydate").val();
	let source=$("#s_source").val();
	let status=$("#s_status").val();
	$.post({url:baseurl+"user/getadmissionenquries",data:{'enquirydate':ed,'source':source,'status':status},success:function(data){
			data=JSON.parse(data);
			//$("#recordsbody").html(data.table);
      updateRecords(data.table);

		//	dataobj=data.jsontable;
    dataobj={};
      for(let d of data.table){
          dataobj[d.id]=d;
      }

      $("#loading").css("display","none");
		}}); 
}

function updateRecords(data){
    table.clear().draw();
    var status=["Active","Joined","Not Joined"];

    for(let d of data){
        let buttons="<button class='action' onclick='fullInfo("+d.id+")'><i class='fa fa-eye'></i></button>"+
          "<button class='action' onclick='followUp("+d.id+")'><i class='fa fa-phone'></i></button>"+
          "<button class='action'  onclick='editEnquiry("+d.id+")'><i class='fa fa-pencil'></i></button>"+
          "<button class='action' onclick='deleteAdmissionEnquiry("+d.id+",this.parentElement.parentElement)'>"+
          "<i class='fa fa-remove'></i></button>";

        table.row.add([d.name,d.phone,d.source,d.edate,status[d.status-1],buttons]).draw(false);
    }

}

$(document).ready(function(){
  $("#addbtn").click(function(){
  	$("#enquiryform").trigger("reset");
  	$("#enquiryform [name=enquirydate]").val(datestring);
  	$("#enquiryform #aeid").remove();
  	$("#addModal .modal-title").html("Admission Enquiry");
  	$("#enquiryform").attr("action",$("#enquiryform").attr("action").replace("update","save") );
  	$("#enquiryform [type=submit]").val("Save Enquiry");
    $("#addModal").modal({backdrop: 'static'});
  });
});

function fullInfo(id){
	data=dataobj[id];
	$("#fullof").html(data.name);
	$("#full_name").text(data.name);
	$("#full_email").text(data.email);
	$("#full_phone").text(data.phone);
	$("#full_source").text(data.source);
	$("#full_academicyear").text(data.academicyear);
	$("#full_course").text(data.fullcourse);
	$("#full_enquirydate").text(data.edate);
	$("#full_childname").text(data.childname);
	$("#full_childno").text(data.childno);
	$("#full_assignedto").text(data.assignedto);
	$("#full_address").text(data.address);
  $("#full_note").text(data.note);
	let sta={1:"Active",2:"Joined",3:"Not Joined"};
	$("#full_status").text(sta[data.status]);
	$("#fullinfo").modal({backdrop:'static'});
}

var activeFollowId;
function followUp(id,refresh=false){
  activeFollowId=id;
	data=dataobj[id];
	$("#showresponses").html("");
	if(data.resp!=null){
		var follow_responses=data.resp.split("#");
		for(let fr of follow_responses){
			let response=fr.split("~")[0];
			let followdate=fr.split("~")[1];
			let nextdate=fr.split("~")[2];
				
			var resp=document.createElement("div");
			resp.setAttribute("class","response-item");
			resp.innerHTML=response;
			resp.innerHTML+="<div class='response-footer'>Follow Date : "+followdate+" - Next Follow Up Date : "+nextdate+"</div>";
			
			showresponses.appendChild(resp);
			
		}
	}
  
  let nextdate=data.nextdate==null?datestring:getWithoutFormatDate(data.nextdate);

	$("#followform [name=followdate]").val(nextdate);

	$("#followform [name=aeid]").val(id);
  if(!refresh){
	 $("#followModal .modal-dialog").css("width","900px");
  	$("#followModal").modal({backdrop:'static'});
	}
	$("#follow-status").val(data.status);
	$("#f_lfd").text(data.lastdate);
	$("#f_nfd").text(data.nextdate);
	$("#f_ed").text(data.edate);
	$("#f_note").text(data.note);
	$("#f_phone").text(data.phone);
	$("#f_source").text(data.source);
	$("#f_for").text(data.academicyear+" - "+data.fullcourse);
	$("#f_childname").text(data.childname);
	$("#f_childno").text(data.childno);
	$("#f_assigned").text(data.tname!=null?data.tname:data.uname);
}

function deleteAdmissionEnquiry(id,ele){
	if(confirm("Are you sure to delete this Record?")){
		$.post({url:baseurl+"user/deleteadmissionenquiry",data:{'aeid':id},success:function(data){
			if(JSON.parse(data).status){
				ele.style.display="none";
			}
      openModal({title:'Status',content:JSON.parse(data).message});
		}}); 
	}
}

function editEnquiry(id,data){
	data=dataobj[id];
	$("#addModal .modal-title").html("Edit Admission Enquiry");
	$("#enquiryform").trigger("reset");
	$("#enquiryform").attr("action",$("#enquiryform").attr("action").replace("save","update") );
	$("#enquiryform #aeid").remove();
	$("#enquiryform").append("<input type='hidden' id='aeid' name='id' value="+data.id+" >");
	$("#enquiryform [name=name]").val(data.name);
	$("#enquiryform [name=phone]").val(data.phone);
	$("#enquiryform [name=email]").val(data.email);
	$("#enquiryform [name=enquirydate]").val(data.enquirydate);
	$("#enquiryform [name=academicyear]").val(data.academicyear);
	$("#enquiryform [name=source]").val(data.source);
	$("#enquiryform [name=course]").val(data.course);
	$("#enquiryform [name=assignedto]").val(data.assignedto);
	$("#enquiryform [name=childname]").val(data.childname);
	$("#enquiryform [name=childno]").val(data.childno);
	$("#enquiryform [name=address]").val(data.address);
	$("#enquiryform [name=note]").val(data.note);
	$("#enquiryform [type=submit]").val("Update Enquiry");

	$("#addModal").modal({backdrop:'static'});
}	


$('#enquiryform').submit(function(evt) {
    evt.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    type: 'POST',
    url: $(this).attr('action'),
    data:formData,
    dataType:'json',
    contentType: false,
    processData: false,
    success: function(data) {
      dataobj[data.id]=JSON.parse(atob(data.lastdata));
	    if(data.status && data.type=="save"){
	    	$("#enquiryform").trigger("reset");
	    	$("#table").prepend(data.last);
	    }
      $("#addModal").modal('hide');
	   openModal({title:'Status',content:data.message});
    }
   });
  });

$('#followform').submit(function(evt) {
    evt.preventDefault();
    var formData = new FormData(this);
    $.ajax({
    type: 'POST',
    url: $(this).attr('action'),
    data:formData,
    dataType:'json',
    contentType: false,
    processData: false,
    success: function(data) {
	    if(data.status){
	         dataobj[data.id]=JSON.parse(atob(data.lastdata));
           followUp(data.id,true);
	    }
      openModal({title:'Status',content:data.message});
	    //$("#followModal").modal("hide");
    }
   });
  });

</script>

<script>
var table=null;
	$(document).ready( function () {
	   table= $('#table').DataTable(
     {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
     });
    });

  setTimeout(()=>{$(".dt-button").addClass("btn btn-default btn-sm");},100);

</script>