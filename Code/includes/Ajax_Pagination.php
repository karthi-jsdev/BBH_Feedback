<ul class="pagination pagination-sm">					
	<?php
	if($_POST['CurrentPageNo'] > 1)
	{
		echo "<li><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",1)'>1</a></li>
		<li><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".($_POST['CurrentPageNo']-1).")'>&laquo;</a></li>";
	}
	
	if($_POST['total_pages'] <= 5)
	{
		if($_POST['total_pages'] > 1)
		{
			for($i = 1; $i <= $_POST['total_pages']; $i++)
			{
				if($i == $_POST['CurrentPageNo'])
					echo "<li class='active'><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				else
					echo "<li><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			}
		}
	}
	else
	{
		if($_POST['CurrentPageNo'] <= 3)
		{
			for($i = 1; $i <= 5; $i++)
			{
				if($i == $_POST['CurrentPageNo'])
					echo "<li class='active'><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				else
					echo "<li><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			}
		}
		else if($_POST['CurrentPageNo'] > 3 && $_POST['CurrentPageNo'] < ($_POST['total_pages']-2))
		{
			for($i = $_POST['CurrentPageNo']-2; $i <= ($_POST['CurrentPageNo']+2); $i++)
			{
				if($i == $_POST['CurrentPageNo'])
					echo "<li class='active'><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				else
					echo "<li><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
			}
		}
		else
		{
			if(($_POST['total_pages'] - $_POST['CurrentPageNo']) == 2)
				$limit = $_POST['CurrentPageNo']-2;
			else if(($_POST['total_pages'] - $_POST['CurrentPageNo']) == 1)
				$limit = $_POST['CurrentPageNo']-3;
			else if(($_POST['total_pages'] - $_POST['CurrentPageNo']) == 0)
				$limit = $_POST['CurrentPageNo']-4;
			for($i = $limit; $i <= $_POST['total_pages']; $i++)
			{
				if($i == $_POST['CurrentPageNo'])
					echo "<li class='active'><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li>";
				else
					echo "<li><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$i.")'>".$i."</a></li> ";
			}
		}
	}
	
	if($_POST['CurrentPageNo'] < $_POST['total_pages'])
	{
		echo "<li><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\", ".($_POST['CurrentPageNo']+1).")'>&raquo;</a></li>
		<li><a href='#' onclick='Ajax_Pagination(\"".$_POST['PaginationFor']."\",".$_POST['total_pages'].")'>".$_POST['total_pages']."</a></li>";
	}
	
	//If total pages > 5 then show the drop down also
	if($_POST['total_pages'] > 5)
	{
		echo "<select class='input-sm' onchange='Ajax_Pagination(\"".$_POST['PaginationFor']."\",this.value)'>";
			for($i = 1; $i <= $_POST['total_pages']; $i++)
				echo str_replace("='".$_POST['CurrentPageNo']."'", "='".$i."' selected", "<option value='".$i."'>".$i."</option>");
		echo "</select>";
	} ?>	
</ul>