<?php
	session_start();
	ini_set("display_errors", "0");
	date_default_timezone_set('Asia/Kolkata');
	$_SESSION['Prefix'] = "BBHFeedback";
	$_SESSION[$_SESSION['Prefix'].'Client'] = "BBH Feedback";
	require("includes/Config.php");
	if(!$_SESSION[$_SESSION['Prefix'].'id'])
		header("Location:Login.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title><?php echo $_SESSION[$_SESSION['Prefix'].'Client']; ?></title>
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" media="screen" href="css/reset.css" />
		<link rel="stylesheet" media="screen" href="css/style.css" />
		<link rel="stylesheet" media="screen" href="css/messages.css" />
		<link rel="stylesheet" media="screen" href="css/forms.css" />
		<link rel="stylesheet" media="screen" href="css/uniform.aristo.css" />
		<link rel="stylesheet" media="screen" href="css/tables.css" />
		<link rel="stylesheet" media="screen" href="css/visualize.css" />
		<link rel="stylesheet" media="screen" href="css/action-buttons.css" />

		<!-- jquerytools -->
		<script src="js/jquery.tools.min.js"></script>
		<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
		<script src="js/visualize.jQuery.js"></script>
		<script type="text/javascript" src="js/global.js"></script>
	</head>

	<body>
		<div id="wrapper">
			<?php require("includes/Header.php"); ?>
			<section id="content">
			    <div class="wrapper">
					<?php
						//Main Section
						if($_SESSION[$_SESSION['Prefix'].'id'] && $_GET['page'])
						{
							$filename = "includes/".$_GET['page'].".php";
							if(file_exists($filename))
								require($filename);
							else
								echo "Don't try to visit this website anonymously..!";
							/*//Sidebar
							if(($filename != "includes/Complaint_Status.php") && ($filename != "includes/Reports.php"))
								require("includes/Sidebar.php");
							*/
						}
						else
							require("includes/Dashboard.php");
					?>
					<div class="clear"></div>
			    </div>
			    <div id="push"></div>
			</section>
		</div>
		<?php require("includes/Footer.php"); ?>
	</body>
</html>