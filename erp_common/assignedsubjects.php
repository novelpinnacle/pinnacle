<table class='sc-table'>
<tr><th>Teacher</th><th>Course</th><th>Batch</th><th>Subject</th><th>Delete</th></tr>
<?php foreach ($assignedsubjects as $v) {
echo "<tr><td>$v->name</td><td>$v->course</td><td>$v->batch</td><td>$v->subject</td><td><button  onclick=\"showDelete($v->id,this)\" class='btn btn-default btn-sm'><i class='fa fa-close'></i></button></td></tr>";
} 
?>
</table>