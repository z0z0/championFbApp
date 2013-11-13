<?php
	session_start();
	if(!$_SESSION['active']){
    header( 'Location: index.php' ) ;
 }	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" media="screen" href="css/main.css"/>
	<link href="css/lightbox.css" rel="stylesheet" />
	<link href="css/style.css" rel="stylesheet" />
	<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="../js/lightbox-2.6.min.js"></script>
	<script type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>

	<script type="text/javascript">
		$(function() {
	
      
 
		
			$("table tr:nth-child(odd)").addClass("odd-row");
			$("table td:first-child, table th:first-child").addClass("first");
			$("table td:last-child, table th:last-child").addClass("last");
			
			$('.controls').click(function(){
				var isChecked = $(this).prop('checked') ? 1 : 0;
				var uploadId = $(this).attr('data-id');
				var element = $(this).siblings('.response');
				console.log(isChecked+" id: "+uploadId);
				$.post( "logic/odobri.php", { status: isChecked, id: uploadId }, function( data ) {
				
					element.fadeIn( 1000 , function() {
						console.log('batman')
						$(this).html( data);
					}).fadeOut( 1000 );
				console.log(data);
			})
			});
		});
		
		$(document).ready(function(){
			$("#user-table").tablesorter(); 
		}); 
	</script>
</head>
<body>	
	<div id="container">
		<h5 class="login">
		<a href="link_do_aplikacije"><img src='../img/pre_posle.jpg' alt="logo" style="float:left;"/></a>
		<?php
			echo "Welcome, ". @$_SESSION['username'] . "";
		?>
		
		<a href="odjava.php">Logout</a>
		</h5>
		
		<table class="admin-table tablesorter" id="user-table">
			<thead>
				<tr>
					<th>Slike</th>
					<th>Lični podaci</th>
					<th>Email</th>
					<th>Pol</th>
					<th>Telefon</th>
					<th>Godište</th>
					<th>Grad</th>
					<th>Broj glasova</th>
					<th>Odobreno</th>				
				</tr>
			</thead>
			<tbody>
				<?php
					include 'logic/common.php';
						$query = '
							SELECT up.id_upload, up.slika1, up.slika2, uo.ime_prezime, uo.pol, uo.telefon, uo.godiste, uo.grad, COALESCE(uo.email) as email, u.fb_id,
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
										<a href="../'. $row['slika1'] .'" data-lightbox="image-'.$row['id_upload'].'"><img src="../'. $row['slika1'] .'" style="width:50px; height:50px;" alt="'. $row['slika1'] .'"></a>
										<a href="../'. $row['slika2'] .'" data-lightbox="image-'.$row['id_upload'].'"><img src="../'. $row['slika2'] .'" style="width:50px; height:50px;" alt="'. $row['slika2'] .'"></a>
									</td>
									<td class="align-center" >
										<a href="http://www.facebook.com/'.$row['fb_id'].'" target="_blank">' . $row['ime_prezime']. '</a>
									</td>
									<td class="align-center" >' . $row['email']. '</td>
									<td class="align-center" >' . $row['pol']. '</td>
									<td class="align-center" >' . $row['telefon']. '</td>
									<td class="align-center" >' . $row['godiste']. '</td>
									<td class="align-center" >' . $row['grad']. '</td>
									<td class="align-center" >' . $row['like_count'] . '</td>
									<td class="align-center" style="position:relative;"><span style="visibility:hidden;">'.$row['odobreno'].'</span><input type="checkbox" class="controls" data-id="'. $row['id_upload'] .'" '. $tip_attr .'><span class="response"></span></td>';
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