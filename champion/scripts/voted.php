<?php
	include "../admin/logic/common.php";
	$upl_id = $_POST['id'];
	$fid = $_POST['fid'];
	
	$update = " SELECT COUNT(*) as postoji FROM upload_like 
				WHERE id_upload = $upl_id				
				AND fb_id = '$fid'		
			"; 
	try { 
		$stmt = $db->prepare($update); 
		$result = $stmt->execute(); 
		$row = $stmt->fetch();
		echo $row['postoji'];
	} 
	catch(PDOException $ex) { 
	
		die("Failed to run update: " . $ex->getMessage()); 
	} 
?>