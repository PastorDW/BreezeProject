<?php
include("connection.php");

$tmp_name =  $_FILES['filename'] ['tmp_name'];
$uploadname = $_FILES['filename'] ['name'];
$size = $_FILES['filename'] ['size'];
$error = $_FILES['filename'] ['error'];
if($error != UPLOAD_ERR_OK)
{
  echo $error;
  exit();
}

move_uploaded_file ($tmp_name, "uploads/$uploadname");

header("location: action.php?filename=$uploadname");




?>
