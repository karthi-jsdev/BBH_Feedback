<?php 
	function Select_Groups()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM groups WHERE status=1 ORDER BY id");
	}
	function Select_Feedbacks()
	{
		return mysqli_query($_SESSION[$_SESSION['Prefix'].'connection'],"SELECT * FROM groups WHERE status=1 ORDER BY id");
	}
?>