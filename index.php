<?php

	// Roberto Ramos

	//////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Roberto Ramos">

	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">

    <title>CodedWith Lite</title>

	<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">


    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	<style type="text/css">
	
		.no_show { display: none; }

		.accordion-inner {padding-bottom:60px;} /* add padding on bottom sut incase*/ 

		.accordion-group {margin-bottom:8px; border:1px #ccccc;}
		.accordion-heading {background:#fcfcfc; border-radius:4px; margin:1px 1px 0 0 }

		#collapse_a_0 {font-size: 20px; text-align: center; font-weight: none;}
		#collapse_a_1 {font-size: 20px; text-align: center; font-weight: none;}
		#collapse_a_2 {font-size: 20px; text-align: center; font-weight: none;}
		#collapse_a_3 {font-size: 20px; text-align: center; font-weight: none;}

		#check_table td { border-right:2px solid #EEEEEE; border-left:2px solid #EEEEEE; border-bottom:2px solid #EEEEEE; text-align: center; padding: 10px 10px 10px 10px; }
		#check_table th { border-right:2px solid #EEEEEE; border-left:2px solid #EEEEEE; border-bottom:2px solid #EEEEEE; border-top:2px solid #EEEEEE; text-align: center; padding: 10px 10px 10px 10px; }

		#check_table tr td:nth-child(1) {
		   text-align: left;
		}

		.table_tr_selected {
			background-color: #F7F9F9;		  
		}

	</style>

	<script src="https://code.jquery.com/jquery-latest.js"></script>

    <script type="text/javascript" src="./data_layer/jquery.tablesorter.js"></script>

  </head>


  <body>
  
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid" style="background-color: #8564d4 !important;">
        <div class="navbar-header">
          <center><a class="navbar-brand" href="#" style="color: #FFFFFF !important;">CodedWith Lite</a></center>
        </div>
        <div class="navbar-collapse collapse">
        	<a class="navbar-brand" href="#" style="color: #FFFFFF !important; float: right;" id="status_msg"></a>
        </div>
      </div>
    </div>


	<br />
	
	<hr />


	<div id="check_div" style="width: 98%; margin: auto;">

		<div class="accordion" id="accordion_1">

			<div class="accordion-group" id="check_info">

				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" id="collapse_a_1" style="color: #8564d4;">
						<i class="fa fa-plus-circle"></i> CodedWith
					</a>
				</div>
				
				<div id="collapse_1" class="accordion-body collapse in"> <!-- add class "in" to make it open by default -->

					<div class="accordion-inner" id="collapse_inner_1">

						<div id="check_inner_div">

							<table border="0" style="margin-left: auto !important; margin-right: auto !important; width: 50%;">
		
								<tr style="text-align: center;">

									<td style="width: 100% !important;" colspan="2">
										<div class="input-group" style="width: 100% !important;">
											<span class="input-group-addon" style="text-align: center; width: 80px !important; height: 50px !important; font-size: 24px !important;">URLs <small>(One per line)</small>: </span> 
										</div>
									</td>

								</tr>

								<tr style="text-align: center;">

									<td style="width: 100% !important;" colspan="2">
										<div class="input-group" style="width: 100% !important;">
											<textarea type="text" class="form-control" style="height: 200px !important; font-size: 24px !important;" id="urls"></textarea>
										</div>
									</td>

								</tr>

								<tr style="text-align: center;">

									<td style="width: 100% !important;" colspan="2">

										<div style="text-align: center; display: block;">

											&nbsp;
											<button class="btn btn-info large" id="codedWithCheck" style="height: 50px; font-size: 20px; background-color: #8564d4; border-color: #8564d4; width: 100%;">
												CodedWith Check
											</button>
											&nbsp;

										</div>

									</td>

								</tr>
			
							</table>
							
							<br/>
							<br/>

							<table id="check_table" border="0" style="width: 100%;">

								<thead style="color: #8564d4 !important; font-size: 20px !important;" class="tablesorter">

									<th>URL</th>
									<th>ConvertKit</th>
									<th>Hotjar</th>
									<th>Fomo</th>
									<th>PushCrew</th>
									<th>MailChimp</th>
									<th>Yoast</th>
									<th>All in One SEO Pack</th>
									<th>WP Super Cache</th>
				
								</thead>
								<tbody id="check_table_body" style="font-size: 18px !important;">

								</tbody>

							</table>

						</div>

					</div>
			
				</div>
		
			</div>
	
		</div>

	</div>
	
	<hr/>






































    <!-- Bootstrap core JavaScript
    ================================================== -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"></script>

    
	<script type="text/javascript">

		var urls = [];
		var urls_ix = 0;
		var max_checks = 3;

		$(function () {

			$("#check_table").tablesorter();

			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////

			$('.accordion-toggle').click( function (e) {
			
				e.preventDefault();
				
				var id_arr = e.target.id.split("_");
				var accordion_id = id_arr[id_arr.length - 1];
				
				if ($("#collapse_" + accordion_id).is(":visible"))
					$("#collapse_" + accordion_id).hide('slow');
				else
					$("#collapse_" + accordion_id).show('slow');
				
			});

			//$("#collapse_1").hide('fast');

			//////////////////////////////////////////////////////////////////////////////

			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////

			$('#codedWithCheck').click(function (event) {
			
				var curr_urls = [];
				var ix = 0;

				urls = $('#urls').val().split('\n');
				urls_ix = 0;

				$('#urls').val("");
				$('#status_msg').html("");
				$('#check_table_body').html("");
				$("#check_table").trigger("update");

				$('body').css({'cursor':'progress'});
				
				do {
				
					curr_urls.push(urls[ix]);
					
					if ((ix + 1) % max_checks == 0 || (ix + 1) == urls.length) {
					
						codedWithCheck(curr_urls.join("\n"));
						curr_urls = [];
						
					}
					
					++ix;
				
				} while (ix < urls.length);
				
			});


			function codedWithCheck(curr_urls) {
			
				var postData = '';

				postData += "urls=" + encodeURIComponent(curr_urls);
				//postData += "&=" + encodeURIComponent($('#').val());

				//alert(postData);

				//Now Make the AJAX call
				var jqxhr = $.ajax({
						type: "POST",
						url: "check_coded_with.php",
						data: postData,
						async: true
				});				
				jqxhr.done(function(xml) { 
				
					var info = $(xml).find('results').children();
					var html_str = '';
					
					for (var ix = 0; ix < info.length; ++ix) {

						html_str += '<tr>';

							html_str += '<td>';
								html_str += '<a href="' + decodeURIComponent($(info[ix]).find('url').text()) + '" target="_blank">' + decodeURIComponent($(info[ix]).find('url').text()) + '</a>';
							html_str += '</td>';
						
							html_str += '<td>';
								if (decodeURIComponent($(info[ix]).find('ConvertKit').text()) == "1")
									html_str += '<span style="color: green; font-weight: bold;">Yes</span>';
								else
									html_str += '<span style="color: red; font-weight: none;">No</span>';
							html_str += '</td>';
							
							html_str += '<td>';
								if (decodeURIComponent($(info[ix]).find('Hotjar').text()) == "1")
									html_str += '<span style="color: green; font-weight: bold;">Yes</span>';
								else
									html_str += '<span style="color: red; font-weight: none;">No</span>';
							html_str += '</td>';

							html_str += '<td>';
								if (decodeURIComponent($(info[ix]).find('Fomo').text()) == "1")
									html_str += '<span style="color: green; font-weight: bold;">Yes</span>';
								else
									html_str += '<span style="color: red; font-weight: none;">No</span>';
							html_str += '</td>';

							html_str += '<td>';
								if (decodeURIComponent($(info[ix]).find('PushCrew').text()) == "1")
									html_str += '<span style="color: green; font-weight: bold;">Yes</span>';
								else
									html_str += '<span style="color: red; font-weight: none;">No</span>';
							html_str += '</td>';

							html_str += '<td>';
								if (decodeURIComponent($(info[ix]).find('MailChimp').text()) == "1")
									html_str += '<span style="color: green; font-weight: bold;">Yes</span>';
								else
									html_str += '<span style="color: red; font-weight: none;">No</span>';
							html_str += '</td>';

							html_str += '<td>';
								if (decodeURIComponent($(info[ix]).find('Yoast').text()) == "1")
									html_str += '<span style="color: green; font-weight: bold;">Yes</span>';
								else
									html_str += '<span style="color: red; font-weight: none;">No</span>';
							html_str += '</td>';

							html_str += '<td>';
								if (decodeURIComponent($(info[ix]).find('AllInOneSEOPack').text()) == "1")
									html_str += '<span style="color: green; font-weight: bold;">Yes</span>';
								else
									html_str += '<span style="color: red; font-weight: none;">No</span>';
							html_str += '</td>';

							html_str += '<td>';
								if (decodeURIComponent($(info[ix]).find('WPSuperCache').text()) == "1")
									html_str += '<span style="color: green; font-weight: bold;">Yes</span>';
								else
									html_str += '<span style="color: red; font-weight: none;">No</span>';
							html_str += '</td>';

						html_str += '</tr>';
						
					}
					
					//Update the display
					$('#check_table_body').append(html_str);

					$("#check_table").trigger("update");
					

					//Deal with updating the status message
					urls_ix += max_checks;

					if (urls_ix >= urls.length) {

						urls_ix = urls.length;

						//Clear and hide the appropriate stuff
						$('body').css({'cursor':'default'});

					}

					$('#status_msg').html(urls_ix + " URLs checked out of " + urls.length);



					$('#check_table tr').hover(function() {
						$(this).addClass('table_tr_selected');
					}, function() {
						$(this).removeClass('table_tr_selected');
					});
					
				});
			
			}

			//////////////////////////////////////////////////////////////////////////////
			//////////////////////////////////////////////////////////////////////////////

		});

	</script>
	
  </body>
</html>