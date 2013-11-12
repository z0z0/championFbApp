<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/upload.js"></script>
		<script type="text/javascript" src="js/fb.js"></script>
	</head>	
	<script type="text/javascript">
	
	$("document").ready(function(){
    
  
	
	$("#send").click(function(){	
		if (validacija()){			
			$('#tar_sl1').val($('#first img').attr('src'));
			$('#tar_sl2').val($('#second img').attr('src'));
			var form_data = $('#reg-fields').serialize();
			console.log(form_data);
			return false;
		}
	});
	
	$(".delete").click(function(){
		$(this).parent().siblings().html('');
	});
	
	function validacija(){
		var mail_validation;
		var error = false;
		var email = $("#email").val();
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		mail_validation =  regex.test(email);
		
		if(!mail_validation){
			$("#email").addClass('warning');
			error = true;
		}
		
		$("input[type=text]").each(function(){			
			if( !$(this).val()){
				$(this).addClass('warning');
				error = true;
			}
		});	
		if(!error){
			return true;
		}
	}
	
	$("input[type=text]").focus(function(){
		$(this).removeClass('warning');
	})
    

});	
	function ajaxFileUpload(id)
	{
		$("#loading").show();
		var target_id;
		
		if(id === 1){
			target_id = 'slika1';
		}
		
		else if(id === 2){
			target_id = 'slika2';
		}
	
		

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
							$("#loading").hide();
						}else
						{							
							$('#'+target_id).parent().parent().parent().find('.uploaded').html('<img src="gallery/'+data.msg+'" alt="imaž" style="width:100%; height:auto;" />');
							$("#loading").hide();
							$("input[type=file]").val('');
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
					$("#loading").hide();
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
					<div class="uploaded" id="first"></div>
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
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>