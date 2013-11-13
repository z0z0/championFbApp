<?php
	session_start();
	$error = "";
	$msg = "";
	
	if (!file_exists('uploads/'.$user_id)) {
   $target = mkdir('uploads/'.$user_id, 0777, true);
	}
	
	if(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{		
		
	
			$error .= 'Greska pri uploadu.';	

	}
	else 
	{
		//$url = 'uploads/'.$user_id.'/'.$_FILES['fileToUpload']['name'];
		$file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
		$file_size =$_FILES['fileToUpload']['size'];
		if($file_size > 2097152) {
			$error .= 'Proverite velicinu Vase slike. Max 2MB';
		}
		
		
		$expensions = array("jpeg","jpg","png"); 		
			if(in_array($file_ext,$expensions)=== false){
			$error .="Nedozvoljena ekstenzija! Molimo izaberite JPEG ili PNG fajl.";
			}
				
		if(empty($error)===true){
		$fileInfo = pathinfo($_FILES["fileToUpload"]["name"]);
		$random = uniqid();
		$url = 'uploads/'.$random. '.' . $fileInfo['extension'];
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $url);
		$msg .= "$url";
		}

	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>