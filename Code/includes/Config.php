<?php
	$_SESSION[$_SESSION['Prefix'].'ServerHost'] = "localhost";
	$_SESSION[$_SESSION['Prefix'].'ServerUser'] = "root"; 
	$_SESSION[$_SESSION['Prefix'].'ServerPassword'] = "";
	$_SESSION[$_SESSION['Prefix'].'ServerDB'] = "bbh_feedback";
    $dbh = mysqli_connect($_SESSION[$_SESSION['Prefix'].'ServerHost'], $_SESSION[$_SESSION['Prefix'].'ServerUser'], $_SESSION[$_SESSION['Prefix'].'ServerPassword']) or die ('I cannot connect to the database because: ' . mysqli_error());
	$connection = mysqli_select_db($dbh,$_SESSION[$_SESSION['Prefix'].'ServerDB']) or die ('I cannot select the database because: '.mysqli_error());
	$_SESSION[$_SESSION['Prefix'].'connection'] = mysqli_connect($_SESSION[$_SESSION['Prefix'].'ServerHost'], $_SESSION[$_SESSION['Prefix'].'ServerUser'], $_SESSION[$_SESSION['Prefix'].'ServerPassword'],$_SESSION[$_SESSION['Prefix'].'ServerDB']);
?>