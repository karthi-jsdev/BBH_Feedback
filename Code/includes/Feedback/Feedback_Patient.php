<?php
	ini_set("display_errors", "0");
	session_start();
	include("../Config.php");
	include("Feedback_Queries.php");
	if($Patientnumber = mysql_fetch_array(mysql_query("SELECT * FROM patients WHERE patient_id=".$_POST['patientno']."")))
	{
		echo $Patientnumber['name'].'#'.$Patientnumber['private_or_general'].'#'.$Patientnumber['contact'].'#'.$Patientnumber['email'].'#'.$Patientnumber['service_available_department'].'#'.$Patientnumber['visit_date_time'];
	}
?>