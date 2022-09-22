<table class="paginate sortable full">
<?php
	session_start();
	include("Reviews_Queries.php");
	include("Config.php");
	ini_set('default_errors',0);
	$i=1;
	
	$Modules = Select_Modules_By_DepartmentId();
	$_SESSION[$_SESSION['Prefix'].'Modules'][] = $_SESSION[$_SESSION['Prefix'].'Modules'] = array();
	$_SESSION[$_SESSION['Prefix'].'Module_Names'][] = $_SESSION[$_SESSION['Prefix'].'Module_Names'] = array();
	$_SESSION[$_SESSION['Prefix'].'Module_Answer_Ids'][] = $_SESSION[$_SESSION['Prefix'].'Module_Answer_Ids'] = array();
	$i = -1;
	$iTemp = $jTemp = $kTemp = "";
	while($Module = mysql_fetch_array($Modules))
	{
		if($iTemp != $Module['Id'])
		{
			$iTemp = $Module['Id'];
			++$i;
			$_SESSION[$_SESSION['Prefix'].'Modules'][$i][] = $Module['Id'];
			$_SESSION[$_SESSION['Prefix'].'Module_Names'][$i][] = $Module['name'];
			$_SESSION[$_SESSION['Prefix'].'Module_Answer_Ids'][$i][] = $Module['option_ids'];
			$_SESSION[$_SESSION['Prefix'].'Module_Answers'][$i][] = $Module['option_ids'];
		}
		if($Module['SEC_Id1'] && $jTemp != $Module['SEC_Id1'])
		{
			$jTemp = $Module['SEC_Id1'];
			$_SESSION[$_SESSION['Prefix'].'Modules'][$i][] = $Module['SEC_Id1'];
			$_SESSION[$_SESSION['Prefix'].'Module_Names'][$i][] = $Module['SEC_name1'];
		}
	}
	$Qids = array();
	for($i = 0;$i < count($_SESSION[$_SESSION['Prefix'].'Modules']); $i++)
	{
		echo "<div id='Q".($i+1)."' style='display:none;'>
			<table class='paginate sortable full'>";
		if(count($_SESSION[$_SESSION['Prefix'].'Modules'][$i]) > 1)
		{
			echo ($i+1).". ".$_SESSION[$_SESSION['Prefix'].'Module_Names'][$i][0].'
			<thead><tr align="left">
			';
			$Options = Select_Options_ByIds($_SESSION[$_SESSION['Prefix'].'Modules'][$i][0]);
			while($Option = mysql_fetch_array($Options))
				echo "<th>Answer:&nbsp;&nbsp;".$Option['answer']."</th>";
			echo "<tr><thead>";
		}
	}
	if(isset($_GET['loginid']) && $_GET['patientid'])
	{
		$list = mysql_fetch_assoc(mysql_query("SELECT count(*) as total,id FROM feedback_reviews WHERE reviewer_id='".$_GET['loginid']."' && patient_id='".$_GET['patientid']."' && groups_id='".$_GET['group_id']."'"));
		if(isset($_GET['ticket']))
			mysql_query("update feedback_reviews set ticket_id='1' WHERE id='".$list['id']."'");
		else if($list['total']<1)
			mysql_query("INSERT INTO feedback_reviews (groups_id,patient_id,reviewer_id,review,ticket_id,date_time) VALUES ('".$_GET['group_id']."','".$_GET['patientid']."','".$_GET['loginid']."','1','','".date('Y-m-d H:i:s')."')");
	}
?>
</table>