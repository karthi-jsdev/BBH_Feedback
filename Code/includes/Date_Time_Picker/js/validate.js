$(".contactform").validate({
								rules: {
									 Name: {
											required: true
												 },
									 Email:{
											required:true,
											email:true
												 },
									 Phone: {
											required: true	
												 },
									 Experience: {
											required: true	
									       },
									 Skills: {
											required: true	
									       },
									 Resume:{
										 required: true,
										 extension: "txt|docx|pdf"
									       },
												 
											},
										messages: {
											Name: "Enter Your Name",
											Email:"Enter a valid email Id",
											Phone:"Enter Your phone no.",
											Experience:"Enter Your Experience.",
											Skills:"Enter Your Skills.",
											Resume: {required: "Select Your Resume",  
											extension: "Allower file types are .docx / .pdf / .txt only"}
									 },
									 submitHandler: function() {
											var Name       = $('#Name').val();
											var Email      = $('#Email').val();
											var Phone      = $('#Phone').val();
											var Experience = $('#Experience').val();
											var Skills     = $('#Skills').val();
											var Resume     = $('#Resume').val();
											var Message    = $('#Message').val();
									$.ajax({
												type: "POST",
												url: 'sendmail2.php',
												data: 'Name='+Name+'&Email='+Email+'&Phone='+Phone+'&Experience='+Experience+'&Skills='+Skills+'&Resume='+Resume+'&Message='+Message,
												success: function(data) {									
											 $('.msg').html(data);
												},
												error: function(e) {
													alert("Error");
												}
											});
									}
					
							 });