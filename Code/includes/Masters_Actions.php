<?php
	session_start();
	ini_set("display_errors", "0");
	include("Config.php");
	include("Masters_Queries.php");
	switch($_GET['Action'])
	{
		case "Update_Question":
			if(Update_Question_ById())
				echo "Updated successfully";
			else
				echo "Updation failed";
		break;		
		case "Select_Answer_Ids":	
			$Answers =  mysqli_fetch_array(mysqli_query("SELECT option_ids FROM questions WHERE id='".$_GET['Question_Id']."'")); 
			$Answers['option_ids'] = explode(",", $Answers['option_ids']);
			$AllAnswers =  mysqli_query("SELECT * FROM answers"); 
			while($Select_Option = mysqli_fetch_array($AllAnswers))
			{
				if(in_array($Select_Option['id'], $Answers['option_ids']))
					echo "<input type='checkbox' id='".$Answers_Option['id']."' name='Option_Ids[]' value='".$Select_Option['id']."' checked>".$Select_Option['answer']."<br />";
				else
					echo "<input type='checkbox' id='".$Answers_Option['id']."' name='Option_Ids[]' value='".$Select_Option['id']."'>".$Select_Option['answer']."<br />";
			}
		break;
		case "Update_Questions_Status":
			$Update_Questions_Status = mysqli_fetch_array(Update_Questions_Status());
			$CheckedCount = $UncheckedCount = $Count = 0;
			$Parent_Id="";
			$Parents_Status = Check_Parent_Status();
			while($Parent_Status = mysqli_fetch_assoc($Parents_Status))
			{
				$Count++;
				$Parent_Id=$Parent_Status['ownerEl'];
				if($Parent_Status['status'] == 1)
					$CheckedCount++;
				else
					$UncheckedCount++;
			}
			echo $Parent_Id;
			if($Count == $CheckedCount)
			{
				$Check_Parent = mysqli_fetch_array(Check_Parent($Parent_Id));
				echo "##1";
				
			}
			elseif($Count == $UncheckedCount)
			{
				$Check_Parent = mysqli_fetch_array(Check_Parent($Parent_Id));
				echo "##0";
			}
		break;
		case "Update_Questions_Status1":
			$Update_Questions_Status = mysqli_fetch_array(Update_Questions_Status());
			echo $Update_Questions_Status['Checked_Ids'];
		break;	
	}
?>