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
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript">
 $(function() {
		/* For zebra striping */
        $("table tr:nth-child(odd)").addClass("odd-row");
		/* For cell text alignment */
		$("table td:first-child, table th:first-child").addClass("first");
		/* For removing the last border */
		$("table td:last-child, table th:last-child").addClass("last");
});
</script>

<style type="text/css">

	html, body, div, span, object, iframe,
	h1, h2, h3, h4, h5, h6, p, blockquote, pre,
	abbr, address, cite, code,
	del, dfn, em, img, ins, kbd, q, samp,
	small, strong, sub, sup, var,
	b, i,
	dl, dt, dd, ol, ul, li,
	fieldset, form, label, legend,
	table, caption, tbody, tfoot, thead, tr, th, td {
		margin:0;
		padding:0;
		border:0;
		outline:0;
		font-size:100%;
		vertical-align:baseline;
		background:transparent;
	}
	
	body {
		margin:0;
		padding:0;
		font:12px/15px "Helvetica Neue",Arial, Helvetica, sans-serif;
		color: #555;
		background:#f5f5f5 url(bg.jpg);
	}
	
	a {color:#666;}
	
	#content {width:65%; max-width:690px; margin:6% auto 0;}
	
	/*
	Pretty Table Styling
	CSS Tricks also has a nice writeup: http://css-tricks.com/feature-table-design/
	*/
	
	table {
		overflow:hidden;
		border:1px solid #d3d3d3;
		background:#fefefe;
		width:70%;
		margin:5% auto 0;
		-moz-border-radius:5px; /* FF1+ */
		-webkit-border-radius:5px; /* Saf3-4 */
		border-radius:5px;
		-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
		-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	}
	
	th, td {padding:18px 28px 18px; text-align:center; }
	
	th {padding-top:22px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}
	
	td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}
	
	tr.odd-row td {background:#f6f6f6;}
	
	td.first, th.first {text-align:left}
	
	td.last {border-right:none;}
	
	/*
	Background gradients are completely unnecessary but a neat effect.
	*/
	
	td {
		background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
	}
	
	tr.odd-row td {
		background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
		background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
	}
	
	th {
		background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
		background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
	}
	
	/*
	I know this is annoying, but we need additional styling so webkit will recognize rounded corners on background elements.
	Nice write up of this issue: http://www.onenaught.com/posts/266/css-inner-elements-breaking-border-radius
	
	And, since we've applied the background colors to td/th element because of IE, Gecko browsers also need it.
	*/
	
	tr:first-child th.first {
		-moz-border-radius-topleft:5px;
		-webkit-border-top-left-radius:5px; /* Saf3-4 */
	}
	
	tr:first-child th.last {
		-moz-border-radius-topright:5px;
		-webkit-border-top-right-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.first {
		-moz-border-radius-bottomleft:5px;
		-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
	}
	
	tr:last-child td.last {
		-moz-border-radius-bottomright:5px;
		-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
	}

</style>
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