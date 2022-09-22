<?php
	function Select_Groups()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM groups WHERE status=1 ORDER BY id");
	}
	function Patient_Info_Summary()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT feedbacks_".$_GET['group_id'].".id,patients.name as pname,patients.patient_id,survey_id,groups.name,patients.email,
						patients.contact,patients.private_or_general,patients.service_available_department,patients.visit_date_time
						FROM  groups
						join patients on groups.id=patients.group_id 
						join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
						WHERE feedbacks_".$_GET['group_id'].".patient_id=".$_GET['patient_id']." order by id desc LIMIT 1");
	}
	function Patient_Info()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT feedbacks_".$_GET['group_id'].".id,patients.name as pname,patients.patient_id,survey_id,groups.name,patients.email,
							patients.contact,patients.private_or_general,patients.service_available_department,patients.visit_date_time
							FROM  groups
							join patients on groups.id=patients.group_id 
							join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
							WHERE feedbacks_".$_GET['group_id'].".patient_id=".$_GET['patient_id']."");
	}
	function Patient_FeedbackCount()
	{
		/* return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT Count(feedbacks_".$_GET['group_id'].".id)As total FROM feedback_reviews 
								join groups on feedback_reviews.groups_id = groups.id
								join patients on groups.id=patients.group_id 
								join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
								WHERE patients.group_id='".$_GET['group_id']."'"); */
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT Count(feedbacks_".$_GET['group_id'].".id)As total FROM groups
								join patients on groups.id=patients.group_id 
								join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
							");
	}
	function Patient_Feedbacklist($Start,$Limit)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT patients.name,patients.patient_id,groups.prefix,patients.id as pid,feedbacks_".$_GET['group_id'].".survey_id,feedbacks_".$_GET['group_id'].".id as id
							FROM groups
							join patients on groups.id=patients.group_id 
							join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
							LIMIT $Start,$Limit");
	}
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
	function QAList()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT column_name FROM information_schema.columns WHERE table_name = feedbacks_".$_GET['group_id']."");
	}
	function Patient_FeedbackNotReviewedCount()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT COUNT(*) as total
							FROM  groups
							join patients on groups.id=patients.group_id 
							join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
							WHERE feedbacks_".$_GET['group_id'].".patient_id NOT IN (SELECT patient_id from feedback_reviews WHERE feedback_reviews.groups_id='".$_GET['group_id']."')");
	}
	function Patient_FeedbackNotReviewed($Start,$Limit)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT feedbacks_".$_GET['group_id'].".id as id,patients.id as pid,patients.name,patients.patient_id,groups.prefix,feedbacks_".$_GET['group_id'].".survey_id
							FROM  groups
							join patients on groups.id=patients.group_id 
							join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
							WHERE feedbacks_".$_GET['group_id'].".patient_id NOT IN (SELECT patient_id from feedback_reviews WHERE feedback_reviews.groups_id='".$_GET['group_id']."') LIMIT $Start,$Limit");
	}
	function Patient_FeedbackReviewedCount()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT COUNT(*) as total
							FROM  groups
							join patients on groups.id=patients.group_id 
							join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
							WHERE feedbacks_".$_GET['group_id'].".patient_id IN (SELECT patient_id from feedback_reviews WHERE feedback_reviews.groups_id='".$_GET['group_id']."')");
	}
	function Patient_FeedbackReviewed($Start,$Limit)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT feedbacks_".$_GET['group_id'].".id,patients.name,patients.id as pid,patients.patient_id,groups.prefix,feedbacks_".$_GET['group_id'].".survey_id
							FROM  groups
							join patients on groups.id=patients.group_id 
							join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
							WHERE feedbacks_".$_GET['group_id'].".patient_id IN (SELECT patient_id from feedback_reviews WHERE feedback_reviews.groups_id='".$_GET['group_id']."')LIMIT $Start,$Limit");
	}
	function Patient_FeedbackStatus()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT feedbacks_".$_GET['group_id'].".id,patients.name,patients.patient_id,review_msg,ticket_id,review,ticket_msg,ticket_no,feedbacks_".$_GET['group_id'].".survey_id
							FROM  groups
							join patients on groups.id=patients.group_id 
							join feedbacks_".$_GET['group_id']." on feedbacks_".$_GET['group_id'].".patient_id=patients.id
							JOIN feedback_reviews on feedbacks_".$_GET['group_id'].".id=feedback_reviews.feedbackid
							WHERE feedbacks_".$_GET['group_id'].".id=".$_GET['feedbackid']." && groups.id=".$_GET['group_id']." && patients.id=".$_GET['patient_id']."");
	}
?>