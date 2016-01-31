<?php
	session_start();
	
	unset($_SESSION['logged']);
	session_destroy();
	
	header('location:index.php');
	exit();
?>