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
							while($Group = mysql_fetch_array($Groups))
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
						Display Format <font color="red">*</font><br/>
						<?php
						if($_POST['displaydata']=="Count")
						{
							echo'<input type="radio" id="displaydata" name="displaydata" value="Count" checked>Count<br>';
							echo'<input type="radio" id="displaydata" name="displaydata" value="Percent">Percent<br>';
						}
						else if($_POST['displaydata']=="Percent")
						{
							echo'<input type="radio" id="displaydata" name="displaydata" value="Count">Count<br>';
							echo'<input type="radio" id="displaydata" name="displaydata" value="Percent" checked>Percent<br>';
						}
						else
						{
							echo '<input type="radio" id="displaydata" name="displaydata" value="Count">Count<br>
							<input type="radio" id="displaydata" name="displaydata" value="Percent">Percent';
						} ?>
						<br/><input type="submit" value="Submit Report" name="report" class="button button-blue">&nbsp;&nbsp;&nbsp;
						<?php 
						if($_POST['report'])
							echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&group_id='.$_POST['group_id'].'&fromdate='.$_POST['fromdate'].'&todate='.$_POST['todate'].'&displaydata='.$_POST['displaydata'].'&Search=1")\'>Download</a>';
						?>
				</div>
			
			</fieldset>	
		</form>
		<br/>
		<?php
		if($_POST['report'])
		{
			/* echo'<table>
					<tr>
						<td style="font-size:12px;"><span style="color:red;">1</span>-NA</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">2</span>-Excellent</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">3</span>-Good</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">4</span>-Average</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">5</span>-Poor</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">6</span>-Very Poor</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">7</span>-No Wait</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">8</span>-Within 10min</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">9</span>-30 Min</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">10</span>-30-60 Min</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">11</span>-More than 60 Min</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">12</span>-Yes</td>
						<td>&nbsp;</td>
						<td style="font-size:12px;"><span style="color:red;">13</span>-No</td>
					</tr>
				</table>'; */
			echo "<br/><table class='pagin sortable full'>";
			$column = $options = $lists = $answer =array();
			$i=1;
			$Columns = mysql_Query("SELECT distinct(column_name) as column_name FROM information_schema.columns WHERE table_name='feedbacks_$_POST[group_id]'");
			while($Columnname = mysql_fetch_Assoc($Columns))
			{
				$Qlist = mysql_Fetch_Assoc(mysql_query("SELECT option_ids,name,Id FROM questions WHERE questions.id='".$Columnname['column_name']."' && ownerEl='0'"));
				if($Qlist['option_ids'])
				{
					echo '<tr>
							<td colspan="7" style="font-size:12px;font-weight:bold;">'.$Qlist['name'].'</td>
						</tr><tr><td></td>';
					$column[] = $Qlist['Id'];
					$options[] = $Qlist['option_ids'];
					$optionids = explode(',',$Qlist['option_ids']);
					$answer = $Answeroption = array();
					foreach($optionids as $optionid)
					{
						if($optionid == '')
						{}
						else
						{
							$Alist = mysql_fetch_assoc(mysql_query("SELECT answer,id FROM answers WHERE id='".$optionid."'"));
							$answer[$Alist['id']] = 0;
							if($_POST['displaydata'] =="Percent")
							{
								if($Alist['id'] == 1)
									echo'<td><b>All%&nbsp;</b></td>';
								echo'<td style="text-align:center"><b>'.$Alist['answer'].'%</b></td>';
								$Answeroption[] = $Alist['answer'].'%';
							}	
							else 	
							{
								if($Alist['id'] == 1)
									echo'<td><b>All&nbsp;</b></td>';
								echo'<td style="text-align:center"><b>'.$Alist['answer'].'</b></td>';
								$Answeroption[] = $Alist['answer'];
							}	
						}
					}
					if($Qlist['Id']=='')
					{}
					else
					{
						$AllOptionValues = array();
						$SQlist = mysql_query("SELECT name,Id FROM questions WHERE ownerEl='".$Qlist['Id']."'");
						while($Sqlists = mysql_Fetch_Assoc($SQlist))
						{
							echo '<tr><td>'.$Sqlists['name'].'</td>';	
							$total_count=mysql_Fetch_Assoc(mysql_query("SELECT count(feedbacks_$_POST[group_id].".$Sqlists['Id'].") as total_count FROM questions join feedbacks_$_POST[group_id] on questions.id=feedbacks_$_POST[group_id].".$Sqlists['Id']." WHERE date_time between '".$_POST['fromdate']."' and '".$_POST['todate']."'"));
							$list_count = mysql_query("SELECT count(feedbacks_$_POST[group_id].".$Sqlists['Id'].") as total, feedbacks_$_POST[group_id].".$Sqlists['Id']." FROM questions join feedbacks_$_POST[group_id] on questions.id=feedbacks_$_POST[group_id].".$Sqlists['Id']." WHERE date_time between '".$_POST['fromdate']."' and '".$_POST['todate']."' group by questions.id");
							$patient_count = mysql_Fetch_Assoc(mysql_query("SELECT count(feedbacks_$_POST[group_id].patient_id) as patientcount FROM questions join feedbacks_$_POST[group_id] on questions.id=feedbacks_$_POST[group_id].".$Sqlists['Id']." WHERE date_time between '".$_POST['fromdate']."' and '".$_POST['todate']."'"));
							if($_POST['displaydata'] == "Count")
								echo "<td>".$total_count['total_count']."</td>";
							else if($_POST['displaydata'] =="Percent")
								echo "<td>".(($total_count['total_count']/$patient_count['patientcount'])*100)."</td>";
							while($ACount = mysql_Fetch_Assoc($list_count))
							{
								if($_POST['displaydata'] == "Count")
								{
									$answer[$ACount[$Sqlists['Id']]] = $ACount['total_count'];
									$answer[$ACount[$Sqlists['Id']]] = $ACount['total'];
								}	
								else if($_POST['displaydata'] =="Percent")
								{
									$percent = ($ACount['total']/$patient_count['patientcount'])*100;
									$answer[$ACount[$Sqlists['Id']]] = number_format($percent,2);
								}
							}
							echo "<td>".implode("</td><td style='text-align:center'>", $answer)."</td>";
							$AllOptionValues[] = $answer;
							foreach($answer as $Key => $Value)
								$answer[$Key] = 0;
							echo '</tr>';
							$Subquestion[] = "'".$Sqlists['name']."'";
						} 
							if($Answeroption)
						{
							?>
							<tr><td><button class="btn1<?php echo $Columnname['column_name']; ?>" onclick="showchart(<?php echo $Columnname['column_name']; ?>)">Show Charts</button>
									<button class="btn2<?php echo $Columnname['column_name']; ?>" onclick="hidechart(<?php echo $Columnname['column_name']; ?>)">Hide Charts</button></td></tr>
							<tr><td colspan="7">
							<div id='h'>
								<script type="text/javascript">
									$(function()
									{
										$('#Chart<?php echo $Columnname['column_name'];?>').highcharts({
												chart: {
													type: 'column'
												},
												title: {
													text: '<?php echo $Qlist['name'];?>'
												},
												subtitle: {
													text: ''
												},
												xAxis: {
													categories: [<?php echo implode(",", $Subquestion); ?>]
												},
												yAxis: {
													min: 0,
													title: {
														text: ''
													}
												},
												tooltip: {
													headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
													pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
														'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
													footerFormat: '</table>',
													shared: true,
													useHTML: true
												},
												plotOptions: {
													column: {
														pointPadding: 0.2,
														borderWidth: 0
													}
												},
												series: [
												<?php
												for($in = 0; $in < COUNT($Answeroption); $in++)
												{
													if($in)
														echo ",";
													echo "{
													name: '".$Answeroption[$in]."',
													data: [".implode(",", $AllOptionValues[$in])."]
													}";
												} ?>]
											});
										});
								</script>
							
								<div id="Chart<?php echo $Columnname['column_name'];?>" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							</div>
							<?php 	
							echo '</td></tr>';
							?> 
					<?php
						}
					}
				}
			}
			echo '</table>';
		}
	?>
	<script src="includes/Highcharts-4.0.3/js/highcharts.js"></script>
	<script src="includes/Highcharts-4.0.3/js/modules/exporting.js"></script>
</div>
</section>
<script>
	function Export(PostBackValues)
	{
		//window.open("includes/ExportReports_Chart.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
		$.post("includes/ExportReports_Chart.php", {export:1, subpage:"<?php echo $_GET['subpage']; ?>", group_id:"<?php echo $_POST['group_id']; ?>", fromdate:"<?php echo $_POST['fromdate']; ?>", todate:"<?php echo $_POST['todate']; ?>", displaydata:"<?php echo $_POST['displaydata']; ?>"}, function(result)
		{
			window.open("includes/Export/"+result, 'popUpWindow','height=400, width=650, left=300, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');
		});
	}
	function showchart(id)
	{
		$("#Chart"+id).show();
		$(".btn2"+id).show();
		$(".btn1"+id).hide();
	}
	function hidechart(id)
	{
		$("#Chart"+id).hide();
		$(".btn1"+id).show();
		$(".btn2"+id).hide();
	}		
</script>