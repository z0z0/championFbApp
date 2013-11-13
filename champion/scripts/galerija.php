<?php
	include '../admin/logic/common.php';
	
	$order_by = $_POST['order'];
	//$order_by = 0;
	$pom;
	switch ($order_by) {
		case 0:
			$pom = 'like_count DESC';
			break;
		case 1:
			$pom = 'uo.ime_prezime ASC';
			break;
		case 2:
			$pom = 'up.vreme DESC';
			break;
	}
	$query = '
		SELECT up.id_upload, up.vreme, up.slika1, up.slika2, uo.ime_prezime,  
				(select count(*) from upload_like where id_upload = up.id_upload) as like_count
				FROM  user u left outer join user_opis uo on u.id_user = uo.id_user,
				upload up
				WHERE up.f_odobreno = 1 AND u.id_user = up.id_user
				ORDER BY '.$pom.' ;
		';

	try {
		$stmt = $db->prepare($query);
		$result = $stmt->execute();
	} catch (PDOException $ex) {
		die("Failed to run query: " . $ex->getMessage());
	}

	while (($row = $stmt->fetch()) != NULL) {
		
		echo '
			<li class="item" onclick="showLike(this) "data-id="'. $row['id_upload'] .'">		
				<img class="img-first" src="'. $row['slika1'] .'" alt="gallery-block"/><img class="img-second" src="'. $row['slika2'] .'" alt="gallery-block"/>
				<div class="item-info"><span class="name">'. $row['ime_prezime'] .'</span><span class="likes">'. $row['like_count'] .'</span></div>
			</li>
			';
			}
?>								  