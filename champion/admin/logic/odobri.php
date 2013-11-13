<?php
	include "common.php";
	$id_upload = $_POST['id'];
	$odobreno = $_POST['status'];
	
	$update = " update upload 
				set	f_odobreno = $odobreno
				where id_upload= $id_upload
				
			"; 
	try { 
		$stmt = $db->prepare($update); 
		$result = $stmt->execute(); 
		echo "Promenjeno!";
	} 
	catch(PDOException $ex) { 
	
		die("Failed to run update: " . $ex->getMessage()); 
	} 
?>