<?php
	session_start();
	foreach($_SESSION as $key => $value)
	{
		$_SESSION[$key]="";
		unset($_SESSION[$key]);
		//session_unregister($key);
	}
	session_unset();
	session_destroy();
	header ("Location:../index.php");
?>