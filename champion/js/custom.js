$("document").ready(function(){	
	$("#send").click(function(event){	
		event.preventDefault();
		if (validacija()){			
			$('#tar_sl1').val($('#first img').attr('src'));
			$('#tar_sl2').val($('#second img').attr('src'));
			$('#fbid').val(uid)
			var form_data = $('#reg-fields').serialize();
			console.log(form_data);
			$.post( "scripts/register.php", form_data , function( data ) {
				console.log(data);
				window.location.href = 'gallery.php';
			})
			
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
		$("#overlay-area").show();
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
							$("#overlay-area").hide();
						}else
						{							
							$('#'+target_id).parent().parent().parent().find('.uploaded').html('<img src="gallery/'+data.msg+'" alt="imaž" style="width:100%; height:auto;" />');
							$("#loading, #overlay-area").hide();
							$("input[type=file]").val('');
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
					$("#loading").hide();
					$("#overlay-area").hide();
				}
			}
		)		
	return false;
}