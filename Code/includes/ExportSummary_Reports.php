<?php
if(isset($_GET['export']))
	{
		session_start();
		include("Config.php");
		ini_set("display_errors","0");
		$_POST['Search'] = $_GET['Search'];
		$_POST['group_id'] = $_GET['group_id'];
		include("Reports_Queries.php");
		date_default_timezone_set('Asia/Kolkata');
		header("Content-Type: application/msexcel");
		header("Content-Disposition: attachment; filename=".str_replace(" ", "_", $_GET['subpage'].date("d-m-Y H-i")).".xls");
	}
	if($_GET['Search'])
	{ ?>
		<table class='paginate sortable full'>
				<thead>
					<th align='left'>Si.No</th>
					<th align='left'>Month Name</th>
					<th align='left'>Feedback Count</th>
				</thead>
				<?php
						$countfeedbacknumbers = mysqli_query("SELECT extract(MONTH from `date_time`)as monthvalue,count(extract(MONTH from `date_time`)) as datavalue  FROM feedbacks_$_POST[group_id] where extract(year from curdate()) = extract(YEAR from `date_time`) group by extract(MONTH from `date_time`) order by `date_time` desc");
						$feedbacknumbers = mysqli_query("SELECT extract(MONTH from `date_time`)as monthvalue,count(extract(MONTH from `date_time`)) as datavalue  FROM feedbacks_$_POST[group_id] where extract(year from curdate()) = extract(YEAR from `date_time`) group by extract(MONTH from `date_time`) order by `date_time` desc");
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
			<script type="text/javascript">
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
									$feedbacknumbers = mysqli_query("SELECT extract(MONTH from `date_time`)as monthvalue,count(extract(MONTH from `date_time`)) as datavalue  FROM feedbacks_$_POST[group_id] where extract(year from curdate()) = extract(YEAR from `date_time`) group by extract(MONTH from `date_time`) order by `date_time` desc"); 
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
			<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
				<script src="includes/Highcharts-4.0.3/js/highcharts.js"></script>
				<script src="includes/Highcharts-4.0.3/js/modules/exporting.js"></script>
<?php 
	} ?>	