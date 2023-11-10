<?php 
$i=0;
$data="";


$i=0;
foreach ($total as $v) {
$arr[$v->sid]=$v->total;
$i++;
}
$jsobj="{";
foreach ($present as $v) {
  $percentage=($v->present/$arr[$v->sid])*100;
  $percentage=number_format((float)$percentage,2,'.','');
  $data.="['$v->subject',$percentage,'grey'],";
  $jsobj.="'$v->subject':$v->sid,";
}
$jsobj=rtrim($jsobj,",");
$jsobj.="}";

echo "<script> var subs=$jsobj</script>";

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Percentage", { role: "style" } ],
    	<?=$data?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Subject Wise Students Attendance",

        height: 300,
         vAxis: {
            minValue: 0,
            maxValue: 100,
            format: '#\'%\''
        },
        bar: {groupWidth: "50%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);


      google.visualization.events.addListener(chart, 'select', selectHandler);

function selectHandler() {
var selection = chart.getSelection();
var message = '';
for (var i = 0; i < selection.length; i++) {
var item = selection[i];
if (item.row != null && item.column != null) {
var str = data.getFormattedValue(item.row, item.column);
var category = data.getValue(chart.getSelection()[0].row, 0);
message += subs[category];
} 
}


$.post({url:"<?=base_url()?>user/getStudentAttendanceBySubject",data:{'sid':message,'studentid':'<?=$studentid?>'},success:function(data){
$("#loadhere").html(data);
}});



}





  }
  </script>


<div id="content" style='padding: 20px 20px'>
  <div class='row'>
    <div class='col-sm-5 wp pr'>  
      <div id="columnchart_values">
       </div>
    </div>
   </div>

   <div id="loadhere" style='padding-top: 30px;'></div>

</div>