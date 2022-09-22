<?php
	$mysqli_hostname = "localhost";
	$mysqli_user = "root";
	$mysqli_password = "";
	$mysqli_database = "bbh_management";
	$dbh = mysqli_connect ($mysqli_hostname, $mysqli_user, $mysqli_password) or die ('I cannot connect to the database because: ' . mysqli_error());
	mysqli_select_db ($mysqli_database, $dbh) or die ('I cannot select the database because: ' . mysqli_error());
?>