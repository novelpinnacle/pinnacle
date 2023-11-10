<table class='sc-table'>
<tr><th>Course Name</th><th>Edit</th><th>Delete</th></tr>
<?php foreach ($courses as $v) {
echo "<tr><td>$v->course</td><td><a class='btn btn-default btn-sm' href='".base_url()."erp/editcourse/$v->id'><i class='fa fa-pencil'></i></a></td><td><button class='btn btn-default btn-sm' onclick=\"showDelete($v->id,this)\" ><i class='fa fa-close' ></i></button></td></tr>";
} 
?>
</table>