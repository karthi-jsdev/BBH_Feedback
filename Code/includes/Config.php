<?php
	$_SESSION[$_SESSION['Prefix'].'ServerHost'] = "localhost";
	$_SESSION[$_SESSION['Prefix'].'ServerUser'] = "root"; 
	$_SESSION[$_SESSION['Prefix'].'ServerPassword'] = "";
	$_SESSION[$_SESSION['Prefix'].'ServerDB'] = "bbh_feedback";
	// $dbh = mysqli_connect($_SESSION[$_SESSION['Prefix'].'ServerHost'], $_SESSION[$_SESSION['Prefix'].'ServerUser'], $_SESSION[$_SESSION['Prefix'].'ServerPassword']) or die ('I cannot connect to the database because: ' . mysqli_error());
	// mysqli_select_db($_SESSION[$_SESSION['Prefix'].'ServerDB'] , $dbh) or die ('I cannot select the database because: '.mysqli_error());


	$connection = mysqli_connect("localhost", "root", "", "bbh_feedback");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }


    // Selecting a database 

    $db_select = mysqli_select_db($connection, "bbh_feedback");
    if (!$db_select) {
        die("Database selection failed: " . mysqli_connect_error());
    }

?>