<?php
	function Select_Modules_By_DepartmentId()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT Prime.Id, Prime.name, Prime.option_ids, SEC1.Id as SEC_Id1, SEC1.name as SEC_name1, SEC2.Id as SEC_Id2, SEC2.name as SEC_name2
		FROM(SELECT Id, name, option_ids FROM questions WHERE group_id=".$_GET['group_id']." && ownerEl=0 && status=1 ORDER BY position) AS Prime
		LEFT JOIN (SELECT * FROM questions WHERE group_id=".$_GET['group_id']." && ownerEl!=0 && status=1 ORDER BY position) AS SEC1 ON Prime.Id=SEC1.ownerEl
		LEFT JOIN (SELECT * FROM questions WHERE group_id=".$_GET['group_id']." && ownerEl!=0 && status=1 ORDER BY position) AS SEC2 ON SEC1.Id=SEC2.ownerEl");
	}
	function Select_Options_ByIds($Ids)
	{
		if($Ids)
			return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM answers WHERE (id=".str_replace(",", " || id=", $Ids).") ORDER BY id");
	}
	function Insert_Patient()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"INSERT INTO `patients` SET ".$_POST['ColumnsWithValues'].";");
	}
	function Insert_Feedback()
	{
		if(!$LastFeedback = mysqli_fetch_array(mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT id FROM `feedbacks_".$_POST['group_id']."` ORDER BY id DESC LIMIT 1")))
			$LastFeedback['id'] = 1;
		else
			$LastFeedback['id']++;
		$survey_id = $_SESSION['group_prefix'].'_'.str_repeat(0,10-strlen($LastFeedback['id'])).$LastFeedback['id'];
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"INSERT INTO `feedbacks_".$_POST['group_id']."` SET ".$_POST['ColumnsWithValues'].", `survey_id`='".$survey_id."';");
	}
	function Select_Groups()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM groups WHERE status=1 ORDER BY id");
	}
?>