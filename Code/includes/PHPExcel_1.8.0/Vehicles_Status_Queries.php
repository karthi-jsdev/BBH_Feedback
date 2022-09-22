<?php
	function Count_Device_Reports()
	{
		return mysqli_query("SELECT COUNT(*) AS total FROM `log` WHERE deviceId=".$_POST['deviceId']." && (log.logType=".str_replace(",", " || log.logType=", $_POST['type']).") && dateTime>='".date("Y-m-d H:i:s",strtotime($_POST['startdate']))."' && dateTime<='".date("Y-m-d H:i:s",strtotime($_POST['enddate']))."' ORDER BY id");
	}
	function Select_Device_Reports($Start, $Limit)
	{
		$SQL_Limit = "";
		if($Limit)
			$SQL_Limit = "LIMIT $Start, $Limit";
		return mysqli_query("SELECT log.*, devices.deviceName, devices.tcpStatus FROM `log`
		JOIN devices ON devices.id=log.deviceId
		WHERE log.deviceId=".$_POST['deviceId']." && (log.logType=".str_replace(",", " || log.logType=", $_POST['type']).") && log.dateTime>='".date("Y-m-d H:i:s",strtotime($_POST['startdate']))."' && log.dateTime<='".date("Y-m-d H:i:s",strtotime($_POST['enddate']))."' ORDER BY log.id DESC $SQL_Limit");
	}
?>