<?php
	//Master : User
	function UserRoles_Select_All()
	{
		return mysql_query("SELECT * FROM user_role WHERE id!='1' ORDER BY id DESC");
	}
	function UserRole_Select_ById($Id)
	{
		return mysql_query("SELECT * FROM user_role WHERE id='".$Id."'");
	}
	function User_Select_All()
	{
		return mysql_query("SELECT * FROM user WHERE user_role_id!='1' ORDER BY id DESC");
	}
	function User_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) as total FROM user WHERE user_role_id!='1' ORDER BY id DESC");
	}
	function User_Select_ById()
	{
		return mysql_query("SELECT * FROM user WHERE id='".$_GET['id']."'");
	}
	function User_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM user WHERE user_name='".$_POST['name']."' && password='".$_POST['password']."'");
	}
	function User_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM user WHERE user_name='".$_POST['name']."' && password='".$_POST['password']."' && id!='".$_POST['id']."'");
	}
	function User_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM user WHERE id='".$Id."'");
	}
	function User_Insert()
	{
		return mysql_query("INSERT INTO user VALUES(NULL,'".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['phone']."','".$_POST['name']."', '".$_POST['password']."', '".$_POST['userrole_id']."')");
	}
	function User_Update()
	{
		return mysql_query("UPDATE user SET user_name='".$_POST['name']."', password='".$_POST['password']."', first_name='".$_POST['firstname']."', last_name='".$_POST['lastname']."',phone_number='".$_POST['phone']."', user_role_id='".$_POST['userrole_id']."' WHERE id='".$_POST['id']."'");
	}
	function User_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM user WHERE user_role_id!='1' ORDER BY id DESC LIMIT $Start, $Limit");
	}
	
	//Master : Answer Options
	function Answer_Select_ById()
	{
		return mysql_query("SELECT * FROM answers WHERE id='".$_GET['id']."'");
	}
	function Answer_Select_ByNamePWD()
	{
		return mysql_query("SELECT * FROM answers WHERE answer='".$_POST['answer']."'");
	}
	function Answer_Select_ByNamePWDId()
	{
		return mysql_query("SELECT * FROM answers WHERE answer='".$_POST['answer']."'  && id!='".$_POST['id']."'");
	}
	function Answer_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM answers WHERE id='".$Id."'");
	}
	function Answer_Insert()
	{
		return mysql_query("INSERT INTO answers VALUES(NULL,'".$_POST['answer']."','".$_POST['status']."','#".$_POST['color']."','".$_POST['rating']."')");
	}
	function Answer_Update()
	{
		return mysql_query("UPDATE answers SET answer='".$_POST['answer']."', status='".$_POST['status']."', color='#".$_POST['color']."',rating='".$_POST['rating']."'  WHERE id='".$_POST['id']."'");
	}
	function Answer_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM answers ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Answer_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) AS total FROM answers");
	}
	function Update_Question_ById()
	{
		return mysql_query("UPDATE questions SET option_ids='".$_GET['Option_Ids']."' WHERE id=".$_GET['Question_Id']);
	}
	function Selected_Option_ById()
	{
		return mysql_query("SELECT option_ids FROM questions WHERE id='".$_GET['Question_Id']."'");
	}
	
	//Master : Group
	function Group_Select_ById()
	{
		return mysql_query("SELECT * FROM groups WHERE id='".$_GET['id']."'");
	}
	function Group_Select_ByName()
	{
		return mysql_query("SELECT * FROM groups WHERE name='".$_POST['name']."'");
	}
	function Group_Select_ByNameId()
	{
		return mysql_query("SELECT * FROM groups WHERE name='".$_POST['name']."' && id!='".$_POST['id']."'");
	}
	 function Group_Select_ByFeedbackId()
	{
		return mysql_query("SELECT survey_id FROM feedbacks_".$_SESSION['group_id']." WHERE survey_id like %".$_SESSION['group_prefix']."%");
	} 
	function Group_Delete_ById($Id)
	{
		return mysql_query("DELETE FROM groups WHERE id='".$Id."'");
	}
	function Group_Insert()
	{
		mysql_query("INSERT INTO groups VALUES(NULL,'".$_POST['name']."','".$_POST['prefix']."','".$_POST['status']."')");
		mysql_query("CREATE TABLE feedbacks_".mysql_insert_id()." LIKE feedbacks;");
	}
	function Group_Update()
	{
		return mysql_query("UPDATE groups SET name='".$_POST['name']."' , prefix = '".$_POST['prefix']."', status='".$_POST['status']."'WHERE id='".$_POST['id']."'");
	}
	function Group_Select_ByLimit($Start, $Limit)
	{
		return mysql_query("SELECT * FROM groups ORDER BY id DESC LIMIT $Start, $Limit");
	}
	function Group_Select_Count_All()
	{
		return mysql_query("SELECT COUNT(*) AS total FROM groups");
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
		return mysql_query("UPDATE questions SET status='$status' WHERE $Condition && group_id=".$_SESSION['group_id']."");
	}
	function Check_Parent_Status()
	{
		return mysql_query("SELECT id,status,ownerEl FROM questions WHERE ownerEl = (SELECT ownerEl FROM questions WHERE id=".$_GET['Ids'].") && group_id=".$_SESSION['group_id']."");
	}
	function Check_Parent($Id)
	{
		if($_GET['Flag'] == 'true')
			$status = 1;
		else
			$status = 0;
		return mysql_query("UPDATE questions SET status='$status' WHERE id = $Id && slave='0' && group_id=".$_SESSION['group_id']."");
	}
?>