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
					</label><br/><br/><br/><br/>
						
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
			echo "<br/><table class='pagin sortable full'>";
			
			$AnswerIds = $Score = $Scorevalue = array();
			$Answers = mysqli_query("SELECT * FROM answers ORDER BY id");
			while($Answer = mysqli_fetch_array($Answers))
			{
				$Score[$Answer['id']] = 0;
				$AnswerIds["$Answer[id]Id"] = $Answer['id'];
				$AnswerIds["$Answer[id]Name"] = $Answer['answer'];
				$AnswerIds["$Answer[id]Rating"] = $Answer['rating'];
			}
			$Numberoftotal = array();
			$SubQuestionId = mysqli_query("SELECT * FROM questions where group_id=$_POST[group_id] and ownerEl!=0 ORDER BY Id");
			while($subquestion = mysqli_fetch_array($SubQuestionId))
			{
				$Questions = mysqli_query("SELECT SUM(`$subquestion[Id]`) as totalcount, `$subquestion[Id]`, COUNT(`$subquestion[Id]`) as total from feedbacks_$_POST[group_id] GROUP BY `$subquestion[Id]`");
				while($Question = mysqli_fetch_assoc($Questions))
				{
					$Numberoftotal[$Question[$subquestion['Id']]] += $Question['total'];
					$Score[$Question[$subquestion['Id']]] += ($Question['total']* $AnswerIds[$Question[$subquestion['Id']]."Rating"]);
				}
			}
			echo '<tr><td></td><td>No</td><td>Rating</td><td>Score</td></tr>';
			foreach ($Score as $key => $value)
			{
				
					if($key!=1 && $key<=6)
					{
						$answeroptionname = mysqli_fetch_array(mysqli_query("select answer,rating from answers where id= '".$key."'"));
						$answername = $answeroptionname['answer'];
						$Totalratingvalue += $value;
						$Totalfeedbackvalue +=$Numberoftotal[$key];
						echo  '<tr><td>'.$answeroptionname['answer'].'</td><td>'.$Numberoftotal[$key].'</td><td>'.$answeroptionname['rating'].'</td><td>'.$value.'</td></tr>';
						$answernames[] = "'".$answeroptionname['answer']."'";
						$Scorevalue[] = $value;
					}	
			} 
			echo '<tr><td></td><td>'.$Totalfeedbackvalue.'</td><td></td><td>'.$Totalratingvalue.'</td></tr>';
			echo '<tr><td></td><td><b>Score:</b></td><td><b>'.($Totalratingvalue/$Totalfeedbackvalue*4).'</b></td></tr>';
			?>
		<script type="text/javascript">
				$(function () {
						$('#container').highcharts({
							chart: {
								type: 'column'
							},
							title: {
								text: 'Average Feedback'
							},
							subtitle: {
								text: ''
							},
							xAxis: {
								categories: [
									<?php echo implode(",", $answernames); ?>
								]
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
									'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
							series: [{
								name: 'Answer Options',
								data: [ <?php echo implode(",", $Scorevalue);?> ]
					
							}]
						});
					});
    

		</script>	
			<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			
			</table>
<?php		}	
	?>
	<script src="includes/Highcharts-4.0.3/js/highcharts.js"></script>
	<script src="includes/Highcharts-4.0.3/js/modules/exporting.js"></script>
</div>
</section>
<script>
	function Export(PostBackValues)
	{
		$.post("includes/ExportReports_Chart.php", {export:1, subpage:"<?php echo $_GET['subpage']; ?>", group_id:"<?php echo $_POST['group_id']; ?>", fromdate:"<?php echo $_POST['fromdate']; ?>", todate:"<?php echo $_POST['todate']; ?>", displaydata:"<?php echo $_POST['displaydata']; ?>"}, function(result)
		{
			//window.open("includes/Export/"+result, 'popUpWindow','height=400, width=650, left=300, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');
			window.open("includes/ExportReports_Chart.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
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