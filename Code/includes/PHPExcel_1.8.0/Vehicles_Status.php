<?php
require("Config.php");
require($_GET['Module']."_Queries.php");
?>
<link rel="stylesheet" type="text/css" href="css/status-buttons.css" />
<div class="container">
	<div class="row">
		<div id="content" class="col-lg-12">
			<!-- PAGE HEADER-->
			<div class="row">
				<div class="col-sm-12">
					<div class="page-header">
						<ul class="breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="#" onclick="Module('Dashboard@Dashboard')">Home</a>
							</li>
							<li><?php echo str_replace("_"," ", $_GET['MainModule'])." / "; echo $ModuleName = str_replace("_"," ", $_GET['Module']);?></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<?php
						$_SESSION['Filter'] = Array("Module" => $ModuleName, "MultipleDevice" => "", "StartAndEndDate" => 1,
						"MoreFields" => Array('<div class="form-group">
							<label class="control-label" for="devices">Error Type<font color="red">*</font></label><br />
							<select multiple="multiple" id="type" size="type" style="height:80px;font-size:12px;color:#666666;">
								<option disabled>Choose a Type</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>
						</div>'));
						require("Filters/Filters.php");
						?>
						
						<div class="box border purple">
							<div class="box-title">
								<h4><i class="fa fa-table"></i><?php echo $ModuleName;?>  Report :&nbsp;<h4 id="<?php echo $_GET['Module']; ?>_Count"></h4></h4>
								<div class="tools">
									<a href="#" class="btn" onclick="Actions('Export', '');">Export</a>
								</div>
							</div>
							<div class="box-body">
								<center id="<?php echo $_GET['Module']; ?>_Loading" style="display:none;width:100%;background:rgba(255,255,255,0.8);border-radius:10px;position:absolute;">Loading . . . <img src="img/loaders/8.gif" style="width:20px;height:20px;"/></center>
								<table id="Filter_Data" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>S.No.</th>
											<th>Vehicle(Id)</th>
											<th>Date Time</th>
											<th>Information</th>
											<th>Error Type</th>
											<th>Pre Error Code</th>
											<th>Error Code</th>
										</tr>
									</thead>
									<tbody id="<?php echo $_GET['Module']; ?>_Data"></tbody>
								</table>
								<div id="AjaxPagination" style="float:right;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="separator"></div>
		</div>
	</div>
</div>
<script>
	function Ajax_Pagination(PaginationFor, CurrentPageNo)
	{
		if(!$("#type").val())
			alert("Select type");
		else
		{
			$("#<?php echo $_GET['Module']; ?>_Loading").show();
			$("#<?php echo $_GET['Module']; ?>_Loading").css('height',$("#Filter_Data").innerHeight()+10);
			var ParamAndValues = "&deviceId="+$("#deviceId").val()+"&type="+$("#type").val()+"&startdate="+$("#startdate").val()+"&enddate="+$("#enddate").val();
			var Response = Ajax("POST", "includes/Reports/<?php echo $_GET['Module']; ?>_Actions.php", "Module=<?php echo $_GET['Module'];?>&Action=AjaxPagination&PaginationFor="+PaginationFor+"&CurrentPageNo="+CurrentPageNo+ParamAndValues).split('$');
			if(Response.length > 0)
			{
				$("#<?php echo $_GET['Module']; ?>_Loading").hide();
				$("#<?php echo $_GET['Module']; ?>_Count").html(Response[0]);
				$("#<?php echo $_GET['Module']; ?>_Data").html(Response[1]);
				$("#AjaxPagination").html(Response[2]);
			}
		}
	}
	
	function Actions(Action, Id)
	{
		switch(Action)
		{
			case "Filter_Submit":
				Ajax_Pagination("AjaxPagination", 1);
			break;
			case "Export":
				$("#<?php echo $_GET['Module']; ?>_Loading").show();
				$("#<?php echo $_GET['Module']; ?>_Loading").css('height',$("#Filter_Data").innerHeight()+10);
				$.post('includes/Reports/<?php echo $_GET['Module']; ?>_Actions.php', {Action: "Export", Module:"<?php echo $_GET['Module']; ?>", deviceId:$("#deviceId").val(), type:$("#type").val().join(), startdate:$("#startdate").val(), enddate:$("#enddate").val()}, function(result)
				{
					window.open("includes/Reports/Export/"+result, 'popUpWindow','height=400, width=650, left=300, top=100, resizable=yes, scrollbars=yes, toolbar=yes, menubar=no, location=no, directories=no, status=yes');
					$("#<?php echo $_GET['Module']; ?>_Loading").hide();
				});
			break;
		}
	}
</script>