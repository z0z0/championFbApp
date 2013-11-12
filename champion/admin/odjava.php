<?php
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['active']);

	header("Location: index.php");
	die("Redirecting to: index.php");
?>