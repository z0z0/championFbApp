<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" media="all" href="style.css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>	
	<script type="text/javascript" src="jquery-1.9.1.js"></script>
	
	<style>
		body{ background-color: #ffffff; font-family:Arial, sans-serif; text-align:center;}
		div {margin: auto; }
		.row{margin:10px auto;}
		#login-form{width:500px; overflow:hidden; border:1px solid gray; padding:5px; margin:20px auto;}
	</style>
</head>
<body>
	<h1>Admin Login</h1>
	<div id="login-form">
	<form action="logic/loging.php" method="post">
		<div class="row">
			<label for="username">Username</label>
			<input type="text" name="username" id="username"/>
		</div>
		<div class="row">
			<label for="username">Password</label>
			<input type="password" name="password" id="password"/>
		</div>
		<input type="submit" value="Login"/>
	</form>
	</div>	
</body>
</html>