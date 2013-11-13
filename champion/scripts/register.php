<?php 

	
	

include '../admin/logic/common.php';

$uid = $_POST['fbid'];
$imeprez = $_POST['imeprezime'];
$telefon = $_POST['telefon'];
$email = $_POST['email'];
$godiste = $_POST['godiste'];
$pol = $_POST['pol'];
$grad = $_POST['grad'];
$slika1 = $_POST['slika1'];
$slika2 = $_POST['slika2'];

	
$query = "call user_insert('$uid', '$imeprez', '$email', '$telefon','$godiste','$grad', '$pol', '$slika1', '$slika2' );";

	try {
		$stmt = $db->prepare($query);
		$stmt->execute();
		echo "'$uid', '$imeprez', '$email', '$telefon','$godiste','$grad', '$pol', '$slika1', '$slika2'";
		
	} catch (PDOException $e) {
		die("Failed to run update: " . $e->getMessage());
	}
	
	
?>