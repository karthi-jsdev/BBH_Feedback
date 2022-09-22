<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<?php 
	include("includes/Config.php");
	
	//Total Feedback
	$monthname = $feedbackcountvalues = array();
	$feedbacknumbers = mysql_query("SELECT date_time,COUNT(extract(day from `date_time`)) as countvalue  FROM feedbacks_1 where `date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from `date_time`)"); 
	while($Numberoffeedback = mysql_fetch_array($feedbacknumbers))
	{				
		$monthname[] = date('d-m-y',strtotime($Numberoffeedback['date_time']));
		$feedbackcountvalues[] = $Numberoffeedback['countvalue'];
	}
	$monthname1 = $feedbackcountvalues1 = array();
	$feedbacknumbers1 = mysql_query("SELECT date_time,COUNT(extract(day from `date_time`)) as countvalue  FROM feedbacks_2 where `date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from `date_time`)"); 
	while($Numberoffeedback1 = mysql_fetch_array($feedbacknumbers1))
	{				
		$monthname1[] = date('d-m-y',strtotime($Numberoffeedback1['date_time']));
		$feedbackcountvalues1[] = $Numberoffeedback1['countvalue'];
	}	
?>
<table class='paginate sortable full'>
<tr>
	<td>
		<script type="text/javascript">
				$(function () {
				$('#container').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'In-Patient Daily FeedbackCount'
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
						name: 'Date',
						data: [<?php echo implode(",",$feedbackcountvalues);?>]
			
					}]
				});
			});
		</script>	
		<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
	</td>
	<td>
		<script type="text/javascript">
				$(function () {
				$('#container1').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'Out-Patient Daily FeedbackCount'
					},
					subtitle: {
						text: ''
					},
					xAxis: {
						categories: [
							<?php echo "'".implode("','", $monthname1)."'"; ?>
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
						name: 'Date',
						data: [<?php echo implode(",",$feedbackcountvalues1);?>]
			
					}]
				});
			});
		</script>	
		<div id="container1" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
	</td>
</tr>
<br />
<tr>
<?php
	//Reviewed
	$Allfeedbacks = mysql_query("SELECT patients.`date_time`,count(*) as total FROM feedbacks_1 join patients on feedbacks_1.patient_id = patients.id 
	where patients.`date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from patients.`date_time`)");
	$ReviewsTotal = $Reviewed = $NotReviewed = $Datename = array();
	while($TotalAllfeedbacks = mysql_fetch_array($Allfeedbacks))
	{
		$Datename[] = date('d-m-y',strtotime($TotalAllfeedbacks['date_time']));
		$TotalAllfeedbacks['total'];
		$ReviewsTotal[] =  $TotalAllfeedbacks['total'];
	}
	
	$AllReviewedfeedbacks = mysql_query("SELECT patients.`date_time`,count(*) as total FROM feedbacks_1 join patients on feedbacks_1.patient_id = patients.id 
	JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_1.id
	where feedback_reviews.groups_id = 1 and feedback_reviews.review = 1 and patients.`date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from patients.`date_time`)");							
	$i = 0;
	while($Reviewedfeedbacks = mysql_fetch_array($AllReviewedfeedbacks))
	{
		$Reviewedfeedbacks['date_time'];
		$Reviewed[] = $Reviewedfeedbacks['total'];
		$NotReviewed[$i] = $ReviewsTotal[$i] - $Reviewed[$i];
		$i++;
	} 
	
	
	$Allfeedbacks1 = mysql_query("SELECT patients.`date_time`,count(*) as total FROM feedbacks_2 join patients on feedbacks_2.patient_id = patients.id 
	where patients.`date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from patients.`date_time`)");
	$ReviewsTotal1 = $Reviewed1= $NotReviewed1 = $Datename1 = array();
	while($TotalAllfeedbacks1 = mysql_fetch_array($Allfeedbacks1))
	{
		$Datename1[] = date('d-m-y',strtotime($TotalAllfeedbacks1['date_time']));
		$TotalAllfeedbacks1['total'];
		$ReviewsTotal1[] =  $TotalAllfeedbacks1['total'];
	}
	
	$AllReviewedfeedbacks1 = mysql_query("SELECT patients.`date_time`,count(*) as total FROM feedbacks_2 join patients on feedbacks_2.patient_id = patients.id 
	JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_2.id
	where feedback_reviews.groups_id = 2 and feedback_reviews.review = 1 and patients.`date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from patients.`date_time`)");							
	$i = 0;
	while($Reviewedfeedbacks1 = mysql_fetch_array($AllReviewedfeedbacks1))
	{
		$Reviewedfeedbacks1['date_time'];
		$Reviewed1[] = $Reviewedfeedbacks1['total'];
		$NotReviewed1[$i] = $ReviewsTotal1[$i] - $Reviewed1[$i];
		$i++;
	} 
?>
	
	<script type="text/javascript">
		$(function () {
				$('#container2').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'In-Patient Feedback Reviews'
					},
					xAxis: {
						categories: [<?php echo "'".implode("','", $Datename)."'"; ?>]
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Total feedback consumption'
						}
					},
					tooltip: {
						pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
						shared: true
					},
					plotOptions: {
						column: {
							stacking: 'percent'
						}
					},
						series: [{
						name: 'Reviewed',
						color: '#434348',
						data: [<?php echo implode(",", $Reviewed); ?>]
					}, {
						name: 'Not Reviewed',
						color: '#6CABE7',
						data: [<?php 
							for($i = 0;$i<COUNT($feedbackcountvalues);$i++)
							{
								if($i)
									echo ",";
								echo $feedbackcountvalues[$i] - $Reviewed[$i];
							}
						?>]
					}]
				});
			});
			
			$(function () {
				$('#container3').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'Out-Patient  Feedback Reviews'
					},
					xAxis: {
						categories: [<?php echo "'".implode("','", $Datename1)."'"; ?>]
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Total feedback consumption'
						}
					},
					tooltip: {
						pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
						shared: true
					},
					plotOptions: {
						column: {
							stacking: 'percent'
						}
					},
						series: [{
						name: 'Reviewed',
						color: '#434348',
						data: [<?php echo implode(",", $Reviewed1); ?>]
					}, {
						name: 'Not Reviewed',
						color: '#6CABE7',
						data: [<?php //echo implode(",", $NotReviewed1); 
							for($i = 0;$i<COUNT($feedbackcountvalues1);$i++)
							{
								if($i)
									echo ",";
								echo $feedbackcountvalues1[$i] - $Reviewed1[$i];
							}
						?>]
					}]
				});
			});
	</script>
	<td>
		<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</td>
	<td>
		<div id="container3" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</td>
</tr>
<?php
		//Reviewed and Raised
		
		$Allreviewed = mysql_query("SELECT patients.`date_time`,count(*) as total FROM feedbacks_1 join patients on feedbacks_1.patient_id = patients.id 
			JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_1.id
			where feedback_reviews.review = 1 and feedback_reviews.groups_id = 1 and patients.`date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from patients.`date_time`)");
		$AllReviewsTotal = $RaisedReviewed = $NotRaisedReviewed = $RaisedDatename = array();
		while($Totalreviewedfeedbacks = mysql_fetch_array($Allreviewed))
		{
			$RaisedDatename[] = date('d-m-y',strtotime($Totalreviewedfeedbacks['date_time']));
			$Totalreviewedfeedbacks['total'];
			$AllReviewsTotal[] =  $Totalreviewedfeedbacks['total'];
		}
		
		$AllRaisedreviewsfeedbacks = mysql_query("SELECT patients.`date_time`,count(*) as total FROM feedbacks_1 join patients on feedbacks_1.patient_id = patients.id 
		JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_1.id
		where feedback_reviews.groups_id = 1 and feedback_reviews.review = 1 and feedback_reviews.ticket_no != '' and patients.`date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from patients.`date_time`)");							
		$i = 0;
		while($RaisedReviewedfeedbacks = mysql_fetch_array($AllRaisedreviewsfeedbacks))
		{
			$RaisedReviewedfeedbacks['date_time'];
			$RaisedReviewed[] = $RaisedReviewedfeedbacks['total'];
			$NotRaisedReviewed[$i] = $AllReviewsTotal[$i] - $RaisedReviewed[$i];
			$i++;
		}
		
		
		$Allreviewed1 = mysql_query("SELECT patients.`date_time`,count(*) as total FROM feedbacks_2 join patients on feedbacks_2.patient_id = patients.id 
			JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_2.id
			where feedback_reviews.groups_id = 2 and feedback_reviews.review = 1 and patients.`date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from patients.`date_time`)");
		$AllReviewsTotal1 = $RaisedReviewed1 = $NotRaisedReviewed1 = $RaisedDatename1 = array();
		while($Totalreviewedfeedbacks1 = mysql_fetch_array($Allreviewed1))
		{
			$RaisedDatename1[] = date('d-m-y',strtotime($Totalreviewedfeedbacks1['date_time']));
			$Totalreviewedfeedbacks1['total'];
			$AllReviewsTotal1[] =  $Totalreviewedfeedbacks1['total'];
		}
		
		$AllRaisedreviewsfeedbacks1 = mysql_query("SELECT patients.`date_time`,count(*) as total FROM feedbacks_2 join patients on feedbacks_2.patient_id = patients.id 
		JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_2.id
		where feedback_reviews.review = 1 and feedback_reviews.groups_id = 2 and feedback_reviews.ticket_no != '' and patients.`date_time` >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) group by extract(day from patients.`date_time`)");							
		$i = 0;
		while($RaisedReviewedfeedbacks1 = mysql_fetch_array($AllRaisedreviewsfeedbacks1))
		{
			$RaisedReviewedfeedbacks1['date_time'];
			$RaisedReviewed1[] = $RaisedReviewedfeedbacks1['total'];
			$NotRaisedReviewed1[$i] = $AllReviewsTotal1[$i] - $RaisedReviewed1[$i];
			$i++;
		}
		
			
?>

<script>
	$(function () {
				$('#container4').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'In-Patient Daily Feedback Ticket Raised'
					},
					xAxis: {
						categories: [<?php echo "'".implode("','", $RaisedDatename)."'"; ?>]
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Total feedback Ticket raised consumption'
						}
					},
					tooltip: {
						pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
						shared: true
					},
					plotOptions: {
						column: {
							stacking: 'percent'
						}
					},
						series: [{
						name: 'Ticket Not Raised',
						color: '#90ED7D',
						data: [<?php echo implode(",", $NotRaisedReviewed); ?>]
					}, {
						name: 'Ticket Raised',
						color: '#434348',
						data: [<?php echo implode(",", $RaisedReviewed); ?>]
					}, {
						name: 'Not Reviewed',
						color: '#6CABE7',
						data: [<?php //echo implode(",", $NotReviewed); 
							for($i = 0;$i<COUNT($feedbackcountvalues);$i++)
							{
								if($i)
									echo ",";
								echo $feedbackcountvalues[$i] - $Reviewed[$i];	
							}
						?>]
					}]
				});
			});
			
			
			
			$(function () {
				$('#container5').highcharts({
					chart: {
						type: 'column'
					},
					title: {
						text: 'OUT-Patient Daily Feedback Ticket Raised'
					},
					xAxis: {
						categories: [<?php echo "'".implode("','", $RaisedDatename1)."'"; ?>]
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Total feedback Ticket raised consumption'
						}
					},
					tooltip: {
						pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
						shared: true
					},
					plotOptions: {
						column: {
							stacking: 'percent'
						}
					},
						series: [{
						name: 'Ticket Not Raised',
						color: '#90ED7D',
						data: [<?php echo implode(",", $NotRaisedReviewed1); ?>]
					}, {
						name: 'Ticket Raised',
						color: '#434348',
						data: [<?php echo implode(",", $RaisedReviewed1); ?>]
					}, {
						name: 'Not Reviewed',
						color: '#6CABE7',
						data: [<?php //echo implode(",", $NotReviewed); 
							for($i = 0;$i<COUNT($feedbackcountvalues1);$i++)
							{
								if($i)
									echo ",";
								echo $feedbackcountvalues1[$i] - $Reviewed1[$i];	
							}
						?>]
					}]
				});
			});

</script>
<tr>	
	<td>
		<div id="container4" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</td>
	<td>
		<div id="container5" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</td>
</tr>
</table>

<script src="includes/Highcharts-4.0.3/js/highcharts.js"></script>
<script src="includes/Highcharts-4.0.3/js/modules/exporting.js"></script>				