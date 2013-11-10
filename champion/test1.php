<?php
	session_start();
	if(!$_SESSION['active']){
    header( 'Location: index.php' ) ;
 }	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin Dashboard</title>
</head>
<body>	
	<div id="container">
		<?php
			echo "<strong> ". @$_SESSION['username'] . "</strong>";
		?>
		
		<a href="odjava.php">Logout</a>
		
		<table class="admin-table">
			<thead>
				<tr>
					<th>Slika</th>
					<th>Licni podaci</th>
					<th>Email</th>
					<th>Broj glasova</th>
					<th>Odobreno</th>				
				</tr>
			</thead>
			<tbody>
				<?php
					include '/logic/common.php';
						$query = '
							SELECT up.id_upload, up.slika1, up.slika2, uo.ime_prezime, COALESCE(uo.email) as email, 
									(select count(*) from upload_like where id_upload = up.id_upload) as like_count,
									up.f_odobreno as odobreno
									FROM  user u left outer join user_opis uo on u.id_user = uo.id_user,
									upload up
									WHERE u.id_user = up.id_user
									ORDER BY up.f_odobreno asc, like_count desc
							';

						try {
							$stmt = $db->prepare($query);
							$result = $stmt->execute();
						} catch (PDOException $ex) {
							die("Failed to run query: " . $ex->getMessage());
						}

						while (($row = $stmt->fetch()) != NULL) {
							if($row['odobreno'] === '1') {
								$tip_attr = 'checked';
							}
							else {
								$tip_attr = '';
							}
							echo '
								<tr>
									<td class="align-center" id="tdNaziv' . $row['id_upload']  . '">
										<img src="'. $row['slika1'] .'" style="width:50px; height:50px;" alt="'. $row['slika1'] .'">
										<img src="'. $row['slika2'] .'" style="width:50px; height:50px;" alt="'. $row['slika2'] .'">
									</td>
									<td class="align-center" >' . $row['ime_prezime']. '</td>
									<td class="align-center" >' . $row['email']. '</td>
									<td class="align-center" >' . $row['like_count'] . '</td>
									<td class="align-center"><input type="checkbox" '. $tip_attr .'></td>';
							?>								  
						 </tr>  	
						<?php
						}
						?>

			</tbody>
		</table>
	</div>
</body>
</html>