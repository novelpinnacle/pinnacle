<div id="content">
    <div class="mycard">
      <div class="mycardheader b-primary">
        <h4 class="mycardtitle">See Student Attendance</h4>
      </div>
      <div class="mycardbody">
        <div class='row'>
          <div class='col-sm-3 wp pr'>
          <label>Select Course</label>
            <select class='w3-input w3-border' id='course' onchange="loadBatches(this.value)">
              <option value="">Select Course</option>
              <?php 
              foreach ($data as $v) {
                echo "<option value='$v->id'>$v->course</option>";
              }
              ?>
            </select>
          </div>
          <div class='col-sm-3 wp pr'>
            <label>Select Batch</label>
            <select class='w3-input w3-border' id='batch' >
              <option value="">Select Batch</option>
            </select>
          </div>

          <div class='col-sm-3 wp pr'>
            <label>&nbsp;</label><br>
            <button type="button" value="Search" class='btn btn-default btn-sm' onclick="loadStudents()"><i class='fa fa-search'></i> Search</button>
          </div>
        </div>

        <div id="loadhere" class='table-wrapper' style='padding-top:30px'></div>

      </div>
    </div>
</div>





<script>
var baseurl="<?=base_url()?>";
  function loadBatches(cid){
      $.post({url:baseurl+"erp/getbatchesbycourse",data:{'cid':cid},success:function(data){
        $("#batch").html("<option value=''>Select Batch</option>"+data);
      }}); 
  }
  
  function loadStudents(){
    $("#loadhere").html("");
    cid=$("#course").val();
    bid=$("#batch").val();
    if(cid=="" || bid==""){
      openModal({title:'Alert',content:'<b class="w3-text-red">Please Select Course and Batch</b>'});
      return;
    }
    $("#loading").show();
    $.post({url:baseurl+"erp/getstudentsbycoursebatch",data:{'cid':cid,'bid':bid},success:function(data){
      data=JSON.parse(data);
      if(data.status)
          createTable(data.data);
      if(data.status==false){
        openModal({title:'Status',content:data.message});
      }
      $("#loading").hide();
    }}); 
  }

  function createTable(data){
    if(data.length==0){
      loadhere.innerHTML="No Records Found";
      return;
    }
    var table=document.createElement("table");
    table.classList.add("sc-table");
    table.innerHTML="<tr><th>Roll No.</th><th>Name</th><th>See Attendance</th></tr>";
    for(let r of data){
      let tr=document.createElement("tr");
      tr.innerHTML+="<td>"+r.rollno+"</td>";
      tr.innerHTML+="<td>"+r.name+"</td>";
      tr.innerHTML+="<td><a class='btn btn-default btn-sm' href='"+baseurl+"erp/seestudentattendance/"+r.sid+"'><i class='fa fa-eye'></i></a></td>";
      table.appendChild(tr);
    }
    loadhere.innerHTML="";
    loadhere.appendChild(table);
  }

</script>
