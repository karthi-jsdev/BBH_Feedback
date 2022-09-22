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
			$("#year").datepicker({
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'MM yy'
			}).focus(function() {
				var thisCalendar = $(this);
				$('.ui-datepicker-calendar').detach();
				$('.ui-datepicker-close').click(function() {
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				thisCalendar.datepicker('setDate', new Date(year, month, 1));
				});
			});
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
						Select Year <font color="red">*</font><br />
						<input type="text" id="year" name="year" required="required" value="<?php echo $_POST['year']; ?>"/>
					</label>
				</div>			
				<br/>
				<input type="submit" value="Submit Report" name="report" class="button button-blue">&nbsp;&nbsp;&nbsp;
				<?php 
				if($_POST['report'])
					echo '<a class="button button-green" onclick=\'Export("subpage='.$_GET['subpage'].'&group_id='.$_POST['group_id'].'&Search=1")\'>Download</a>';
				?>
			</fieldset>	
		</form>	
		<br />
		<?php
		if(($_POST['report']) && ($_POST['group_id'] != ''))
		{ ?>
			<table class='paginate sortable full'>
				<thead>
					<th align='left'>Si.No</th>
					<th align='left'>Month Name</th>
					<th align='left'>Feedback Count</th>
				</thead>
				<?php
						$countfeedbacknumbers = mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT extract(MONTH from `date_time`)as monthvalue,count(extract(MONTH from `date_time`)) as datavalue  FROM feedbacks_$_POST[group_id] where extract(year from '".date('y-m-d',strtotime($_POST['year']))."') = extract(YEAR from `date_time`) group by extract(MONTH from `date_time`) order by `date_time` desc");
						$feedbacknumbers = mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT extract(MONTH from `date_time`)as monthvalue,count(extract(MONTH from `date_time`)) as datavalue  FROM feedbacks_$_POST[group_id] where extract(year from '".date('y-m-d',strtotime($_POST['year']))."') = extract(YEAR from `date_time`) group by extract(MONTH from `date_time`) order by `date_time` desc");
						$Countfeedbacks = mysqli_fetch_array($countfeedbacknumbers);
						if($Countfeedbacks['datavalue'] == 0)
							echo "<tr><td colspan='3' align='center' style='color:red'>No Data Found</td></tr>" ;
						$i=1;
						while($Numberoffeedback = mysqli_fetch_array($feedbacknumbers))
						{
							echo "<tr><td>".$i++."</td>
							<td>".date("F", mktime(0, 0, 0, $Numberoffeedback['monthvalue'], 01))."</td>
							<td>".$Numberoffeedback['datavalue']."</td></tr>";
						}
					?>	
			</table>
			<br />
			<?php 
			$monthname = $feedbackcountvalues = array();
			$feedbacknumbers = mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT extract(MONTH from `date_time`)as monthvalue,count(extract(MONTH from `date_time`)) as datavalue  FROM feedbacks_$_POST[group_id] where extract(year from '".date('y-m-d',strtotime($_POST['year']))."') = extract(YEAR from `date_time`) group by extract(MONTH from `date_time`) order by `date_time` asc"); 
				while($Numberoffeedback = mysqli_fetch_array($feedbacknumbers))
				{				
					$monthname[] = date("F", mktime(0, 0, 0, $Numberoffeedback['monthvalue'], 01));
					$feedbackcountvalues[] = $Numberoffeedback['datavalue'];
				}	
			?>
			<script type="text/javascript">
					$(function () {
					$('#container1').highcharts({
						chart: {
							type: 'column'
						},
						title: {
							text: 'Yearly Feedback'
						},
						subtitle: {
							text: ''
						},
						xAxis: {
							categories: [
								<?php echo "'".implode("','", $monthname)."'"; ?>
							]
						},
						yAxis: {
							min: 0,
							title: {
								text: 'feedbackcount'
							}
						},
						tooltip: {
							headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
								'<td style="padding:0"><b>{point.y:.0f} </b></td></tr>',
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
							name: 'Month',
							data: [<?php echo implode(",",$feedbackcountvalues);?>]
				
						}]
					});
				});
				
				$(function () {
					$('#container').highcharts({
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: 1,//null,
							plotShadow: false
						},
						title: {
							text: 'Feedback Count- <?php echo date("Y"); ?>'
						},
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: true,
									format: '<b>{point.name}</b>: {point.percentage:.1f} %',
									style: {
										color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
									}
								}
							}
						},
						series: [{
							type: 'pie',
							name: 'feedbackcount',
							data: [
							<?php 
								$feedbacknumbers = mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT extract(MONTH from `date_time`)as monthvalue,count(extract(MONTH from `date_time`)) as datavalue  FROM feedbacks_$_POST[group_id] where extract(year from '".date('y-m-d',strtotime($_POST['year']))."') = extract(YEAR from `date_time`) group by extract(MONTH from `date_time`) order by `date_time` desc"); 
								while($Numberoffeedback = mysqli_fetch_array($feedbacknumbers))
								{ ?>
									['<?php echo date("F", mktime(0, 0, 0, $Numberoffeedback['monthvalue'], 01));?>',   <?php echo $Numberoffeedback['datavalue'];?>],
						<?php 	}
							?>
							]
						}]
					});
				});
		</script>
		<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<br /><br />
		<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
			<script src="includes/Highcharts-4.0.3/js/highcharts.js"></script>
			<script src="includes/Highcharts-4.0.3/js/modules/exporting.js"></script>
		<?php
		} ?>	
	</div>	
</section>
<script>
	function Export(PostBackValues)
	{
		window.open("includes/ExportSummary_Reports.php?export=1&"+PostBackValues,'mypopup', 'status=1,width=1,height=1,scrollbars=1');
	}
</script>