<header id="page-header">
    <div class="wrapper">
		<div id="util-nav">		
			<ul>
				<?php
				if($_SESSION[$_SESSION['Prefix'].'role'])
					echo "<li>".$_SESSION[$_SESSION['Prefix'].'name']." logged in as ".str_replace("_", " ", $_SESSION[$_SESSION['Prefix'].'role'])." : <a href='includes/Logout.php'>Logout</a></li>";
				?>
            </ul>
        </div>
        <h1><?php echo $_SESSION[$_SESSION['Prefix'].'Client']; ?></h1>
        <div id="main-nav">
            <ul class="clearfix">
            	<?php
				if(!$_GET['page'])
					$_GET['page'] = "Dashboard";
				
				if($_SESSION[$_SESSION['Prefix'].'roleid'] <= 2)//Super Admin/Admin
					$headers = array("Dashboard", "Masters", "Feedback", "Reports", "Reviews");//, "Contact_Us"
				else//Other roles
					$headers = array("Quotation","Reports");
				
				for($i = 0; $i < count($headers); $i++)
				{
					$page = str_replace("_", " ", $headers[$i]);
					if($_GET['page'] == $headers[$i])
					{
						echo "<li class='active'><a href='?page=".$headers[$i]."'>";
						$currentpage = $page;
					}
					else
						echo "<li><a href='?page=".$headers[$i]."'>";
					echo $page."</a></li>";
				} ?>
            </ul>
        </div>
    </div>
	
    <div id="page-subheader">
        <div class="wrapper">
            <h2>
            	<?php
				if($_GET['page'] == "")
					echo "Dashboard";
				else
					echo $currentpage;
            	?>
            </h2>
        </div>
    </div>
</header>