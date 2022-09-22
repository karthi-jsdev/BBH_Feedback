<?php
	include("includes/Config.php");
	include("Reviews_Queries.php");
	?>
<div class="columns" style='width:1004px;'>
	<fieldset>
		<form action="" method="POST" class="form panel">
			<div class="clearfix">
			<img src="images/icons/download.png" alt="download" style="float:right;" onclick="download_Review();">
			<?php
				if(isset($_GET['patient_id']))
				{
					$info = Patient_Info();
					$patientinfo = mysql_fetch_assoc($info);
					$Patient_Status = Patient_FeedbackStatus();
					$status = mysql_Fetch_Assoc($Patient_Status);
				/* 	if($status['ticket_id']!=1)
						echo '<center><p style="color:red;"><b>Your ticket was not raised.Try Again</b></p></center>';
					else{} */
					echo "<span style='color:red;font-size:14px;'><center><strong>Patient Details</strong></center></span>
						<table class='paginate sortable full'>
							<tr>
								<td><b>Survey No. - </b>".$patientinfo['survey_id']."<td>
								<td>&nbsp;</td>
								<td><b>Patient Name - </b>".$patientinfo['pname']."<td>
								<td>&nbsp;</td>
								<td><b>Group Name - </b>".$patientinfo['name']."<td>
								<td>&nbsp;</td>
								<td><b>Patient id - </b>".$patientinfo['patient_id']."<td>
								<td>&nbsp;</td>
								<td><b>Patient Type - </b>".$patientinfo['private_or_general']."<td>
							</tr>
							<tr>
								<td><b>Telephone - </b>".$patientinfo['contact']."<td>
								<td>&nbsp;</td>
								<td><b>Email - </b>".$patientinfo['email']."<td>
								<td>&nbsp;</td>
								<td><b>Service Dept - </b>".$patientinfo['service_available_department']."<td>
								<td>&nbsp;</td>
								<td><b>Visit Date - </b>".$patientinfo['visit_date_time']."<td>";
						if($status['ticket_id']==1)
							echo '<td style="color:red;" colspan="2"><b>Your ticket number is '.$status['ticket_no'].'</b></td>';
						echo"</tr></table><br/>";
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
							//$option_id = mysql_fetch_array(mysql_query("SELECT option_ids,ownerEl FROM questions WHERE questions.id=".$Questions['id'][$i].""));
							$Comments = mysql_fetch_array(mysql_query("SELECT comments FROM feedbacks_comments WHERE question_id=".$Questions['id'][$i]." ORDER BY id DESC LIMIT 1"));
							$Comment_total = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM feedbacks_comments WHERE question_id=".$Questions['id'][$i]." ORDER BY id DESC LIMIT 1"));
							if($Questions['ownerEl'][$i] == 0)
							{
								if($Comment_total['total']>=1)
									echo "<td colspan='4' style='font-size:14px;font-weight:bold;'>".$j++.'.&nbsp;'.$Questions['question'][$i]."</td><td colspan='4'>".$Answers[$Feedback[$Questions['id'][$i]]]."</td></tr><tr><td colspan='4'>".$Comments['comments']."</td></tr>";
								else
								{
									echo "<td style='font-size:14px;font-weight:bold;' colspan='7'>".$j++.'.&nbsp;'.$Questions['question'][$i]."</td><td>".$Answers[$Feedback[$Questions['id'][$i]]]."</td>";
								//if($option_id['option_ids']!='' || $option_id['ownerEl']==0)
									echo "</tr><tr>
										<td><b>Questions</b></td>
										<td colspan='2'><b>Answers</b></td>
										<td colspan='2'><b>Comments</b></td>
									</tr><tr>";
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
					}
					echo "</table>";
					if($status['review']==1 || $_POST['Raise'] ||  $_POST['ticket'])
					{
						$list = mysql_fetch_assoc(mysql_query("SELECT count(*) as total,id FROM feedback_reviews WHERE reviewer_id='".$_GET['loginid']."' && patient_id='".$_GET['patient_id']."' && groups_id='".$_GET['group_id']."' && feedbackid='".$_GET['feedbackid']."'"));
						if($list['total']<1)
						{
							if($_POST['review_msg']=="")
								echo "<br /><div class='message error'><b>Message</b> : Please specify Some Review Information</div>";
							else
								mysql_query("INSERT INTO feedback_reviews (groups_id,patient_id,feedbackid,reviewer_id,review_msg,review,ticket_id,ticket_msg,date_time) VALUES ('".$_GET['group_id']."','".$_GET['patient_id']."','".$_GET['feedbackid']."','".$_GET['loginid']."','".$_POST['review_msg']."','1','','','".date('Y-m-d H:i:s')."')");
						}
						else
						{
							include("includes/Config_bbhm.php");
							$data = explode('#',$_POST['ticketno']);
							if($_POST['ticketno'])
							{
								$Digits = array("", "0", "00", "000", "0000", "00000", "000000", "0000000");
								$Ticket = mysql_fetch_assoc(mysql_query("Select * from complaint where ticketno like '%".$data[1]."%' ORDER BY ID DESC LIMIT 0,1"));
								$TicketNo = explode("-",$Ticket['ticketno']);
								$TicketNo = $data[1]."-".$Digits[7 - strlen($TicketNo[1]+1)].($TicketNo[1]+1);
								$date = date('Y-m-d h-i-s');
								$execute = mysql_query("INSERT INTO complaint (ticketno,description,remarks,groupid,subgroupid,sourceid,createdat,updatedat,statusid,priorityid,updatedby,assignedto,createdby,departmentid) VALUES ('".$TicketNo."','".$_POST['ticket_msg']."','".$patientinfo['survey_id']."','".$data[0]."','13','6','".$date."','".$date."','1','3','247','247','247','121')");
								$ComplaintId = mysql_fetch_assoc(mysql_query("SELECT id FROM complaint WHERE ticketno='".$TicketNo."'"));
								$audit = mysql_query("INSERT INTO audit(complaintid, comments, statusid, priorityid, addedby, addedat) VALUES('".$ComplaintId['id']."','New ticket created by Survey admin','1','3','247','".$date."')");
								//mysql_query("INSERT INTO complaint (ticketno,description,remarks,groupid,subgroupid,sourceid,createdat,updatedat,statusid,priorityid) VALUES ('".$TicketNo."','".$_POST['ticket_msg']."','".$patientinfo['survey_id']."','".$data[0]."','13','6','".$date."','".$date."','1','3')");
								if($audit==1 && $execute==1)
								{
									include("includes/Config.php");
									mysql_query("update feedback_reviews set ticket_id='1',ticket_msg='".$_POST['ticket_msg']."',ticket_no='".$TicketNo."' WHERE id='".$list['id']."'");
								}
							}
						}
						?>
					<table class="paginate sortable full">
						<tr>
						<?php
						include("includes/Config.php"); 
						if($_POST['Raise'])
							echo'<td><b>Review status</b><br/><textarea disabled="disabled" name="review_msg" placeholder="Enter your comments" rows="2" cols="25">'.$_POST['review_msg'].'</textarea></td>';
						else
							echo'<td><b>Review status</b><br/><textarea disabled="disabled" name="review_msg" placeholder="Enter your comments" rows="2" cols="25">'.$status['review_msg'].'</textarea></td>';
						echo'<td><br/><br/><input type="submit" value="REVIEWED" disabled></td>';
						if(($execute!=1 || $audit!=1) && $_POST['ticket'])
						{
							echo '<td style="color:red;"><b>Your ticket was not raised.Try Again</b></td>';
							include("includes/Config_bbhm.php");
							$groups = mysql_query("SELECT * FROM `group` ORDER BY id DESC");
							echo'<td><br/><b>Survey Category</b><br/>
								<select id="ticketno" name="ticketno">';
								while($group = mysql_fetch_assoc($groups))
								{
									echo'<option value="'.$group['id'].'#'.$group['name'].'">'.$group['name'].'</option>';
								}
							echo '</select>';
							echo'<td><b>Reason for Ticket</b><br/><textarea id="ticket_msg" name="ticket_msg" placeholder="Enter your comments" rows="2" cols="25"></textarea></td>
							<td><br/><br/><input class="button button-blue" type="submit" name="ticket" id="ticket" value="RAISE TICKET" onclick="return raise_Ticket();"></td>';
						}
						if($status['ticket_id']==1 || $_POST['ticket'] )
						{
							if($_POST['ticket'] && $execute==1 && $audit==1)
							{
								echo'<td style="color:red;"><br/><br/>Your ticket number is '.$TicketNo.'</td>';
								echo'<td><b>Reason for Ticket</b><br/><textarea name="ticket_msg" placeholder="Enter your comments" rows="2" cols="25" disabled="disabled">'.$_POST['ticket_msg'].'</textarea></td>';
								echo'<td><br/><br/><input type="submit" value="TICKET RAISED" disabled></td>';
							}
							else if($execute==1 && $audit==1)
							{
								echo'<td style="color:red;"><br/><br/>Your ticket number is '.$status['ticket_no'].'</td>';
								echo'<td><b>Reason for Ticket</b><br/><textarea name="ticket_msg" placeholder="Enter your comments" rows="2" cols="25" disabled="disabled">'.$status['ticket_msg'].'</textarea></td>';
								echo'<td><br/><br/><input type="submit" value="TICKET RAISED" disabled></td>';
							}
							else if($status['ticket_id']==1)
							{
								echo'<td style="color:red;"><br/><br/>Your ticket number is '.$status['ticket_no'].'</td>';
								echo'<td><b>Reason for Ticket</b><br/><textarea name="ticket_msg" placeholder="Enter your comments" rows="2" cols="25" disabled="disabled">'.$status['ticket_msg'].'</textarea></td>';
								echo'<td><br/><br/><input type="submit" value="TICKET RAISED" disabled></td>';
							}
						}
						else
						{
							include("includes/Config_bbhm.php");
							$groups = mysql_query("SELECT * FROM `group` ORDER BY id DESC");
							echo'<td><br/><b>Survey Category</b><br/>
								<select id="ticketno" name="ticketno">';
								while($group = mysql_fetch_assoc($groups))
								{
									echo'<option value="'.$group['id'].'#'.$group['name'].'">'.$group['name'].'</option>';
								}
							echo '</select>';
							echo'<td><b>Reason for Ticket</b><br/><textarea id="ticket_msg" name="ticket_msg" placeholder="Enter your comments" rows="2" cols="25"></textarea></td>
							<td><br/><br/><input class="button button-blue" type="submit" name="ticket" id="ticket" value="RAISE TICKET" onclick="return raise_Ticket();"></td>';
						}
					}
					else
					{
						echo'<td><b>Review status</b><br/>&nbsp;&nbsp;<textarea id="review_msg" name="review_msg" placeholder="Enter your comments" rows="2" cols="25"></textarea></td>';
						echo'<td><br/>&nbsp;&nbsp;<input class="button button-blue" type="submit" name="Raise" id="Raise" value="REVIEW" onclick="return review();"></td>';
					}
					?>
						</tr>
					</table>
					<a href="index.php?page=Reviews&group_id=<?php echo $_GET['group_id'];?>" class="button button-blue">BACK</a>
					<?php
				}
				?>	
			</div>
		</form>
	</fieldset>
</div>
<script>
	function review()
	{
		if(document.getElementById("review_msg").value==''||document.getElementById("review_msg").value==null)
		{
			alert("Please Specify Some Review Information");
			return false;
		}
	}
	function raise_Ticket()
	{
		if(document.getElementById("ticket_msg").value==''||document.getElementById("ticket_msg").value==null)
		{
			alert("Please Specify Reson For Raising a ticket");
			return false;
		}
	}
	function download_Review()
	{
		window.open("includes/Feedback_download.php?group_id=<?php echo $_GET['group_id'];?>&patient_id=<?php echo $_GET['patient_id'];?>&ticket=<?php echo $status['ticket_no'];?>");
	}
</script>