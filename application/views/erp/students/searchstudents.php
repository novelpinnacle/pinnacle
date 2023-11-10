<style>
	
	.thumbnail{
		display: none;
		width:80px;
		height:auto;
		margin-bottom: 0;
	}
	#statusth{
		white-space: nowrap;
		width: 	120px;
	}
	.thumbnail-full{
		display: inline;
		width:120px;
	}
	#actionth{
		white-space: nowrap;
		width: 120px;
	}
	
</style>
<div id="content">
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Search Students</h4>
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>erp/loadstudents" method="post">
				<div class="row">
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label>Roll No.</label>
							<input type="number" min="1" name="rollno" class="w3-input w3-border">
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label>Student Name</label>
							<input type="text" name="name" class="w3-input w3-border">
						</div>
					</div>
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label>Course</label>
							<select name="course" class="w3-input w3-border"  onchange="loadBatches(this.value)">
							<option value="">Select Course</option>
							<?php 
							foreach ($courses as $v) {
								echo "<option value='$v->id'>$v->course</option>";
							}
							?>
							</select>
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<div class='form-group'>
							<label class="w3-text-grey">Select Batch</label>
							<select name="batch" class="w3-input w3-border" id="batch">
								<option value="">Select Batch</option>
							</select>
						</div>
					</div>
					<div class="col-sm-2 wp pr">
						<label>&nbsp;</label><br>
						<button type="submit" value="Search Students" class="btn btn-default btn-sm"><i class='	fa fa-search'></i> Search</button>
					</div>
				</div>
				</form>

				<div id="loadhere" class='table-wrapper'></div>

			</div>
	</div>
</div>

<script>
var baseurl="<?=base_url()?>";
var searchdata={};


function createTable(data){
	if(data.status==false){
		loadhere.innerHTML=data.message;
		return;
	}
	var table=document.createElement("table");
	table.classList.add("sc-table");
	table.id="stable";
	table.innerHTML="<thead><tr><th>Image <input type='checkbox' onchange='toggleImage(this)'></th><th>Name</th><th>Roll No.</th><th>Phone</th><th>Fname</th><th>F Mobile</th><th>Course</th><th>Batch</th><th id='actionth'>Action</th><th id='statusth'>Status</th></tr></thead>";
	var tbody=document.createElement("tbody");
	for(record of data){
		let tr=document.createElement("tr");
		let img=record.image=="no"?"<i class='fa fa-erp'></i>":"<img src='"+baseurl+record.image+"' class='thumbnail'>";
		tr.innerHTML+="<td>"+img+"</td>";
		tr.innerHTML+="<td>"+record.name+"</td>";
		tr.innerHTML+="<td>"+record.rollno+"</td>";
		tr.innerHTML+="<td>"+record.phone+"</td>";
		tr.innerHTML+="<td>"+record.fname+"</td>";
		tr.innerHTML+="<td>"+record.fmobile+"</td>";
		tr.innerHTML+="<td>"+record.course+"</td>";
		tr.innerHTML+="<td>"+record.batch+"</td>";
		
		tr.innerHTML+="<td class='text-right'><button class='btn btn-default btn-sm'  data-toggle='tooltip' title='Full Information'  onclick=\"showFull('"+record.sid+"')\" ><i class='fa fa-eye'></i></button>"+
		"<a data-toggle='tooltip' title='Open Account' class='btn btn-default btn-sm' href='"+baseurl+"student/?sid="+record.sid+"'><i class='fa fa-eye'></i></a>"+
		"<a data-toggle='tooltip' title='Edit Student' class='btn btn-default btn-sm' href='"+baseurl+"erp/editstudent/"+record.sid+"'><i class='fa fa-pencil'></i></a>"+
		"<button data-toggle='tooltip' title='Delete Student' onclick=\"showDelete('"+record.sid+"',this)\" class='btn btn-default btn-sm'><i class='fa fa-remove remove'></i></button></td>";

		var status="";
		if(record.active==1){
			 status="Active <button data-toggle='tooltip' title='Deactivate' class='btn btn-default btn-sm' onclick='updateStatus("+record.sid+",2)'><i class='fa fa-close'></i></button>";
		}
		else if(record.active==0){
			status="New <button  data-toggle='tooltip' title='Activate' class='btn btn-default btn-sm' onclick='updateStatus("+record.sid+",1)'><i class='fa fa-check'></i></button><button  data-toggle='tooltip' title='Deactivate' class='btn btn-default btn-sm' onclick='updateStatus("+record.sid+",2)'><i class='fa fa-close'></i></button>";
		}
		else{
			status="Deactivated <button  data-toggle='tooltip' title='Activate' class='btn btn-default btn-sm' onclick='updateStatus("+record.sid+",1)'><i class='fa fa-check'></i></button>";
		}
		tr.innerHTML+="<td class='text-right'>"+status+"</td>";

		tbody.appendChild(tr);
	}
	table.appendChild(tbody);
	loadhere.innerHTML="";
	loadhere.appendChild(table);
	createDataTable();

	$(".buttons-colvis").click(()=>{
		$(".buttons-columnVisibility").click(()=>{
			$("table.sc-table").css("width","100%");
		});
	});

}

function createDataTable(){
	 table= $('#stable').DataTable(
     {
        dom: 'Blrtip',
        pageLength:15,
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
        ],
         "columnDefs": [
    			{ "orderable": false, "targets": 0 },
    			{"orderable":false,"targets":3},
    			{"orderable":false,"targets":5},
    			{"orderable":false,"targets":8},
    			{"orderable":false,"targets":9}
  			],
  		"order":[1,"asc"],
     });
}


function updateStatus(sid,status){
	$.post({url:baseurl+'erp/updatestudentstatus',data:{'sid':sid,'status':status},success:function(data){
		openModal({title:'Status',content:JSON.parse(data).message});
		if(JSON.parse(data).status){
			$("#form").submit();
		}
	}});
}

$('#form').submit(function(evt) {
	$("#loading").css("display","block");
    evt.preventDefault();
    var formData = new FormData(this);
    $.ajax({
	    type: 'POST',
	    url: $(this).attr('action'),
	    data:formData,
	    dataType:'JSON',
	    contentType: false,
	    processData: false,
	    success: function(data) {
	    	searchdata=data;
	    	createTable(data);
	    	$("#loading").css("display","none");
	    }
	    });
  });

function deleteData(sid,ele){
	$("#loading").show();
	$.post({url:baseurl+'erp/deletestudent',data:{'sid':sid},success:function(data){
		$("#loading").hide();
		
		if(JSON.parse(data).status){
			ele.parentElement.parentElement.style.display='none';
		}
		else{
			openModal({title:'Status',content:JSON.parse(data).message});
		}

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

function loadBatches(cid){
	$.post({url:baseurl+'erp/getbatchesbycourse',data:{'cid':cid},success:function(data){
		$("#batch").html("<option value=''>Select Batch</option>"+data);
	}});
}

function toggleImage(ele){
	if(ele.checked){
		$(".thumbnail").css("display","block");
	}
	else{
		$(".thumbnail").css("display","none");	
	}
}
function showFull(sid){		
	current={};
	for(var o of searchdata){
		if(o.sid==sid){current=o;break;}
	}
		
	let img=current.image=="no"?"<i class='fa fa-erp'></i>":"<img src='"+baseurl+current.image+"' class='thumbnail-full'>";

	let table="<table class='sc-table'>"+
	 "<tr><td colspan=2 style='text-align:center'>"+img+"</td></tr>"+
	 "<tr><th>Name</th><td>"+current.name+"</td></tr>"+
	 "<tr><th>D.O.B</th><td>"+current.dob+"</td></tr>"+
	 "<tr><th>Gender</th><td>"+current.gender+"</td></tr>"+
	 "<tr><th>Email</th><td>"+current.email+"</td></tr>"+
	 "<tr><th>Phone</th><td>"+current.phone+"</td></tr>"+
	 "<tr><th>Father Name</th><td>"+current.fname+"</td></tr>"+
	 "<tr><th>Father Phone</th><td>"+current.fmobile+"</td></tr>"+
	 "<tr><th>Roll No.</th><td>"+current.rollno+"</td></tr>"+
	 "<tr><th>Course</th><td>"+current.course+"</td></tr>"+
	 "<tr><th>Batch</th><td>"+current.batch+"</td></tr>"+
	 "<tr><th>City</th><td>"+current.city+"</td></tr>"+
	 "<tr><th>BioId</th><td>"+current.bioid+"</td></tr>"+
	 "<tr><th>Address</th><td>"+current.address+"</td></tr>";
	 "</table>";

	 openModal({title:'Full Information',content:table});
}

</script>
