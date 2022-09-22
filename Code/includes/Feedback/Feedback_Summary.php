<?php
	include("includes/Config.php");
	include("includes/Reviews_Queries.php");
	$_GET['patient_id'] = $_SESSION['patient_id'];
	?>
<div class="columns" style='width:1004px;'>
	<form method="post" class="form panel">
		<div>
			<fieldset>
				<div class="clearfix">
						<?php 	
					$info = Patient_Info_Summary();
					$patientinfo = mysqli_fetch_assoc($info);
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
								<td><b>Visit Date - </b>".$patientinfo['visit_date_time']."<td>
							</tr>
						</table><br/>";
					$Answers = Array();
					$AnswerQuery = mysqli_query("SELECT * FROM answers");
					while($Answer = mysqli_fetch_array($AnswerQuery))
						$Answers[$Answer['id']] = $Answer['answer'];
					$Questions = Array();
					$QuestionsQuery = mysqli_query("SELECT Id, name,ownerEl FROM questions WHERE group_id=$_GET[group_id] and status='1' ORDER BY Id");
					while($Question = mysqli_fetch_array($QuestionsQuery))
					{
						$Questions['id'][] = $Question['Id'];
						$Questions['question'][] = $Question['name'];
						$Questions['ownerEl'][] = $Question['ownerEl'];
					}
					$FeedbacksQuery = mysqli_query("SELECT * FROM feedbacks_$_GET[group_id] WHERE feedbacks_$_GET[group_id].patient_id=$_GET[patient_id] ORDER BY feedbacks_$_GET[group_id].id DESC LIMIT 1");
					echo "<span style='color:red;font-size:14px;'><center><strong>Patient FeedBack Details</strong></center></span>
						<table class='paginate sortable full'>";
					while($Feedback = mysqli_fetch_array($FeedbacksQuery))
					{
						$j=1;
						for($i = 0; $i < COUNT($Questions['id']); $i++)
						{
							echo '<tr>';
							//$option_id = mysqli_fetch_array(mysqli_query("SELECT option_ids,ownerEl FROM questions WHERE questions.id=".$Questions['id'][$i].""));
							$Comments = mysqli_fetch_array(mysqli_query("SELECT comments FROM feedbacks_comments WHERE question_id=".$Questions['id'][$i]." and feedbacks_comments.feedback_id = ".$Feedback['id']." "));
							$Comment_total = mysqli_fetch_array(mysqli_query("SELECT count(*) as total FROM feedbacks_comments WHERE question_id=".$Questions['id'][$i]." and feedbacks_comments.feedback_id = ".$Feedback['id']." "));
							if($Questions['ownerEl'][$i] == 0)
							{
								if($Comment_total['total']>=1)
									echo "<td colspan='4' style='font-size:14px;font-weight:bold;'>".$j++.'.&nbsp;'.$Questions['question'][$i]."</td><td colspan='4'>".$Answers[$Feedback[$Questions['id'][$i]]]."</td></tr><tr><td colspan='4'>".$Comments['comments']."</td></tr>";
								else
								{
									echo "<td style='font-size:14px;font-weight:bold;' colspan='7'>".$j++.'.&nbsp;'.$Questions['question'][$i]."</td><td>".$Answers[$Feedback[$Questions['id'][$i]]]."</td>";
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
						
						/* $Answers = Array();
							$AnswerQuery = mysqli_query("SELECT * FROM answers");
							while($Answer = mysqli_fetch_array($AnswerQuery))
								$Answers[$Answer['id']] = $Answer['answer'];
							$Questions = Array();
							$QuestionsQuery = mysqli_query("SELECT Id, name,ownerEl FROM questions WHERE group_id=$_GET[group_id] and status='1' ORDER BY Id");
							while($Question = mysqli_fetch_array($QuestionsQuery))
							{
								$Questions['id'][] = $Question['Id'];
								$Questions['question'][] = $Question['name'];
								$Questions['ownerEl'][] = $Question['ownerEl'];
							}
							
							$FeedbacksQuery = mysqli_query("SELECT * FROM feedbacks_$_GET[group_id] WHERE feedbacks_$_GET[group_id].patient_id=$_GET[patient_id] ORDER BY feedbacks_$_GET[group_id].id DESC LIMIT 1");
							while($Feedback = mysqli_fetch_array($FeedbacksQuery))
							{
								for($i = 0; $i < COUNT($Questions['id']); $i++)
								{
									$Comments = mysqli_fetch_array(mysqli_query("SELECT comments FROM feedbacks_comments WHERE question_id=".$Questions['id'][$i]." ORDER BY id DESC LIMIT 1"));
									if($Questions['ownerEl'][$i] == 0)
										echo "<b>".$Questions['question'][$i]."</b> : ".$Answers[$Feedback[$Questions['id'][$i]]]."&nbsp;&nbsp;&nbsp;&nbsp;Comments : ".$Comments['comments']."<br />";
									else	
										echo $Questions['question'][$i]." : ".$Answers[$Feedback[$Questions['id'][$i]]]."&nbsp;&nbsp;&nbsp;&nbsp;Comments : ".$Comments['comments']."<br />";
								}	
							} */
					}
						?>
					</table>	
				</div>
			</fieldset>
		</div>
		<br />
		<div align='center'>
			<a href="#" id="Previous" class="button button-green" onclick="Actions()" >Submit</a>&nbsp;&nbsp;
		</div>
	</form>
</div>	
<script>
	function Actions()
	{
		alert("Submitted successfully. Thank you.");
		window.location.assign("index.php?page=Feedback");
	}
</script>