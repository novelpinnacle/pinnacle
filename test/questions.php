<?php 
header("Access-Control-Allow-Origin:*");
if(isset($_FILES['file']['name']))
{
 $file = $_FILES['file']['tmp_name'];
 $file_name = $_FILES['file']['name'];
 $file_name_array = explode(".", $file_name);
 $extension = end($file_name_array);
 $new_image_name = rand() . '.' . $extension;
 $new_image_name = $file_name_array[0].'.'.'png';
 move_uploaded_file($file, 'question-images/' . $new_image_name);
 echo json_encode([$file_name => $new_image_name ]);
}
?>