<?php
	if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		$_POST['Search'] = $_GET['Search'];
		$_POST['group_id'] = $_GET['group_id'];
		$_POST['fromdate'] = $_GET['fromdate'];
		$_POST['todate'] = $_GET['todate'];
		$_POST['displaydata'] = $_GET['displaydata'];
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['subpage'].date("d-m-Y H-i")).".xls");
	}
	if($_GET['Search'])
	{

	echo "<br/><table>
					";
			$column = array();
			$options = array();
			$lists =array();
			$answer =array();
			$i=1;
			$Columns = mysql_Query("SELECT distinct(column_name) as column_name FROM information_schema.columns WHERE table_name='feedbacks_$_POST[group_id]'");
			while($Columnname = mysql_fetch_Assoc($Columns))
			{
				$Qlist = mysql_Fetch_Assoc(mysql_query("SELECT option_ids,name,Id FROM questions WHERE questions.id='".$Columnname['column_name']."' && ownerEl='0'"));
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
							echo'<td style="text-align:center"><b>'.$Alist['answer'].'%</b></td>';
							$Answeroption[] = $Alist['answer'].'%';
						}	
						else 	
						{
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
						$list_count = mysql_query("SELECT count(feedbacks_$_POST[group_id].".$Sqlists['Id'].") as total, feedbacks_$_POST[group_id].".$Sqlists['Id']." FROM questions join feedbacks_$_POST[group_id] on questions.id=feedbacks_$_POST[group_id].".$Sqlists['Id']." WHERE date_time between '".$_POST['fromdate']."' and '".$_POST['todate']."' group by questions.id");
						$patient_count = mysql_Fetch_Assoc(mysql_query("SELECT count(feedbacks_$_POST[group_id].patient_id) as patientcount FROM questions join feedbacks_$_POST[group_id] on questions.id=feedbacks_$_POST[group_id].".$Sqlists['Id']." WHERE date_time between '".$_POST['fromdate']."' and '".$_POST['todate']."'"));
						while($ACount = mysql_Fetch_Assoc($list_count))
						{
							if($_POST['displaydata'] == "Count")
								$answer[$ACount[$Sqlists['Id']]] = $ACount['total'];
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
					echo '<tr><td colspan="7">';
					?>
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
											text: 'Rainfall ()'
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
					<?php 	
					echo '</td></tr>';
					?> 
			<?php
				}
			}
			echo '</table>';

} ?>