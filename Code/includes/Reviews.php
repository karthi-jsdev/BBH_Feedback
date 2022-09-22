<section role="main" id="main">
	<?php include("includes/Reviews_Queries.php"); ?>
	<body>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="" id="form" class="form panel">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION[$_SESSION['Prefix'].'id']; ?>" required="required"/>
			<header><h2>Select a Category</h2></header>
			<hr />				
			<fieldset>
				<label>Survey Category<font color="red">*</font></label>&nbsp;&nbsp;
				<select onChange="window.document.location.href='<?php echo 'index.php?page='.$_GET['page'].'&group_id='; ?>'+this.options[this.selectedIndex].value;">
					<option value="">Select</option>
					<?php
					$Groups = Select_Groups();
					while($Group = mysql_fetch_array($Groups))
					{
						if($Group['id'] == $_GET['group_id'])
							echo '<option value="'.$Group['id'].'" selected>'.$Group['name'].'</option>';
						else
							echo '<option value="'.$Group['id'].'">'.$Group['name'].'</option>';
					} ?>
				</select>
			</fieldset>
		</form>
<?php
	if($_GET['status'] || $_GET['group_id'])
	{
		$Rtotal = mysql_Fetch_assoc(Patient_FeedbackReviewedCount());
		$NRtotal = mysql_Fetch_assoc(Patient_FeedbackNotReviewedCount());
		$total = mysql_Fetch_assoc(Patient_FeedbackCount());
		if($total['total']==0)
			{}
		else
		{
			if($_GET['status']=='All')
				echo'
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=All" style="font-weight:Bold;font-size:14px;">All('.$total['total'].')</a>&nbsp;&nbsp;
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=Reviewed" >Reviewed('.$Rtotal['total'].')</a>&nbsp;&nbsp;
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=NotReviewed" >Not Reviewed('.$NRtotal['total'].')</a>';
			else if($_GET['status']=='Reviewed')
				echo'
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=All">All('.$total['total'].')</a>&nbsp;&nbsp;
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=Reviewed" style="font-weight:Bold;font-size:14px;">Reviewed('.$Rtotal['total'].')</a>&nbsp;&nbsp;
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=NotReviewed" >Not Reviewed('.$NRtotal['total'].')</a>';
			else if($_GET['status']=='NotReviewed')
				echo'
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=All">All('.$total['total'].')</a>&nbsp;&nbsp;
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=Reviewed" >Reviewed('.$Rtotal['total'].')</a>&nbsp;&nbsp;
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=NotReviewed" style="font-weight:Bold;font-size:14px;">Not Reviewed('.$NRtotal['total'].')</a>';
			else
				echo'
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=All">All('.$total['total'].')</a>&nbsp;&nbsp;
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=Reviewed" >Reviewed('.$Rtotal['total'].')</a>&nbsp;&nbsp;
				<a href="index.php?page='.$_GET['page'].'&group_id='.$_GET['group_id'].'&status=NotReviewed" >Not Reviewed('.$NRtotal['total'].')</a>';
		}
		if($_GET['status']=='All')
			$total = mysql_Fetch_assoc(Patient_FeedbackCount());
		else if($_GET['status']=='Reviewed')
			$total = mysql_Fetch_assoc(Patient_FeedbackReviewedCount());
		else if($_GET['status']=='NotReviewed')
			$total = mysql_Fetch_assoc(Patient_FeedbackNotReviewedCount());
		else
			$total = mysql_Fetch_assoc(Patient_FeedbackCount());
		echo'<table class="paginate sortable full">
			<tr>
				<th>Slno</th>
				<th>Survey No.</th>
				<th>Patient Admission no./Name</th>
				<th>Review Status</th>
				<th>Ticket Status</th>
				<th>Ticket No.</th>
				<th>Reviewed DateTime</th>
			</tr>';
		if($total['total']==0)
			echo '<tr><td colspan="6" style="color:#F00"><center>No Reviews Found!</center></td></tr>';
		else
		{
			$i = 1;
			$Limit = 10;
			$total_pages = ceil($total['total'] / $Limit);
			if(!$_GET['pageno'])
				$_GET['pageno'] = 1;
			$i = $Start = ($_GET['pageno']-1)*$Limit;
			$i++;
			$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");		
	
			if($_GET['status']=='All')
				$feedback = Patient_Feedbacklist($Start,$Limit);
			else if($_GET['status']=='Reviewed')
				$feedback = Patient_FeedbackReviewed($Start,$Limit);
			else if($_GET['status']=='NotReviewed')
				$feedback = Patient_FeedbackNotReviewed($Start,$Limit);
			else
				$feedback = Patient_Feedbacklist($Start,$Limit);
			while($feedbackist = mysql_fetch_Assoc($feedback))
			{
				$status = mysql_Fetch_Assoc(mysql_query("SELECT ticket_no,review_msg,ticket_msg,date_time,feedback_reviews.review,ticket_id from feedback_reviews where patient_id='".$feedbackist['pid']."' && groups_id='".$_GET['group_id']."' && feedbackid='".$feedbackist['id']."'"));
				echo'<tr>
						<td>'.$i++.'</td>
						<td>'.$feedbackist['survey_id'].'</td>
						<td><a href="index.php?page=Patient_Review&group_id='.$_GET['group_id'].'&loginid='.$_SESSION[$_SESSION['Prefix'].'id'].'&patient_id='.$feedbackist['pid'].'&feedbackid='.$feedbackist['id'].'" style="color:#0066ff;">'.$feedbackist['patient_id'].' / '.$feedbackist['name'].'</a></td>';
						if($status['review']==1)
							echo'<td style="color:green;">Reviewed</td>';
						else
							echo'<td style="color:#FF3300;">To be Reviewed</td>';
						if($status['ticket_id']==1)
							echo '<td>Ticket Raised</td>';
						else
							echo '<td>No Ticket Raised</td>';
					if($status['ticket_no']=='')
						echo'<td style="text-align:center;">-</td>';
					else
						echo'<td>'.$status['ticket_no'].'</td>';
					if($status['date_time']=='')
						echo'<td style="text-align:center;">-</td>';
					else
						echo'<td>'.$status['date_time'].'</td></tr>';
			}
		}
	}
?>
		</table>
		</div>
	</body>
</section>
<div class="clear">&nbsp;</div>
<?php
$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&group_id=".$_GET['group_id']."&status=".$_GET['status']."&";
if($total_pages > 1)
	include("includes/Pagination.php");
?>