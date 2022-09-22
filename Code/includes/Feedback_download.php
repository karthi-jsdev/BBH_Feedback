<?php
	include("Config.php");
	ini_set('default_errors',1);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header("Content-Disposition: attachment; filename=FeedBack.XLS");
	include("Reviews_Queries.php");
	if($_GET['ticket']!='')
		echo'<span style="color:red;"><b>Your ticket number is '.$_GET['ticket'].'</b></span>';
	$info = Patient_Info();
	$patientinfo = mysql_fetch_assoc($info);
	echo "<span style='color:red;font-size:14px;'><center><strong>Patient Details</strong></center></span>
		<table class='paginate sortable full'>
			<tr>
				<td><b>Survey No. - </b>".$patientinfo['survey_id']."<td>
				<td><b>Patient Name - </b>".$patientinfo['pname']."<td>
				<td><b>Group Name - </b>".$patientinfo['name']."<td>
				<td><b>Patient id - </b>".$patientinfo['patient_id']."<td>
				<td><b>Patient Type - </b>".$patientinfo['private_or_general']."<td>
			</tr>
			<tr>
				<td><b>Telephone - </b>".$patientinfo['contact']."<td>
				<td><b>Email - </b>".$patientinfo['email']."<td>
				<td><b>Service Dept - </b>".$patientinfo['service_available_department']."<td>
				<td><b>Visit Date - </b>".$patientinfo['visit_date_time']."<td>
			</tr>
		</table>";
	$Answers = Array();
	$AnswerQuery = mysql_query("SELECT * FROM answers");
	while($Answer = mysql_fetch_array($AnswerQuery))
		$Answers[$Answer['id']] = '<span style="color:'.$Answer['color'].'">'.$Answer['answer'].'</span>';
	$Questions = Array();
	$QuestionsQuery = mysql_query("SELECT Id, name,ownerEl FROM questions WHERE group_id=$_GET[group_id] and status='1' ORDER BY Id");
	while($Question = mysql_fetch_array($QuestionsQuery))
	{
		$Questions['id'][] = $Question['Id'];
		$Questions['question'][] = $Question['name'];
		$Questions['ownerEl'][] = $Question['ownerEl'];
	}
	$FeedbacksQuery = mysql_query("SELECT * FROM feedbacks_$_GET[group_id] WHERE feedbacks_$_GET[group_id].patient_id=$_GET[patient_id] ORDER BY feedbacks_$_GET[group_id].id DESC LIMIT 1");
	echo "<span style='color:red;font-size:14px;'><center><strong>Patient FeedBack Details</strong></center></span>
		<table class='paginate sortable full'>";
	while($Feedback = mysql_fetch_array($FeedbacksQuery))
	{
		$j=1;
		for($i = 0; $i < COUNT($Questions['id']); $i++)
		{
			echo '<tr>';
			$Comments = mysql_fetch_array(mysql_query("SELECT comments FROM feedbacks_comments WHERE question_id=".$Questions['id'][$i]." ORDER BY id DESC LIMIT 1"));
			$Comment_total = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM feedbacks_comments WHERE question_id=".$Questions['id'][$i]." ORDER BY id DESC LIMIT 1"));
			if($Questions['ownerEl'][$i] == 0)
			{
				if($Comment_total['total']>=1)
					echo "<td colspan='4' style='font-size:14px;font-weight:bold;'>".$j++.'.&nbsp;'.$Questions['question'][$i]."</td><td colspan='4'>".$Answers[$Feedback[$Questions['id'][$i]]]."</td></tr><tr><td colspan='4'>".$Comments['comments']."</td></tr>";
				else
				{
					echo "<td style='font-size:14px;font-weight:bold;' colspan='7'>".$j++.'.&nbsp;'.$Questions['question'][$i]."</td><td>".$Answers[$Feedback[$Questions['id'][$i]]]."</td>";
					echo "</tr><tr>
						<td colspan='2'><b>Questions</b></td>
						<td><b>Answers</b></td>
						<td colspan='2'><b>Comments</b></td>
					";
				}
			}
			else
			{
				if($Comment_total['total']>=1)
					echo "<td colspan='2'>".$Questions['question'][$i]." </td><td>".$Answers[$Feedback[$Questions['id'][$i]]]."</td><td>".$Comments['comments']."</td>";
				else
					echo "<td colspan='2'>".$Questions['question'][$i]."</td><td>".$Answers[$Feedback[$Questions['id'][$i]]]."</td>";
			}
			echo '</tr>';							
		}
		echo '<tr><td> </td></tr>';							
	}
	echo "</table>";
?>