<head>
<script type="text/javascript" src="js/jscolor/jscolor.js"></script>
</head>
<section role="main" id="main">
	<?php
	$Columns = array("id", "answer", "status", "color","rating");
	if($_GET['action'] == 'Edit')
	{
		$Answer = mysqli_fetch_assoc(Answer_Select_ById());
		foreach($Columns as $Col)
			$_POST[$Col] = $Answer[$Col];
	}
	else if($_GET['action'] == 'Delete')
	{
		Answer_Delete_ById($_GET['id']);
		$message = "<br /><div class='message success'><b>Message</b> : One Answer deleted successfully</div>";
	}
	
	if(isset($_POST['Submit']) || isset($_POST['Update']))
	{
		$AnswerResource = Answer_Select_ByNamePWD();
		if(isset($_POST['Submit']))
		{
			if(mysqli_num_rows($AnswerResource))
				$message = "<br /><div class='message error'><b>Message</b> : This Answer already exists</div>";
			else
			{
				Answer_Insert();
				$message = "<br /><div class='message success'><b>Message</b> : Answer added successfully</div>";
			}
		}
		else if(isset($_POST['Update']))
		{
			$Answer = mysqli_fetch_assoc($AnswerResource);
			if(mysqli_num_rows(Answer_Select_ByNamePWDId()))
				$message = "<br /><div class='message error'><b>Message</b> : This Answer already exists</div>";
			else
			{
				Answer_Update();
				$message = "<br /><div class='message success'><b>Message</b> : Answer details updated successfully</div>";
			}
		}
		foreach($Columns as $Col)
			$_POST[$Col] = "";
	} ?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION[$_SESSION['Prefix'].'id']; ?>" required="required"/>
			<header><h2>Add Answer</h2></header>
			<hr />
			<fieldset>
				<div class="clearfix">
					<label>
						Answer <font color="red">*</font><br />
						<input type="text" id="answer" name="answer" required="required" value="<?php echo $_POST['answer']; ?>" onkeypress="return isAlphaOrNumeric(event)"/>
					</label>
					<label>
						Rating <font color="red">*</font><br />
						<input type="text" id="rating" name="rating" required="required" value="<?php echo $_POST['rating']; ?>" onkeypress="return isNumeric(event)"/>
					</label>
					<label>
						Font Color <font color="red">*</font><br />
						<input class="color" id="color" name="color" value="<?php if($_GET['id']) echo $_POST['color'];else echo "#000";?>">
					</label>
					<label style="width:110px">
						<br />
						<?php
						if($_POST['status'])
							echo '<input type="checkbox" name="status" id="status" value="1" checked></input>';
						else
							echo '<input type="checkbox" name="status" id="status" value="1" ></input>';
						?>&nbsp;Enable
					</label>
					<label>
						<?php
						if($_GET['action'] == 'Edit')
							echo '<button class="button button-blue" type="submit" name="Update" value="Update">Update</button>&nbsp;&nbsp;';
						else
							echo '<button class="button button-blue" type="submit" name="Submit">Submit</button>&nbsp;&nbsp;';
						?>
						<button class="button button-gray" type="reset">Reset</button>
					</label>
				</div>
			</fieldset>
		</form>
	</div>
	
	<div class="columns">
		<h3>Answer List
			<?php
			$AnswerTotalRows = mysqli_fetch_assoc(Answer_Select_Count_All());
			echo " : No. of total Answers - ".$AnswerTotalRows['total'];
			?>
		</h3>
		<hr />
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.No.</th>
					<th align="left">Answer</th>
					<th align="left">Rating</th>
					<th align="left">Color</th>
					<th align="left">Enable/Disable</th>
					<th align="left">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$AnswerTotalRows['total'])
					echo '<tr><td colspan="7"><font color="red"><center>No data found</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($AnswerTotalRows['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$Start = ($_GET['pageno']-1)*$Limit;
				if($_GET['pageno'] > 1)
					$i = $AnswerTotalRows['total']- $Start;
				else
					$i = $AnswerTotalRows['total'];
				$Answers = array("Disable", "Enable");
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$AnswerRows = Answer_Select_ByLimit($Start, $Limit);
				while($Answer = mysqli_fetch_assoc($AnswerRows))
				{
					echo "<tr>
						<td align='center'>".$i--."</td>
						<td style='color:".$Answer['color'].";'>".$Answer['answer']."</td>
						<td>".$Answer['rating']."</td>
						<td>".$Answer['color']."</td>
						<td>".$Answers[$Answer['status']]."</td>";
						echo "<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Answer['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a></td>
					</tr>";
				} ?>
			</tbody>
		</table>
	</div>
	<div class="clear">&nbsp;</div>
	<?php
	$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
	if($total_pages > 1)
		include("includes/Pagination.php");
	?>
</section>
<script>
	function isAlphabetic(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 46)
			return true;
		else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
			return true;
		else
			return false;
	}
	
	function isNumeric(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode == 8 || charCode == 9  || charCode == 45 || charCode == 46 || charCode == 47)
			return true;
		if(charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	}
	
	function validation()
	{
		var message = "";
		if(document.getElementById("answer").value.length < 2 || document.getElementById("answer").value.length > 25)
			message = "Answer should be within 2 to 25 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>