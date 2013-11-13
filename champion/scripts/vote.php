<?php
	include "../admin/logic/common.php";
	$id_upload = $_POST['id'];
	$fid = $_POST['fid'];
	
	$update = " INSERT IGNORE INTO upload_like
		SET 
		id_upload = '$id_upload',
		fb_id = '$fid'				
			"; 
	try { 
		$stmt = $db->prepare($update); 
		$result = $stmt->execute(); 
		echo "liked";
	} 
	catch(PDOException $ex) { 
	
		die("Failed to run update: " . $ex->getMessage()); 
	} 
?>