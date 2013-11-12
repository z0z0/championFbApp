<?php 
		require 'scripts/facebook.php';
		
		$app_id = "430747907025436";
		$app_secret = "f0142d20d21355503b015878091bbf98";
		$facebook = new Facebook(array(
			'appId' => $app_id,
			'secret' => $app_secret,
			'cookie' => true
		));
		
		$signed_request = $facebook->getSignedRequest();
		$like_status = $signed_request["page"]["liked"];
		
		if ($like_status){
			header("Location: landing.php"); 
		//ovde sada treba vidimo da li ima usera u bazi uploada po ID-u
			$uid = $facebook->getUser();
	}
	
	else {
		 header("Location: like_us.php"); 
	}
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css"/>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	</head>
	
<body>
	
</body>
</html>