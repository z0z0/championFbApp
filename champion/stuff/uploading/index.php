<html>
	<head>
		<title>Ajax File Uploader Plugin For Jquery</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/upload.js"></script>
	<script type="text/javascript">
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
				url:'upload.php',
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
							$('#'+target_id).parent().parent().find('.uploaded').html(data.msg);
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
	</head>

<body>

    <div id="wrapper">	
		<img id="loading" src="loading.gif" style="display:none;">
		<div id="pre">
			<form name="form" action="" method="POST" enctype="multipart/form-data">	
				<div class="uploaded">	Dodaj Sliku</div>
				<div>
					<input id="slika1" type="file" size="45" name="fileToUpload" class="input">
				</div>

				<div>
					<button class="button" id="upload1" onclick="return ajaxFileUpload(1);">Upload</button>
				</div>
			</form>    	
		</div>	
		<div id="posle">	
			<form name="form" action="" method="POST" enctype="multipart/form-data">	
				<div class="uploaded">	Dodaj Sliku</div>
				<div>
					<input id="slika2" type="file" size="45" name="fileToUpload" class="input">
				</div>

				<div>
					<button class="button" id="upload2" onclick="return ajaxFileUpload(2);">Upload</button>
				</div>
			</form>  
		</div>
    </div>
    

</body>
</html>