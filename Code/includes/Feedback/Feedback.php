	<!-- DatePicker -->
	<link rel="stylesheet" type="text/css" href="includes/Date_Time_Picker/css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="includes/Date_Time_Picker/css/jquery-ui-timepicker-addon.css">

	<script src="includes/Date_Time_Picker/js/jquery.ui.core.js"></script>
	<script src="includes/Date_Time_Picker/js/jquery.ui.datepicker.js"></script>
	<script src="includes/Date_Time_Picker/js/jquery-1.9.1.min.js"></script>
	<script src="includes/Date_Time_Picker/js/jquery.ui.widget.js"></script>
	<script src="includes/Date_Time_Picker/js/jquery-ui.min.js"></script>
	<script src="includes/Date_Time_Picker/js/jquery-ui-timepicker-addon.js"></script>
	<script>
		$(function()
		{
			var startDateTextBox = $('#visit_date_time');
			startDateTextBox.datetimepicker(
			{
				showSecond: true,
				dateFormat: 'yy-mm-dd',
				timeFormat: 'HH:mm:ss'
			});
		});
	</script>
	<?php include("includes/".$_GET["page"]."/".$_GET["page"]."_Queries.php"); ?>
	<div class="panel" style='width:980px;'>
		<header><h2><i class="fa fa-bars"></i>Select Survey Category and then give your feedback</h2></header>
		<hr />
		<label>Survey Category <font color="red">*</font></label>&nbsp;&nbsp;
		<select onChange="SelectedGroup(this.value);">
			<option value="">Select</option>
			<?php
			$Groups = Select_Groups();
			while($Group = mysql_fetch_array($Groups))
			{
				if($Group['id'] == $_GET['group_id'])
					echo '<option value="'.$Group['id'].'$'.$Group['prefix'].'"  selected>'.$Group['name'].'</option>';
				else
					echo '<option value="'.$Group['id'].'$'.$Group['prefix'].'">'.$Group['name'].'</option>';
			} ?>
		</select>
	</div>
	
	<?php
	if($_GET['group_id'])
	{
		$_SESSION['group_prefix'] = $_GET['group_prefix'];
		?>
		<section role="main" id="main" style='width:980px;'>
			<?php
			$Modules = Select_Modules_By_DepartmentId();
			$_SESSION[$_SESSION['Prefix'].'Modules'][] = $_SESSION[$_SESSION['Prefix'].'Modules'] = array();
			$_SESSION[$_SESSION['Prefix'].'Module_Names'][] = $_SESSION[$_SESSION['Prefix'].'Module_Names'] = array();
			$_SESSION[$_SESSION['Prefix'].'Module_Answer_Ids'][] = $_SESSION[$_SESSION['Prefix'].'Module_Answer_Ids'] = array();
			$i = -1;
			$iTemp = $jTemp = $kTemp = "";
			while($Module = mysql_fetch_array($Modules))
			{
				if($iTemp != $Module['Id'])
				{
					$iTemp = $Module['Id'];
					++$i;
					$_SESSION[$_SESSION['Prefix'].'Modules'][$i][] = $Module['Id'];
					$_SESSION[$_SESSION['Prefix'].'Module_Names'][$i][] = $Module['name'];
					$_SESSION[$_SESSION['Prefix'].'Module_Answer_Ids'][$i][] = $Module['option_ids'];
					$_SESSION[$_SESSION['Prefix'].'Module_Answers'][$i][] = $Module['option_ids'];
				}
				if($Module['SEC_Id1'] && $jTemp != $Module['SEC_Id1'])
				{
					$jTemp = $Module['SEC_Id1'];
					$_SESSION[$_SESSION['Prefix'].'Modules'][$i][] = $Module['SEC_Id1'];
					$_SESSION[$_SESSION['Prefix'].'Module_Names'][$i][] = $Module['SEC_name1'];
				}
			} ?>
			
			<div class="columns" style='width:1004px;'>
				<?php echo $message; ?>
				<form method="post" class="form panel">
					<div id="Q0">
						<fieldset>
							<div class="clearfix">
								<label>
									Patient # <font color="red">*</font><br />
									<input type="text" id="patient_id" required="required" onkeypress="return isNumeric(event)" onblur="GetPatient(this.value)"/>
								</label>
								<label>
									Name <br />
									<!--input type="hidden" id="patient_id" required="required" /-->
									<input type="text" id="name"  onkeypress="return isAlphabetic(event)"/>
								</label>
								<label>
									Date <font color="red">*</font><br />
									<input type="text" id="date_time" required="required" value="<?php echo date("Y-m-d H:i:s"); ?>" readonly/>
								</label>
								<label>
									 Patient Type<font color="red">*</font><br />
									<input type="text" id="private_or_general" required="required"onkeypress="return isAlphabetic(event)"/>
								</label>
							</div>
							<div class="clearfix">
								<label>
									Telephone # <br />
									<input type="text" id="contact"  onkeypress="return isNumeric(event)"/>
								</label>
								<label>
									Email <br />
									<input type="text" id="email" />
								</label>
								<label>
									Service Available Department <font color="red">*</font><br />
									<input type="text" id="service_available_department" required="required" onkeypress="return isAlphabetic(event)"/>
								</label>
								<label>
									Visit Date <font color="red">*</font><br />
									<input type="text" id="visit_date_time" required="required"/>
								</label>
							</div>
						</fieldset>
					</div>
					<?php
					$QMainids = array();
					$Qids = array();
					for($i = 0;$i < count($_SESSION[$_SESSION['Prefix'].'Modules']); $i++)
					{
						echo "<div id='Q".($i+1)."' style='display:none;'><table class='paginate sortable full'>
						<header><h2>".($i+1).". ".$_SESSION[$_SESSION['Prefix'].'Module_Names'][$i][0].'</h2></header><hr />
						<thead><tr align="left">
						<th></th>';
						$Options = Select_Options_ByIds($_SESSION[$_SESSION['Prefix'].'Module_Answer_Ids'][$i][0]);
						while($Option = mysql_fetch_array($Options))
						{
							/* if($Option['id'] == 1)
								echo "<th></th>";
							else */
								echo "<th>".$Option['answer']."</th>";
						}
						echo "</tr></thead>";
						
						if(COUNT($_SESSION[$_SESSION['Prefix'].'Modules'][$i]) != 1)
						{
							for($j = 1;$j < count($_SESSION[$_SESSION['Prefix'].'Modules'][$i]); $j++)
							{
								$Qids[$i+1] .= $_SESSION[$_SESSION['Prefix'].'Modules'][$i][$j].".";
								$Options = explode(",", $_SESSION[$_SESSION['Prefix'].'Module_Answer_Ids'][$i][0]);
								echo "<tr>
								<td>".$_SESSION[$_SESSION['Prefix'].'Module_Names'][$i][$j]."</td>";								
								foreach($Options as $Option)
								{
									$checked = "";
									if($Option == 14)
										$checked = "checked";
									echo "<td><input type='radio' name='".$_SESSION[$_SESSION['Prefix'].'Modules'][$i][$j]."' value='".$Option."' $checked></td>";
								}
								echo '<td id="displaytextbox'.$_SESSION[$_SESSION['Prefix'].'Modules'][$i][$j].'">
								<input type="text" value="" id="comment'.$_SESSION[$_SESSION['Prefix'].'Modules'][$i][$j].'" placeholder="Comments"/>
								</td>';
								echo "</tr>";
							}
						}
						else
						{
							$QMainids[] = $_SESSION[$_SESSION['Prefix'].'Modules'][$i][0];
							echo '<tr><td colspan="2"><textarea id="'.$_SESSION[$_SESSION['Prefix'].'Modules'][$i][0].'" style="width:90%;"></textarea></td></tr>';
						}
						$Qids[$i+1] = substr($Qids[$i+1], 0, strlen($Qids[$i+1])-1);
						echo "</table><br /></div>";
					} ?>
					<hr />
					<a style="display:none" href="#" id="Previous" class="button button-orange" onclick="Actions('GetPrevValues', '')">Previous</a>&nbsp;&nbsp;
					<a href="#" id="WizardBt" class="button button-blue" onclick="Actions('GetValues', '')">Next</a>&nbsp;&nbsp;<button class="button button-gray" id="Reset" type="reset">Reset</button>
				</form>
			</div>
			
			<div class="clear">&nbsp;</div>
			<?php
			$GETParameters = "page=".$_GET['page']."&subpage=".$_GET['subpage']."&";
			if($total_pages > 1)
				include("includes/Pagination.php");
			?>
		</section>
		<script>
			var DefaultKeyboardKeys = [8, 9, 35, 36, 37, 39, 46];
			function isAlphabetic(evt)
			{
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if(DefaultKeyboardKeys.indexOf(charCode) > -1 || charCode == 32)
					return true;
				else if(charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122)
					return true;
				else
					return false;
			}
			
			function isNumeric(evt)
			{
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if([8, 9, 45, 46, 47].indexOf(charCode) > -1)
					return true;
				if(charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
			}
			
			/* function mail(id)
			{
				var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if(re.test($("#"+id).val()) == false)
					document.getElementById(id).focus();
				return true;
			} */
			var Next = 0, QMainids = new Array(), QIds = new Array(<?php echo $i;?>), patient_id, Params = Array(), Values = Array(), Comments = "";
			QIds[0] = new Array("name", "private_or_general", "contact", "email", "service_available_department", "visit_date_time");
			<?php
			for($j = 0; $j < COUNT($QMainids); $j++)
				echo "QMainids[".$j."]=".$QMainids[$j].";";
			for($j = 1; $j <= $i; $j++)
				echo "QIds[".$j."]='".$Qids[$j]."'.split('.');";
			?>
			var IsValidPatient = 0;
			Actions("Select_Patient", '');
			$("#Q0").show();
			function Actions(Action, Id)
			{
				switch(Action)
				{
					case "GetValues":
						 if(!Next)
							IsValidPatient = validation();
						 if(IsValidPatient)
						{
						 	var status = true;
							//if(Next && (typeof QId != 'undefined'))
							if(Next && QIds[Next].length > 1)
							{
								QIds[Next].forEach(function(QId)
								{
									if(!$("input[type='radio'][name="+QId+"]:checked").length)
										status = false;
								});
							}
							if(status)
							{ 
								QIds[Next].forEach(function(QId)
								{
									Params.push(QId);
									if(Next == 0)
									{
										var AnswerId = $('#'+QId).val();
										Values.push(AnswerId);
									}
									else
									{
										if($('input[name='+QId+']:checked').val())
										{
											var AnswerId = $('input[name='+QId+']:checked').val();
											Values.push(AnswerId);
										}
										else
											Values.push("");
									}
									if($("#comment"+QId).val())
										Comments += ".,'"+QId+"','"+$("#comment"+QId).val()+"'";
								});
								
								if(Next == 0 || Next == <?php echo $i;?>)
								{
									Actions("Insert", Id);
									Comments = [];
									Params = [];
									Values = [];
								}
								if(Next+1 == <?php echo $i;?>)
								{
									$("#WizardBt").html("Review");
								}	
								else
									$("#WizardBt").html("Next");
								$("#Q"+Next).hide();
								if(Next != <?php echo $i;?>)
									$("#Q"+(Next+1)).show();
								else
								{
									Next = -1;
									$("#Q0").show();
									document.getElementById('Reset').click();
									//alert("Submitted successfully. Thank you.");
									window.location.assign("index.php?page=<?php echo $_GET['Module']."/".$_GET['Module']; ?>_Summary&group_id=<?php echo $_GET['group_id']; ?>");
									//var Response = Ajax("GET", "includes/<?php echo $_GET['Module']."/".$_GET['Module']; ?>_Summary.php", "group_id=<?php echo $_GET['group_id']; ?>");
									//alert(Response);
								}
								Next++;
							  }
							else 
								alert("Please select an option for each question"); 
						} 
						
						if(Next > 0 && Next != <?php echo $i;?>)
							$("#Previous").show();
					break;
					
					case "GetPrevValues":
							if(Next == 1)
								$("#Previous").hide();
							$("#Q"+Next).hide();
							if(Next <= <?php echo $i;?>)
							{
								$("#Q"+(Next-1)).show();
							}	
							else
							{
								Next = -1;
								$("#Q0").show();
								document.getElementById('Reset').click();
							}
							Next--;
							if(Next+1 >= <?php echo $i;?>)
								$("#WizardBt").html("Next");
					 break;
					
					case "Insert":
						var UserQsAndAnswers ="&UserQsAndAnswers=";
						if(Next)
						{
							QMainids.forEach(function(QId)
							{
								UserQsAndAnswers += "'"+QId+"','"+$("#"+QId).val()+"'#$";
							});
						}
						else
							UserQsAndAnswers="";
						date_time = $("#date_time").val();
						var Response = Ajax("POST", "includes/<?php echo $_GET['Module']."/".$_GET['Module']; ?>_Actions.php", "Module=<?php echo $_GET['Module'];?>&Action="+Action+"&group_id=<?php echo $_GET['group_id']; ?>&patient_id="+$("#patient_id").val()+"&date_time="+date_time+"&Params="+Params.join("$#")+"&Values="+Values.join("$#")+"&Comments="+Comments+UserQsAndAnswers).split("$");
						if(Response.length > 1)
						{
							$("#name").val("");
							$("#<?php echo $_GET['Module']; ?>_Count").html(Response[1]);
							$("#<?php echo $_GET['Module']; ?>_Data").html(Response[2]);
							$("#AjaxPagination").html(Response[3]);
						}
					break;
					/* 
					case "Select_Patient":
						//var Response = Ajax("POST", "includes/<?php echo $_GET['Module']."/".$_GET['Module']; ?>_Actions.php", "Module=<?php echo $_GET['Module'];?>&Action="+Action+"&group_id="+Id+"&Params="+Params.join(".")+"&Values="+Values.join(".")).split("$");
						patient_id = 2;
					break; */
				}
			}
			function GetPatient(patientno)
			{
				var Responses = Ajax("POST","includes/<?php echo $_GET['Module']."/".$_GET['Module']?>_Patient.php","patientno="+patientno); 
				var Ids = Array("#name", "#private_or_general", "#contact", "#email", "#service_available_department", "#visit_date_time"), i = 0;
				if(Responses)
				{
					var Response = Responses.split('#')
					Ids.forEach(function(Id)
					{
						$(Id).val(Response[i++]);
						$(Id).prop('disabled', true);
					});
				}
				else
					Ids.forEach(function(Id)
					{
						$(Id).val("");
						$(Id).prop('disabled', false);
					});	
					
			}
			function validation()
			{
				var message = "";
				if($("#visit_date_time").val() == "")
					message = "Please enter visit date";
				if($("#service_available_department").val() == "")
					message = "Please enter service available department";
				if($("#private_or_general").val() == "")
					message = "Please enter patient type";	
				if($("#hospital_no").val() == "")
					message = "Please enter hospital number";	
				if(message)
				{
					alert(message);
					return false;
				}	
				return true;
			} 
			function Ajax(Type, URL, URLData)
			{
				var Responses = "";
				$.ajax(
				{
					type: Type,
					async: false,
					cache: false,
					url: URL,
					data: URLData,
					dataType: 'html',
					success: function(Response)
					{
						Responses = Response;
					}
				});
				return Responses;
			}
		</script>
	<?php
	} ?>
	<script>
		function SelectedGroup(GroupIdAndPrefix)
		{
			var Group = GroupIdAndPrefix.split('$');
			if(!GroupIdAndPrefix)
				window.document.location.href='index.php?page=<?php echo $_GET['page'];?>';
			else
				window.document.location.href='index.php?page=<?php echo $_GET['page'];?>&group_id='+Group[0]+'&group_prefix='+Group[1];
		}
		
	</script>