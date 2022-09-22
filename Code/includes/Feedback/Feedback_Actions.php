<?php
	session_start();
	ini_set("display_errors", "0");
	date_default_timezone_set("Asia/Kolkata");
	include("../Config.php");
	include($_POST['Module']."_Queries.php");
	
	switch($_POST['Action'])
	{
		case "Options":
			if(!$Exists = mysqli_fetch_array(Select_Distributors_By_Name()))
			{
				Insert_Distributors();
				echo "Inserted successfully$";
				$Count_Distributors = mysqli_fetch_array(Count_Distributors());
				echo $Count_Distributors['total']."$";
				if(!$Count_Distributors['total'])
					echo '<tr><td colspan="3"><font color="red"><center>No data found</center></font></td></tr>';
				$Limit = 10;
				$_POST['total_pages'] = ceil($Count_Distributors['total'] / $Limit);
				if(!$_POST['CurrentPageNo'])
					$_POST['CurrentPageNo'] = 1;
				$i = $Start = ($_POST['CurrentPageNo']-1)*$Limit;
				$Distributors = Select_Distributors($Start, $Limit);
				while($Distributor = mysqli_fetch_array($Distributors))
					echo '<tr id="'.$Distributor['id'].'">
						<td>'.++$i.'</td><td>'.$Distributor['name'].'</td><td><a href="#" onclick="Actions(\'Edit\', '.$Distributor['id'].');">Edit</a>&nbsp;<a href="#" onclick="Actions(\'Delete\', '.$Distributor['id'].');">Delete</a></td>
					</tr>';
				echo "$";
				include("../Ajax_Pagination.php");
			}
			else
				echo "Already exists";
		break;
		case "Insert":
			$AllParams = explode("$#", $_POST['Params']);
			$AllValues = explode("$#", $_POST['Values']);
			$_POST['ColumnsWithValues'] = '';
			for($i = 0; $i < count($AllParams); $i++)
			{
				if($i)
					$_POST['ColumnsWithValues'] .= ', ';
				$_POST['ColumnsWithValues'] .= "`".$AllParams[$i]."` = '".$AllValues[$i]."'";
			}
			
			
			if(!is_numeric($AllParams[0]))
			{
				$_POST['ColumnsWithValues'] .= ", `patient_id` = '".$_POST['patient_id']."', `date_time` = '".$_POST['date_time']."'";
				$_POST['ColumnsWithValues'] .= ", `group_id` = '".$_POST['group_id']."'";
				$_POST['ColumnsWithValues'] = str_replace("`` = '',", "", $_POST['ColumnsWithValues']);
				if($Patient_number = mysqli_fetch_array(mysqli_query("SELECT id FROM patients where patient_id = '".$_POST['patient_id']."'")))
					$_SESSION['patient_id'] = $Patient_number['id'];
				else
				{	
					Insert_Patient();
					$_SESSION['patient_id'] = mysqli_insert_id();
				}	
			}
			else
			{
				$_POST['ColumnsWithValues'] .= ", `patient_id` = '".$_SESSION['patient_id']."', `date_time` = '".$_POST['date_time']."'";
				$_POST['ColumnsWithValues'] = str_replace("`` = '',", "", $_POST['ColumnsWithValues']);
				Insert_Feedback();
				
				//Insert Comments
				$FeedBack_Id = mysqli_insert_id();
				$_POST['Comments'] = explode(".,", $_POST['Comments']);
				foreach($_POST['Comments'] AS $Comment)
				{
					mysqli_query("INSERT INTO feedbacks_comments VALUES('', '".$_POST['group_id']."', '".$FeedBack_Id."', $Comment)");
				}
				
				if($_POST['UserQsAndAnswers'])
				{
					$_POST['UserQsAndAnswers'] = explode("#$", $_POST['UserQsAndAnswers']);
					foreach($_POST['UserQsAndAnswers'] AS $UserQsAndAnswers)
						mysqli_query("INSERT INTO feedbacks_comments VALUES('', '".$_POST['group_id']."', '".$FeedBack_Id."', $UserQsAndAnswers)");
				}
			}
		break;
		case "AjaxPagination":
			$Count_Distributors = mysqli_fetch_array(Count_Distributors());
			echo $Count_Distributors['total']."$";
			if(!$Count_Distributors['total'])
				echo '<tr><td colspan="3"><font color="red"><center>No data found</center></font></td></tr>';
			$Limit = 10;
			$_POST['total_pages'] = ceil($Count_Distributors['total'] / $Limit);
			if(!$_POST['CurrentPageNo'])
				$_POST['CurrentPageNo'] = 1;
			$i = $Start = ($_POST['CurrentPageNo']-1)*$Limit;
			$Distributors = Select_Distributors($Start, $Limit);
			while($Distributor = mysqli_fetch_array($Distributors))
				echo '<tr id="'.$Distributor['id'].'">
					<td>'.++$i.'</td><td>'.$Distributor['name'].'</td><td><a href="#" onclick="Actions(\'Edit\', '.$Distributor['id'].');">Edit</a>&nbsp;<a href="#" onclick="Actions(\'Delete\', '.$Distributor['id'].');">Delete</a></td>
				</tr>';
			echo "$";
			include("../Ajax_Pagination.php");
		break;
		case "Update":
			if(!$Exists = mysqli_fetch_array(Select_Distributors_By_UpdateName()))
			{
				if(Update_Distributors_By_Id())
					echo "Updated successfully$$";
			}
			else
				echo "Already exists";
		break;
		case "Delete":
			if(Delete_Distributors_By_Id())
				echo "Deleted successfully";
		break;
	}
?>