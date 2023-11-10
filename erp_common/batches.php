<table class='sc-table'>
<tr><th>Course Name</th><th>Batches</th><th>Edit</th><th>Delete</th></tr>
<?php foreach ($batches as $v) {
echo "<tr><td>$v->course</td><td>$v->batch</td><td><a class='btn btn-default btn-sm' href='".base_url()."erp/editbatch/$v->id'><i class='fa fa-pencil'></i></a></td><td><button class='btn btn-sm btn-default'><i class='fa fa-close' onclick=\"showDelete($v->id,this)\"></i></button></td></tr>";
} 
?>
</table>