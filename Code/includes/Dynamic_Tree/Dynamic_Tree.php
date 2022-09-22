<?php
	define("IN_PHP", true);
	require_once("common.php");
	$treeElements = $treeManager->getElementList(null, "manageStructure.php");
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="keywords"  content="" />
		<meta name="description" content="" />
		<link rel="stylesheet" type="text/css" href="js/jquery/plugins/simpleTree/style.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery/plugins/jquery.cookie.js"></script>
		<script type="text/javascript" src="js/jquery/plugins/simpleTree/jquery.simple.tree.js"></script>
		<script type="text/javascript" src="js/langManager.js" ></script>
		<script type="text/javascript" src="js/treeOperations.js"></script>
		<script type="text/javascript" src="js/init.js"></script>
	</head>
	<body>
		<div class="contextMenu" id="myMenu1">	
			<li class="addFolder"><img src="js/jquery/plugins/simpleTree/images/folder_add.png" /> </li>
			<li class="answerOptions"><img src="js/jquery/plugins/simpleTree/images/folder_edit.png" /> Add Answer options</li>
			<li class="addDoc"><img src="js/jquery/plugins/simpleTree/images/page_add.png" /> </li>	
			<li class="edit"><img src="js/jquery/plugins/simpleTree/images/folder_edit.png" /> </li>
			<!--li class="delete"><img src="js/jquery/plugins/simpleTree/images/folder_delete.png" /> </li-->
			<li class="expandAll" id="expandAll"><img src="js/jquery/plugins/simpleTree/images/expand.png"/> </li>
			<li class="collapseAll"><img src="js/jquery/plugins/simpleTree/images/collapse.png"/> </li>	
		</div>
		<div class="contextMenu" id="myMenu2">
			<li class="edit"><img src="js/jquery/plugins/simpleTree/images/page_edit.png" /> </li>
			<!--li class="delete"><img src="js/jquery/plugins/simpleTree/images/page_delete.png" /> </li-->
		</div>

		<div id="wrap">
			<div id="annualWizard">	
				<ul class="simpleTree" id='pdfTree'>		
					<li class="root" id='<?php echo $treeManager->getRootId(); ?>'><span><?php echo $rootName = $_SESSION['group_name']; ?></span>
						<ul><?php echo $treeElements; ?></ul>				
					</li>
				</ul>						
			</div>
		</div> 
		<div id='processing'></div>
	</body>
</html>
<link type="text/css" rel="stylesheet" href="../Window/jquery.windows-engine.css"/>
<script type="text/javascript" src="../Window/jquery.windows-engine.js"></script>
<script>
	$(function()
	{
		$('#expandAll').click();
		$(this).bind("contextmenu", function(e)
		{
			e.preventDefault();
		});
	});

	function Answer_Options(Question_Id)
	{
		$.post("../Masters_Actions.php?Action=Select_Answer_Ids&Question_Id="+Question_Id, function(Response)
		{
			if(Response)
			{
				$.newWindow({title:"Add Options ", content:"<form action='#' method='post'>"+Response+"<a href='#' onclick='Update_Question("+Question_Id+");'>Save</a></form>"});
			}
		});
	}

	function Update_Question(Question_Id)
	{
		var Option_Ids = [];
		$('input:checkbox[name=Option_Ids[]]:checked').each(function() 
		{
			Option_Ids.push($(this).val())
		})
		$.post("../Masters_Actions.php?Action=Update_Question&Question_Id="+Question_Id+"&Option_Ids="+Option_Ids, function(){}, true);
		$.closeAllWindows();
	}
	
	$(function()
	{
		$(':checkbox').change(function()
		{
			var Checked_Ids = [], Unchecked_Ids = [];
			if ($(this).attr('checked'))
				$(this).closest('li').find(':checkbox').attr('checked', 'checked');
			else
				$(this).closest('li').find(':checkbox').attr('checked', '');
			$(':checkbox').each(function()
			{
				var id = $(this).attr('id');
				var splitid = id.split("R");
				if ($(this).attr('checked'))
				  Checked_Ids.push(splitid[1]);
				else
				  Unchecked_Ids.push(splitid[1]);
			});
			if($(this).attr('checked')) 
				$.post("../Masters_Actions.php?Action=Update_Questions_Status1&Ids="+Checked_Ids+"&Flag="+$(this).attr('checked'), function(){}, true);
			else	
				$.post("../Masters_Actions.php?Action=Update_Questions_Status1&Ids="+Unchecked_Ids+"&Flag="+$(this).attr('checked'), function(){}, true);
			Checked_Ids = "";
			Unchecked_Ids = "";
		});
	});
	
	function toggleCheckbox(id, flag, slave)
	{
		var Checked_Ids = [];
		if(slave == 1)
		{
			Checked_Ids.push(id);
			$.post("../Masters_Actions.php?Action=Update_Questions_Status&Ids="+Checked_Ids+"&Flag="+flag, function(ParentId)
			{
				var SplittedResponse = ParentId.split("##");
				if(SplittedResponse[1] == 1)
					$("#R"+SplittedResponse[0]).attr("checked", "checked");
				else	
					$("#R"+SplittedResponse[0]).attr("checked", "");
			}, true);
		
		}
	}
</script>