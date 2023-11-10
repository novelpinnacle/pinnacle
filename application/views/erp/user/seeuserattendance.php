<div id="content">
    <div class="mycard">
      <div class="mycardheader b-primary">
        <h4 class="mycardtitle">See Users Attendance</h4>
      </div>
      <div class="mycardbody">
          <table class="sc-table">
              <tr><th>Name</th><th>See</th></tr>
              <?php 
              foreach ($data as $v) {
                echo "<tr><td>$v->name</td><td><a class='btn btn-default btn-sm' href='".base_url()."erp/seeuserattendance/$v->cid'><i class='fa fa-eye'></i></a></td>";
              }
              ?>
          </table>
      </div>
    </div>
</div>

</script>
