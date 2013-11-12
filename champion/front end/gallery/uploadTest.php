<?php

 $error = "";
  $msg = "";

if(isset($_POST['fileToUpload'])) {

	$allowed_filetypes = array('.jpg','.jpeg','.png','.gif');
	$max_filesize = 10485760;
	$upload_path = 'uploads/';
	

$filename = $_FILES['fileToUpload']['name'];
$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1);

if(!in_array($ext,$allowed_filetypes))
  die('The file you attempted to upload is not allowed.');

if(filesize($_FILES['fileToUpload']['tmp_name']) > $max_filesize)
  die('The file you attempted to upload is too large.');

if(!is_writable($upload_path))
  die('You cannot upload to the specified directory, please CHMOD it to 777.');

if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$upload_path . $filename)) {
  $error = "";
  $msg = "";

	

} else {
   
}

	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
}
?>