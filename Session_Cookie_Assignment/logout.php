<?php
	session_start();
	session_destroy();
	setcookie('session_id', null, -1, '/');
	header("Location:http://example.com/Session_Cookie_Assignment/login.html");
?>