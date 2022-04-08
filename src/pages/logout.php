<?php
	if(!isset($_SESSION)) {
    	session_start();
	}
	if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
		session_unset();
		session_destroy();
		header('Location: ./index.php');
	} else {
		header('Location: ./already-logged-out.php');
	}
?>