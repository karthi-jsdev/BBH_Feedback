<section role="main" id="main">
	<link rel="stylesheet" type="text/css" href="css/datepicker/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker/demos.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/datepicker/jquery.ui.core.js"></script>
	<script src="js/datepicker/jquery.ui.widget.js"></script>
	<script src="js/datepicker/jquery.ui.datepicker.js"></script>
	<script>
		$(function()
		{
			$("#fromdate").datepicker({dateFormat: 'yy-mm-dd'});
			$("#todate").datepicker({dateFormat: 'yy-mm-dd'});
		});
	</script>
	<div class="columns panel" style='width:1000px;'>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION[$_SESSION['Prefix'].'id']; ?>" required="required"/>
			<header><h2>Reports</h2></header>
			<hr />
			<fieldset>
				<div class="clearfix">
					<label>Group Name <font color="red">*</font><br />
						<select id="group_id" name="group_id">
							<option value="">Select</option>
							<?php
							$Groups = Select_Groups();
							while($Group = mysqli_fetch_array($Groups))
							{
								if($Group['id'] == $_GET['group_id'] || $_POST['group_id'] == $Group['id'])
									echo '<option value="'.$Group['id'].'" selected>'.$Group['name'].'</option>';
								else
									echo '<option value="'.$Group['id'].'">'.$Group['name'].'</option>';
							} ?>
						</select>
					</label>
					<label>
						From Date <font color="red">*</font><br />
						<input type="text" id="fromdate" name="fromdate" required="required" value="<?php echo $_POST['fromdate']; ?>"/>
					</label>
					<label>
						To Date <font color="red">*</font><br />
						<input type="text" id="todate" name="todate" required="required" value="<?php echo $_POST['todate']; ?>"/>
					</label><br/>
				</div>			
				<br/>
				<input type="submit" value="Submit Report" name="report" class="button button-blue">&nbsp;&nbsp;&nbsp;
						<?php 
						if($_POST['report'])
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&group_id='.$_POST['group_id'].'&fromdate='.$_POST['fromdate'].'&todate='.$_POST['todate'].'&displaydata='.$_POST['displaydata'].'&Search=1")\'>Download</a>';
						?>
			</fieldset>			
		</form>	
		<br />
	</div>	
	<?php 
	if($_POST['report'])
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
			<td><font style='color:red'>".$commentsdetails['survey_id']."</style></td><td></td>
			<td></td><td colspan='4'><b>".$commentsdetails['name']."</b></td>
			<td>".$commentsdetails['comments']."</td>";
		}	
		
		echo "</tr>";	
		echo '</table>';
	} ?>
</section>	
<script>
	function Export(PostBackValues)
	{
		window.open("includes/ExportDescription_Reports.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>