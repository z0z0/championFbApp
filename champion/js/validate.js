function verifyContest(){			
	$.post( "scripts/validate.php", { fid: uid }, function( data ) {
		
		console.log(data)
		if (data != 0 || data != '0'){
			//window.location.href = 'gallery.php';
			$(".signup, .signup-g").css('background', 'transparent');
			$(".signup a, .signup-g a").hide();
		}	
		else {
			window.location.href = 'upload.php';
		}
	});	
}