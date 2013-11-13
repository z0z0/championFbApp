<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/upload.js"></script>
		<script type="text/javascript" src="js/fb.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
	</head>	
<body>
	<div id="container" class="upload">
		<div id="overlay-area"></div>
		<div id="upload-area">
			<img id="loading" src="img/loading.gif" class="loader">
			<div class="img-holder "id="pre">
				<form name="form1" action="" method="POST" enctype="multipart/form-data">	
					<div class="uploaded" id="first"></div>
					<div class="controls">
						<div class="mask"><input id="slika1" onchange="return ajaxFileUpload(1)" type="file" accept="image/*" name="fileToUpload" class="input"></div>
						<span class="delete">&nbsp;</span>
					</div>
				</form>    	
			</div>	
			<div class="img-holder" id="posle">	
				<form name="form2" action="" method="POST" enctype="multipart/form-data">	
					<div class="uploaded" id="second"></div>
					<div class="controls">
						<div class="mask"><input id="slika2" type="file" name="fileToUpload" class="input" accept="image/*" onchange="return ajaxFileUpload(2)"></div>
						<span class="delete">&nbsp;</span>
					</div>					
				</form>  
			</div>
		</div>
		<div id="info-area">
			<form id="reg-fields">
				<div class="column-half">
					<input type="text" name='imeprezime' placeholder="* Ime i Prezime">
					<a href="#" id="send" class="send-btn">Posalji</a>
				</div>
				<div class="column-half">
					<input type="text" name='telefon' placeholder="* Broj Mobilnog Telefona">
					<input type="text" name='email' id="email" placeholder="* Email">
					<div class="column-thirds">
						<input type="text" name='godiste' placeholder="* Godište">
						<input type="text" name='pol' placeholder="* Pol">
						<input type="text" name='grad' placeholder="* Grad">
						<input type="hidden" name='slika1'id='tar_sl1'>
						<input type="hidden" name='slika2' id='tar_sl2'>
						<input type="hidden" name='fbid' id='fbid'>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>