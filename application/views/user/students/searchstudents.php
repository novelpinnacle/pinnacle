<style>
	.fa.remove{
		color:red;
		font-size: 20px;
		cursor:pointer;
	}
	.thumbnail{
		display: none;
		width:80px;
		height:auto;
		margin-bottom: 0;
	}
	.thumbnail-full{
		display: inline;
		width:120px;
	}


	td .fa{
		font-size: 18px;
    	color:#000;
	}
	table.dataTable tbody td {
    	padding: 3px 10px;
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

</style>
<div id="content">
<div class='container-fluid'>
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Search Students</h4>
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>user/loadstudents" method="post">
				<div class="row">
					<div class='col-sm-2 wp pr'>
						<div class='form-group'>
							<label>Roll No</label>
							<input type="text" name="rollno" class="w3-input w3-border">
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
						<input type="submit" value="Search Students" class="fancy-btn small-btn">
					</div>
				</div>
				</form>

				<div id="loadhere" class='table-wrapper'></div>

			</div>
	</div>
</div>
</div>

<script>
var baseurl="<?=base_url()?>";
var searchdata={};
var n=0;
function createTable(data){
	if(data.status==false){
		loadhere.innerHTML=data.message;
		return;
	}
	var table=document.createElement("table");
	table.classList.add("sc-table");
	table.id="stable";
	table.innerHTML="<thead><tr><th>Image <input type='checkbox' onchange='toggleImage(this)'></th><th>Name</th><th>Phone</th><th>Fname</th><th>F Mobile</th><th>Course</th><th>Batch</th><th>Roll No.</th><th>Full</th><th>Edit</th><th>Delete</th></tr></thead>";
	var tbody=document.createElement("tbody");
	for(record of data){
		let tr=document.createElement("tr");

		let img=record.image=="no"?"<i class='fa fa-user'></i>":"<img src='"+baseurl+record.image+"' class='thumbnail'>";
		tr.innerHTML+="<td>"+img+"</td>";
		tr.innerHTML+="<td>"+record.name+"</td>";
		tr.innerHTML+="<td>"+record.phone+"</td>";
		tr.innerHTML+="<td>"+record.fname+"</td>";
		tr.innerHTML+="<td>"+record.fmobile+"</td>";
		tr.innerHTML+="<td>"+record.course+"</td>";
		tr.innerHTML+="<td>"+record.batch+"</td>";
		tr.innerHTML+="<td>"+record.rollno+"</td>";
		tr.innerHTML+="<td><i class='fa fa-eye' onclick=\"showFull('"+record.sid+"')\"></i></td>";
		tr.innerHTML+="<td><a href='"+baseurl+"user/editstudent/"+record.sid+"'><i class='fa fa-pencil'></i></a></td>";
		tr.innerHTML+="<td><i class='fa fa-remove remove' onclick=\"showDelete('"+record.sid+"',this)\"></i></td>";
		tbody.appendChild(tr);
	}
	table.appendChild(tbody);
	loadhere.innerHTML="";
	loadhere.appendChild(table);

	createDataTable();

	$(".dt-button").addClass("btn btn-default btn-sm");

}

function createDataTable(){
	 table= $('#stable').DataTable(
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
$.post({url:baseurl+'user/deletestudent',data:{'sid':sid},success:function(data){
	ele.parentElement.parentElement.style.display='none';
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
	$.post({url:baseurl+'user/getbatchesbycourseid',data:{'cid':cid},success:function(data){
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
			if(o.sid==sid){current=o;}
		}
			
		let img=current.image=="no"?"<i class='fa fa-user'></i>":"<img src='"+baseurl+current.image+"' class='thumbnail-full'>";

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