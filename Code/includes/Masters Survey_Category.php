<section role="main" id="main">
	<?php
		session_start();
		$Columns = array("id", "name", "status","prefix");
		if($_GET['action'] == 'Edit')
		{
			$Group = mysql_fetch_assoc(Group_Select_ById());
			foreach($Columns as $Col)
				$_POST[$Col] = $Group[$Col];
		}
		else if($_GET['action'] == 'Delete')
		{
			Group_Delete_ById($_GET['id']);
			$message = "<br /><div class='message success'><b>Message</b> : One Survey Category deleted successfully</div>";
		}
		
		if(isset($_POST['Submit']) || isset($_POST['Update']))
		{
			$GroupResource = Group_Select_ByName();
			if(isset($_POST['Submit']))
			{
				if(mysql_num_rows($GroupResource))
					$message = "<br /><div class='message error'><b>Message</b> : This Survey Category already exists</div>";
				else
				{
					Group_Insert();
					$message = "<br /><div class='message success'><b>Message</b> : Survey Category added successfully</div>";
				}
			}
			else if(isset($_POST['Update']))
			{
				$Group = mysql_fetch_assoc($GroupResource);
				if(mysql_num_rows(Group_Select_ByNameId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Survey Category already exists</div>";
				else if(mysql_num_rows(Group_Select_ByFeedbackId()))
					$message = "<br /><div class='message error'><b>Message</b> : This Survey Category already exist in the feedback</div>"; 
				else
				{
					Group_Update();
					$message = "<br /><div class='message success'><b>Message</b> : Survey Category details updated successfully</div>";
				}
			}
			foreach($Columns as $Col)
				$_POST[$Col] = "";
		}
	?>
	<div class="columns" style='width:902px;'>
		<?php echo $message; ?>
		<form method="post" action="?page=<?php echo $_GET['page']."&subpage=".$_GET['subpage']."&pageno=".$_GET['pageno']; ?>" id="form" class="form panel" onsubmit="return validation()">
			<input type="hidden" name="id" value="<?php if($_GET['id']) echo $_GET['id']; else echo $_SESSION[$_SESSION['Prefix'].'id']; ?>" required="required"/>
			<header><h2>Add Survey Category</h2></header>
			<hr />				
			<fieldset>
				<div class="clearfix">
					<label>
						Survey Category <font color="red">*</font><br />
						<input type="text" id="name" name="name" required="required" value="<?php echo $_POST['name']; ?>" onkeypress="return isAlphaOrNumeric(event)" />
					</label>
					<label>
						Prefix <font color="red">*</font><br />
						<input type="text" id="prefix" name="prefix" required="required" value="<?php echo $_POST['prefix']; ?>" onkeypress="return isAlphaOrNumeric(event)" />
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
		<h3>Survey Category List
			<?php
			$GroupTotalRows = mysql_fetch_assoc(Group_Select_Count_All());
			echo " : No. of total Groups - ".$GroupTotalRows['total'];
			?>
		</h3>
		<hr />			
		<table class="paginate sortable full">
			<thead>
				<tr>
					<th width="43px" align="center">S.No.</th>
					<th align="left">Survey Category</th>
					<th align="left">Prefix</th>
					<th align="left">Enable/Disable</th>
					<th align="left">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!$GroupTotalRows['total'])
					echo '<tr><td colspan="3"><font color="red"><center>No data found</center></font></td></tr>';
				$Limit = 10;
				$total_pages = ceil($GroupTotalRows['total'] / $Limit);
				if(!$_GET['pageno'])
					$_GET['pageno'] = 1;
				
				$Start = ($_GET['pageno']-1)*$Limit;
				if($_GET['pageno'] > 1)
					$i = $GroupTotalRows['total']- $Start;
				else
					$i = $GroupTotalRows['total'];
				$Departments = array("Disable", "Enable");
				$Status = array("<a href='#' class='action-button' title='delete'><span class='delete'></span></a>", "<a href='#' class='action-button' title='accept'><span class='accept'></span></a>");
				$Groups = Group_Select_ByLimit($Start, $Limit);
				while($Group = mysql_fetch_assoc($Groups))
				{
					echo "<tr>
						<td align='center'>".$i--."</td>
						<td>".$Group['name']."</td>
						<td>".$Group['prefix']."</td>
						<td>".$Departments[$Group['status']]."</td>
						<td><a href='index.php?page=".$_GET['page']."&subpage=".$_GET['subpage']."&id=".$Group['id']."&pageno=".$_GET['pageno']."&action=Edit'>Edit</a> </td>
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
		if(document.getElementById("prefix").value.length < 2 || document.getElementById("prefix").value.length > 5)
			message = "prefix should be within 2 to 5 characters";
		if(document.getElementById("name").value.length < 4 || document.getElementById("name").value.length > 15)
			message = "Survey Category should be within 4 to 15 characters";
		if(message)
		{
			alert(message);
			return false;
		}
		else
			return true;
	}
</script>