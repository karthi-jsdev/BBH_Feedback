<?php
	session_start();
	ini_set("display_errors", "0");
	date_default_timezone_set("Asia/Kolkata");
	require("../Config.php");
	require($_POST['Module']."_Queries.php");
	
	switch($_POST['Action'])
	{
		case "AjaxPagination":
			$Count_Device_Reports = mysql_fetch_array(Count_Device_Reports());
			echo $Count_Device_Reports['total']."$";
			if(!$Count_Device_Reports['total'])
				echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$_POST['total_pages'] = ceil($Count_Device_Reports['total'] / $Limit);
			if(!$_POST['CurrentPageNo'])
				$_POST['CurrentPageNo'] = 1;
			$i = $Start = ($_POST['CurrentPageNo']-1)*$Limit;
			$Device_Reports = Select_Device_Reports($Start, $Limit);
			while($Device_Report = mysql_fetch_array($Device_Reports))
			{
				echo '<tr>
					<td>'.++$i.'</td><td>'.$Device_Report['deviceName'].'('.$Device_Report['deviceId'].')</td><td>'.date('h:i:s a d/m/Y', strtotime($Device_Report['dateTime'])).'</td><td>'.$Device_Report['info'].'</td><td>'.$Device_Report['logType'].'</td><td>';
					if($Device_Report['preErrorCode'])
					{
						$pc = $Device_Report['preErrorCode'];
						$intpc = (int)$pc;
						$pcon = decbin($intpc);
						$strpc = (string)$pcon;
						$sppc = str_split($strpc, 1);
						if(count($sppc) == 1)
						{
							if($sppc[0] == 1)
								$patt = "0001";
							if($sppc[0] == 0)
								$patt = "0000";
						}
						else if(count($sppc) == 2)
							$patt = "00".$sppc[0].$sppc[1];
						else if(count($sppc) == 3)
							$patt = "0".$sppc[0].$sppc[1].$sppc[2];
						else if(count($sppc) == 4)
							$patt = $strpc;
						$exppc = str_split($patt, 1);
						
						if(count($exppc) == 4)
						{
							for($j = 0;$j < 4;$j++)
							{
								if($exppc[$j] == 1 && $j==0)
									echo "<a class='action-button'><span class='gps1'></span></a>";
								if($exppc[$j] == 0 && $j==0)
									echo "<a class='action-button'><span class='gps'></span></a>";
								if($exppc[$j] == 1 && $j==1)
									echo "<a class='action-button'><span class='gprs1'></span></a>";
								if($exppc[$j] == 0 && $j==1)
									echo "<a class='action-button'><span class='gprs'></span></a>";
								if($exppc[$j] == 1 && $j==2)
									echo "<a class='action-button'><span class='gsm1'></span></a>";
								if($exppc[$j] == 0 && $j==2)
									echo "<a class='action-button'><span class='gsm'></span></a>";
								if($exppc[$j] == 1 && $j==3)
									echo "<a class='action-button'><span class='sd1'></span></a>";
								if($exppc[$j] == 0 && $j==3)
									echo "<a class='action-button'><span class='sd'></span></a>";
							}
						}
					}
					
					echo '</td><td>';
					if($Device_Report['errorCode'])
					{
						$ec = $Device_Report['errorCode'];
						$intec = (int)$ec;
						$con = decbin($intec);
						$strec = (string)$con;
						$spec = str_split($strec, 1);
						if(count($spec) == 1)
						{
							if($spec[0] == 1)
								$att = "0001";
							if($spec[0] == 0)
								$att = "0000";
						}
						else if(count($spec) == 2)
							$att ="00".$spec[0].$spec[1];
						else if(count($spec) == 3)
							$att = "0".$spec[0].$spec[1].$spec[2];
						else if(count($spec) == 4)
							$att = $strec;
						$expec = str_split($att, 1);
						if(count($expec) == 4)
						{
							for($j = 0;$j < 4;$j++)
							{
								if($expec[$j] == 1 && $j==0)
									echo "<a class='action-button'><span class='gps1'></span></a>";
								if($expec[$j] == 0 && $j==0)
									echo "<a class='action-button'><span class='gps'></span></a>";
								if($expec[$j] == 1 && $j==1)
									echo "<a class='action-button'><span class='gprs1'></span></a>";
								if($expec[$j] == 0 && $j==1)
									echo "<a class='action-button'><span class='gprs'></span></a>";
								if($expec[$j] == 1 && $j==2)
									echo "<a class='action-button'><span class='gsm1'></span></a>";
								if($expec[$j] == 0 && $j==2)
									echo "<a class='action-button'><span class='gsm'></span></a>";
								if($expec[$j] == 1 && $j==3)
									echo "<a class='action-button'><span class='sd1'></span></a>";
								if($expec[$j] == 0 && $j==3)
									echo "<a class='action-button'><span class='sd'></span></a>";
							}
						}
					}
					echo "<a class='action-button'><span class='tcp".$Device_Report["tcpStatus"]."'></span></a></td>
				</tr>";
			}
			echo "$";
			require("../Ajax_Pagination.php");
		break;
		
		case "Export":
			$ExportFileName = $_SESSION['Filter']['Module']." ".date("Y_m_d", strtotime($_POST['startdate']))."-".date("Y_m_d", strtotime($_POST['enddate'])).".xlsx";
			$Device_Reports = Select_Device_Reports("", "");
			$Header = array("Title" => $_SESSION['Filter']['Module']." Report ".date("d-M-Y", strtotime($_POST['startdate']))." : ".date("d-M-Y", strtotime($_POST['enddate'])),
			"Description" => "Total ".$_SESSION['Filter']['Module']." Logs : ".mysql_num_rows($Device_Reports));
			$TableHeader = Array('S.No.', 'Vehicle(Id)', 'Date Time', 'Information', 'Error Type', 'Pre Error Code', 'Error Code');
			$TableData = Array();
			$i = 0;
			while($Device = mysql_fetch_array($Device_Reports))
			{
				$TableData[] = array('A'.(6+(++$i)) => $i,
				'B'.(6+$i) => $Device['deviceName']." (".$Device['deviceId'].")",
				'C'.(6+$i) => date('h:i:s a d/m/Y', strtotime($Device['dateTime'])),
				'D'.(6+$i) => $Device['info'],
				'E'.(6+$i) => $Device['logType'],
				'F'.(6+$i) => $Device['preErrorCode'],
				'G'.(6+$i) => $Device['errorCode']);
			}
			require("../PHPExcel_1.8.0/Export.php");
		break;
	}
?>