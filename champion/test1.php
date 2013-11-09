<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Conforming XHTML 1.0 Strict Template</title>
</head>
<body>
 
	<h1> This is a basic page! </h1>
	<pre>
	<?php
	session_start();
	print "hello world!";
	
	echo "<strong>ygbygbb ". @$_SESSION['username'] . "</strong>";
	
	?>
	
	
	</pre>
	<br />
	<p> Even added <span style="font-size: 150%">some </span> decoration! </p>
</body>
</html>