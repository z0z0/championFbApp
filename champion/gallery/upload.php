<?php
	$error = "";
	$msg = "";
	
	
	
	if(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{		
		
	
			$error .= 'Greska pri uploadu.';	

	}
	else 
	{
		$url = "uploads/".$_FILES['fileToUpload']['name'];
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
		
		
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $url);
		$msg .= "$url";
		}

	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>