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
	</div>	
	<br />
<?php 
if(($_POST['report']) && ($_POST['group_id'] != ''))
{	
	include("includes/Config.php");
	
	//Surveycategoryname
	$surveycategoryname = mysql_fetch_array(mysql_query("SELECT name from groups where id='".$_POST['group_id']."'"));
	
	//Total Feedback
	$monthname = $feedbackcountvalues = array();
	$feedbacknumbers = mysql_query("SELECT extract(MONTH from `date_time`) as monthyear,COUNT(extract(YEAR_MONTH from `date_time`)) as countvalue  FROM feedbacks_".$_POST['group_id']." where extract(YEAR_MONTH from `date_time`) = extract(YEAR_MONTH from '".date('y-m-d',strtotime($_POST['year']))."') group by extract(YEAR_MONTH from `date_time`)"); 
	while($Numberoffeedback = mysql_fetch_array($feedbacknumbers))
	{				
		$monthname[] = date('F', mktime(0, 0, 0, $Numberoffeedback['monthyear'], 01));
		$feedbackcountvalues[] = $Numberoffeedback['countvalue'];
	}	


	//Reviewed 
	$Allfeedbacks = mysql_query("SELECT extract(YEAR_MONTH from patients.`date_time`) as monthyear,count(*) as total FROM feedbacks_".$_POST['group_id']." join patients on feedbacks_".$_POST['group_id'].".patient_id = patients.id 
								where extract(YEAR_MONTH from patients.`date_time`) = extract(YEAR_MONTH from '".date('y-m-d',strtotime($_POST['year']))."') group by extract(YEAR_MONTH from patients.`date_time`)");

	$ReviewsTotal = $Reviewed = $NotReviewed = $Datename = array();
	while($TotalAllfeedbacks = mysql_fetch_array($Allfeedbacks))
	{
		$Datename[] = date('d-m-y',strtotime($TotalAllfeedbacks['monthyear']));
		$TotalAllfeedbacks['total'];
		$ReviewsTotal[] =  $TotalAllfeedbacks['total'];
	}
	
	$AllReviewedfeedbacks = mysql_query("SELECT extract(YEAR_MONTH from patients.`date_time`) as monthyear,count(*) as total FROM feedbacks_".$_POST['group_id']." join patients on feedbacks_".$_POST['group_id'].".patient_id = patients.id 
	JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_".$_POST['group_id'].".id
	where feedback_reviews.groups_id = ".$_POST['group_id']."  and extract(YEAR_MONTH from patients.`date_time`) = extract(YEAR_MONTH from '".date('y-m-d',strtotime($_POST['year']))."') group by extract(YEAR_MONTH from patients.`date_time`)");							
	$i = 0;
	while($Reviewedfeedbacks = mysql_fetch_array($AllReviewedfeedbacks))
	{
		$Reviewedfeedbacks['monthyear'];
		$Reviewed[] = $Reviewedfeedbacks['total'];
		$NotReviewed[$i] = $ReviewsTotal[$i] - $Reviewed[$i];
		$i++;
	} 
	
	//Reviewed and Raised 
	
	$Allreviewed = mysql_query("SELECT extract(YEAR_MONTH from patients.`date_time`) as monthyear,count(*) as total FROM feedbacks_".$_POST['group_id']." join patients on feedbacks_".$_POST['group_id'].".patient_id = patients.id 
		JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_".$_POST['group_id'].".id
		where  feedback_reviews.groups_id = ".$_POST['group_id']." and feedback_reviews.review = 1 and extract(YEAR_MONTH from patients.`date_time`) = extract(YEAR_MONTH from '".date('y-m-d',strtotime($_POST['year']))."') group by extract(YEAR_MONTH from patients.`date_time`)");
	$AllReviewsTotal = $RaisedReviewed = $NotRaisedReviewed = $RaisedDatename = array();
	while($Totalreviewedfeedbacks = mysql_fetch_array($Allreviewed))
	{
		$RaisedDatename[] = date('d-m-y',strtotime($Totalreviewedfeedbacks['monthyear']));
		$Totalreviewedfeedbacks['total'];
		$AllReviewsTotal[] =  $Totalreviewedfeedbacks['total'];
	}
	$AllRaisedreviewsfeedbacks = mysql_query("SELECT extract(YEAR_MONTH from patients.`date_time`) as monthyear,count(*) as total FROM feedbacks_".$_POST['group_id']." join patients on feedbacks_".$_POST['group_id'].".patient_id = patients.id 
	JOIN feedback_reviews on feedback_reviews.feedbackid = feedbacks_".$_POST['group_id'].".id
	where  feedback_reviews.groups_id = ".$_POST['group_id']."  and feedback_reviews.review = 1 and feedback_reviews.ticket_no != '' and extract(YEAR_MONTH from patients.`date_time`) = extract(YEAR_MONTH from '".date('y-m-d',strtotime($_POST['year']))."') group by extract(YEAR_MONTH from patients.`date_time`)");							
	$i = 0;
	while($RaisedReviewedfeedbacks = mysql_fetch_array($AllRaisedreviewsfeedbacks))
	{
		$RaisedReviewedfeedbacks['monthyear'];
		$RaisedReviewed[] = $RaisedReviewedfeedbacks['total'];
		$NotRaisedReviewed[$i] = $AllReviewsTotal[$i] - $RaisedReviewed[$i];
		$i++;
	}
	
?>

	<table class='paginate sortable full'>
		<tr>
			<td>
				<thead align='left'>
					<th>Month</th>
					<th>FeedbackCount</th>
					<th>Feedback Reviewed</th>
					<th>Feedback NotReviewed</th>
					<th>Ticket Raised</th>
				</thead>
			</td>
		</tr>
		<tr>
			<?php if($monthname[0] == '') 
				echo '<td colspan="5" align="center" style="color:red">No Data Found</td>';
			?>
			<td><?php echo $monthname[0]; ?></td>
			<td><?php echo $feedbackcountvalues[0]; ?></td>
			<td><?php echo $Reviewed[0]; ?></td>
			<td><?php echo $NotReviewed[0]; ?></td>
			<td><?php echo $RaisedReviewed[0]; ?></td>
		</tr>
	</table>
	<table class='paginate sortable full'>
		<tr>
			<td>
				<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
			</td>

			
			<td>
				<div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			</td>
			
			<td>
				<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
			</td>
		</tr>
	</table>
<?php 
}
?>
<script>
	
$(function () {
		$('#container').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: '<?php echo $surveycategoryname['name'];?> Monthly FeedbackCount'
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
	
$(function () {
		$('#container1').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: '<?php echo $surveycategoryname['name'];?> Monthly Feedback Review Count'
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
				data: [<?php echo implode(",", $Reviewed); ?>]
			}, {
				name: 'Not Reviewed',
				data: [<?php echo implode(",", $NotReviewed); ?>]
			}]
		});
	});
	
	$(function () {
		$('#container2').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: '<?php echo $surveycategoryname['name'];?> Monthly Feedback Ticket Raised'
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
					color: '#6CABE7',
					data: [<?php echo implode(",", $RaisedReviewed); ?>]
				}, {
					name: 'Not Reviewed',
					color: '#434348',
					data: [<?php echo implode(",", $NotReviewed); ?>]
				}]
		});
	});
</script>	

<script src="includes/Highcharts-4.0.3/js/highcharts.js"></script>
<script src="includes/Highcharts-4.0.3/js/modules/exporting.js"></script>				