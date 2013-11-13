<?php
	include "../admin/logic/common.php";
	
	$fid = $_POST['fid'];
	
	$update = " SELECT COUNT(*) as postoji FROM user u, upload up
				WHERE u.id_user = up.id_user				
				AND u.fb_id = '$fid'				
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