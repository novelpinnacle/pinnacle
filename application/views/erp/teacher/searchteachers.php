<style>
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
</style>
<div id="content">
	<div class="mycard">
			<div class="mycardheader b-primary">
				<h4 class="mycardtitle">Search Teachers</h4>
			</div>
			<div class="mycardbody">
				<form id="form" action="<?=base_url()?>erp/loadteachers" method="post">
					<div class="row">
						<div class='col-sm-2 wp pr'>
							<div class='form-group'>
								<label>Teacher Name</label>
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
							<button type="submit" value="Search Teachers" class="btn btn-default btn-sm"><i class='fa fa-search'></i> Search</button>
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
	table.innerHTML="<thead><tr><th>Image <input type='checkbox' onchange='toggleImage(this)'></th><th>Name</th><th>Phone</th><th>Email</th><th>Gender</th><th id='statusth'>Action</th></tr></thead>";
	var tbody=document.createElement("tbody");
	for(record of data){
		let tr=document.createElement("tr");

		let img=record.image=="no"?"<i class='fa fa-erp'></i>":"<img src='"+baseurl+record.image+"' class='thumbnail'>";
		tr.innerHTML+="<td>"+img+"</td>";
		tr.innerHTML+="<td>"+record.name+"</td>";
		tr.innerHTML+="<td>"+record.phone+"</td>";
		tr.innerHTML+="<td>"+record.email+"</td>";
		tr.innerHTML+="<td>"+record.gender+"</td>";
		tr.innerHTML+="<td class='text-right'><a  data-toggle='tooltip' title='Open Account' class='btn btn-default btn-sm' href='"+baseurl+"teacher/?tid="+record.tid+"'><i class='fa fa-eye'></i></a>"+
		"<a  data-toggle='tooltip' title='Edit Teacher' class='btn btn-default btn-sm' href='"+baseurl+"erp/editteacher/"+record.tid+"'><i class='fa fa-pencil'></i></a>"+
		"<button  data-toggle='tooltip' title='Delete Teacher' onclick=\"showDelete('"+record.tid+"',this)\" class='btn btn-default btn-sm'><i class='fa fa-remove remove' ></i></button></td>";
		tbody.appendChild(tr);
	}
	table.appendChild(tbody);
	loadhere.innerHTML="";
	loadhere.appendChild(table);
	createDataTable();
	$(".dt-button").addClass("btn btn-default btn-sm");

	$(".buttons-colvis").click(()=>{
		$(".buttons-columnVisibility").click(()=>{
			$("table.sc-table").css("width","100%");
		});
	});


}

function createDataTable(){
	 table= $('#stable').DataTable(
     {
        dom: 'Brtip',
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
    			{"orderable": false, "targets": 0 },
    			{"orderable":false,"targets":2},
    			{"orderable":false,"targets":5},
    			{"orderable":false,"targets":4}
  			],
  		"order":[1,"asc"]
     });
}

$('#form').submit(function(evt) {
    evt.preventDefault();
    //loadhere.innerHTML="";
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
	    }
   });
 });

function deleteData(tid,ele){
	$.post({url:baseurl+'erp/deleteteacher',data:{'tid':tid},success:function(data){
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
</script>
