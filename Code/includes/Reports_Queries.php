<?php 
	function Select_Groups()
	{
		return mysql_query("SELECT * FROM groups WHERE status=1 ORDER BY id");
	}
	function Select_Feedbacks()
	{
		return mysql_query("SELECT * FROM groups WHERE status=1 ORDER BY id");
	}
?>