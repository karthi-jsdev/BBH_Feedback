<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		//ini_set("display_errors","0");
		$_POST['Search'] = $_GET['Search'];
		$_POST['group_id'] = $_GET['group_id'];
		$_POST['fromdate'] = $_GET['fromdate'];
		$_POST['todate'] = $_GET['todate'];
		$_POST['displaydata'] = $_GET['displaydata'];
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['subpage'].date("d-m-Y H-i")).".xls");
	}
	if($_GET['Search'])
	{

		echo "<br/><table class='paginate sortable full'>";
		$column = $options = $lists = $answer =array();
		
		$Numberofrows = mysqli_num_rows(mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT questions.name,feedbacks_comments.question_id,feedbacks_comments.comments,feedbacks_".$_POST['group_id'].".survey_id from feedbacks_comments JOIN feedbacks_".$_POST['group_id']." on feedbacks_".$_POST['group_id'].".id = feedbacks_comments.feedback_id 
								join questions on questions.id = feedbacks_comments.question_id where questions.ownerEl='0' && questions.option_ids = ''
								"));
		echo "<tr>";
		if($Numberofrows == 0)
		{
			echo "<td align='center'><font style='color:red'>No Data Found</style></td>";
		}	
		$Comments = mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT questions.name,feedbacks_comments.question_id,feedbacks_comments.comments,feedbacks_".$_POST['group_id'].".survey_id from feedbacks_comments JOIN feedbacks_".$_POST['group_id']." on feedbacks_".$_POST['group_id'].".id = feedbacks_comments.feedback_id 
								join questions on questions.id = feedbacks_comments.question_id where questions.ownerEl='0' && questions.option_ids = ''
								");
		while($commentsdetails = mysqli_fetch_array($Comments))
		{
			echo "<tr>
			<td><font style='color:red'>".$commentsdetails['survey_id']."</style></td>
			<td colspan='4'><b>".$commentsdetails['name']."</b></td>
			<td>".$commentsdetails['comments']."</td>";
		}	
		
		echo "</tr>";	
		echo '</table>';
	}