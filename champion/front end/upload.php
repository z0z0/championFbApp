<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/upload.js"></script>
	</head>	
	<script type="text/javascript">
	
	$("document").ready(function(){
    
    $("#slika1").change(function() {
		console.log('change?');
		return ajaxFileUpload(1);
	});

	$("#slika2").change(function() {
	console.log('change?');
		ajaxFileUpload(2);
	});
    
});
	
	function ajaxFileUpload(id)
	{
		var target_id;
		
		if(id === 1){
			target_id = 'slika1';
		}
		
		else if(id === 2){
			target_id = 'slika2';
		}
	
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'gallery/upload.php',
				secureuri:false,
				fileElementId: target_id,
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
							console.log(data.msg)
							$('#'+target_id).parent().parent().parent().find('.uploaded').html('<img src="gallery/'+data.msg+'" alt="imaž" style="width:100%; height:auto;" />');
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}
	</script>	
<body>
	<div id="container" class="upload">
		<div id="upload-area">
			<img id="loading" src="img/loading.gif" class="loader">
			<div class="img-holder "id="pre">
				<form name="form" action="" method="POST" enctype="multipart/form-data">	
					<div class="uploaded"></div>
					<div class="controls">
						<div class="mask"><input id="slika1" type="file" name="fileToUpload" class="input"></div>
						<span class="delete">&nbsp;</span>
					</div>
				</form>    	
			</div>	
			<div class="img-holder" id="posle">	
				<form name="form" action="" method="POST" enctype="multipart/form-data">	
					<div class="uploaded"></div>
					<div class="controls">
						<div class="mask"><input id="slika2" type="file" name="fileToUpload" class="input"></div>
						<span class="delete">&nbsp;</span>
					</div>					
				</form>  
			</div>
		</div>
		<div id="info-area">
			<div class="column-half">
				<input type="text" placeholder="* Ime i Prezime">
				<a href="#" class="send-btn">Posalji</a>
			</div>
			<div class="column-half">
				<input type="text" placeholder="* Broj Mobilnog Telefona">
				<input type="text" placeholder="* Email">
				<div class="column-thirds">
					<input type="text" placeholder="* Godište">
					<input type="text" placeholder="* Pol">
					<input type="text" placeholder="* Grad">
				</div>
			</div>
		</div>
	</div>
</body>
</html>