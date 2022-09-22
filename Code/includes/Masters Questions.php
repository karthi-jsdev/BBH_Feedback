	<div class="panel" style='width:962px;'>
		<header><h2><i class="fa fa-bars"></i>Select Survey Category and then add or edit questions / sub-questions / answer options</h2></header>
		<hr />
		<div class="clearfix">
			<label>Survey Category <font color="red">*</font></label>&nbsp;&nbsp;
			<select onChange="window.document.location.href='<?php echo 'index.php?page='.$_GET['page'].'&subpage='.$_GET['subpage'].'&group_id='; ?>'+this.options[this.selectedIndex].value;">
				<option value="">Select</option>
				<?php
				$Groups = mysql_query("SELECT * FROM groups WHERE status=1 ORDER BY id");
				while($Group = mysql_fetch_array($Groups))
				{
					if($Group['id'] == $_GET['group_id'])
					{
						echo '<option value="'.$Group['id'].'" selected>'.$Group['name'].'</option>';
						$_SESSION['group_name'] = $Group['name'];
					}
					else
						echo '<option value="'.$Group['id'].'">'.$Group['name'].'</option>';
				}
				$_SESSION['group_id'] = $_GET['group_id'];
				?>
			</select>
		</div>
	</div>
	
	<?php
	if($_GET['group_id'])
	{ ?>
		<section role="main" id="main">
			<div class="columns" style='width:982px;height:700px;'>
				<form class="form panel" role="form" id="<?php echo $_GET['subpage'];?>_Form" style="height:500px;">
					<?php $_SESSION['TreeCheckBox'] = 1; ?>
					<iframe src="includes/Dynamic_Tree/Dynamic_Tree.php" width="100%" height="100%" frameborder="0"></iframe>
				</form>
			</div>	
		</section>

		<script>
			var DefaultKeyboardKeys = [8, 9, 35, 36, 37, 39, 46];
			function isAlphabetic(evt)
			{
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if(DefaultKeyboardKeys.indexOf(charCode) > -1 || charCode == 32)
					return true;
				else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
					return true;
				else
					return false;
			}
		</script>
	<?php
	} ?>