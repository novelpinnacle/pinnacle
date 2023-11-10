<table class='sc-table'>
<tr><th>Course </th><th>Batch</th><th>See Subjects</th></tr>
<?php foreach ($subjects as $v) {
echo "<tr><td>$v->course</td><td>$v->batch</td><td><a class='btn btn-default btn-sm' href='".base_url()."erp/seesubjects/$v->cid/$v->bid'><i class='fa fa-eye'></i></a></td></tr>";
} 
?>
</table>