<?php
	//Master : User
	function UserRoles_Select_All()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],$_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM user_role WHERE id!='1' ORDER BY id DESC");
	}
	function UserRole_Select_ById($Id)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM user_role WHERE id='".$Id."'");
	}
	function User_Select_All()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM user WHERE user_role_id!='1' ORDER BY id DESC");
	}
	function User_Select_Count_All()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT COUNT(*) as total FROM user WHERE user_role_id!='1' ORDER BY id DESC");
	}
	function User_Select_ById()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM user WHERE id='".$_GET['id']."'");
	}
	function User_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM user WHERE user_name='".$_POST['name']."' && password='".$_POST['password']."'");
	}
	function User_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM user WHERE user_name='".$_POST['name']."' && password='".$_POST['password']."' && id!='".$_POST['id']."'");
	}
	function User_Delete_ById($Id)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"DELETE FROM user WHERE id='".$Id."'");
	}
	function User_Insert()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"INSERT INTO user VALUES(NULL,'".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['phone']."','".$_POST['name']."', '".$_POST['password']."', '".$_POST['userrole_id']."')");
	}
	function User_Update()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"UPDATE user SET user_name='".$_POST['name']."', password='".$_POST['password']."', first_name='".$_POST['firstname']."', last_name='".$_POST['lastname']."',phone_number='".$_POST['phone']."', user_role_id='".$_POST['userrole_id']."' WHERE id='".$_POST['id']."'");
	}
	function User_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM user WHERE user_role_id!='1' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Answer Options
	function Answer_Select_ById()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM answers WHERE id='".$_GET['id']."'");
	}
	function Answer_Select_ByNamePWD()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM answers WHERE answer='".$_POST['answer']."'");
	}
	function Answer_Select_ByNamePWDId()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM answers WHERE answer='".$_POST['answer']."'  && id!='".$_POST['id']."'");
	}
	function Answer_Delete_ById($Id)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"DELETE FROM answers WHERE id='".$Id."'");
	}
	function Answer_Insert()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"INSERT INTO answers VALUES(NULL,'".$_POST['answer']."','".$_POST['status']."','#".$_POST['color']."','".$_POST['rating']."')");
	}
	function Answer_Update()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"UPDATE answers SET answer='".$_POST['answer']."', status='".$_POST['status']."', color='#".$_POST['color']."',rating='".$_POST['rating']."'  WHERE id='".$_POST['id']."'");
	}
	function Answer_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM answers ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Answer_Select_Count_All()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT COUNT(*) AS total FROM answers");
	}
	function Update_Question_ById()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"UPDATE questions SET option_ids='".$_GET['Option_Ids']."' WHERE id=".$_GET['Question_Id']);
	}
	function Selected_Option_ById()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT option_ids FROM questions WHERE id='".$_GET['Question_Id']."'");
	}
	
	//Master : Group
	function Group_Select_ById()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM groups WHERE id='".$_GET['id']."'");
	}
	function Group_Select_ByName()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM groups WHERE name='".$_POST['name']."'");
	}
	function Group_Select_ByNameId()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM groups WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	 function Group_Select_ByFeedbackId()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT survey_id FROM feedbacks_".$_SESSION['group_id']." WHERE survey_id like %".$_SESSION['group_prefix']."%");
	} 
	function Group_Delete_ById($Id)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"DELETE FROM groups WHERE id='".$Id."'");
	}
	function Group_Insert()
	{
		mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"INSERT INTO groups VALUES(NULL,'".$_POST['name']."','".$_POST['prefix']."','".$_POST['status']."')");
		mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"CREATE TABLE feedbacks_".mysqli_insert_id()." LIKE feedbacks;");
	}
	function Group_Update()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"UPDATE groups SET name='".$_POST['name']."' , prefix = '".$_POST['prefix']."', status='".$_POST['status']."'WHERE id='".$_POST['id']."'");
	}
	function Group_Select_ByLimit($Start, $Limit)
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM groups ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Group_Select_Count_All()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT COUNT(*) AS total FROM groups");
	}
	
	//Master : Questions_Status
	function Update_Questions_Status()
	{
		if($_GET['Flag'] == 'true')
			$status = 1;
		else
			$status = 0;
		$Id = explode(",", $_GET['Ids']);
		foreach($Id AS $id)
		{
			if(!$Condition)
				$Condition = "id=".$id;
			else
				$Condition .= " || id=".$id;
		}
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"UPDATE questions SET status='$status' WHERE $Condition && group_id=".$_SESSION['group_id']."");
	}
	function Check_Parent_Status()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT id,status,ownerEl FROM questions WHERE ownerEl = (SELECT ownerEl FROM questions WHERE id=".$_GET['Ids'].") && group_id=".$_SESSION['group_id']."");
	}
	function Check_Parent($Id)
	{
		if($_GET['Flag'] == 'true')
			$status = 1;
		else
			$status = 0;
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"UPDATE questions SET status='$status' WHERE id = $Id && slave='0' && group_id=".$_SESSION['group_id']."");
	}
?>