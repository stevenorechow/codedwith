<?php

	// Roberto Ramos
	
	//This script checks the urls to see if they use some resources
	
	//////////////////////////////////////////////////////////////////////////////////

	//Imports
	include_once './data_layer/simple_html_dom.php'; //This is used to read HTML pages
	include_once './data_layer/codedWithFunctions.php'; //Functions for finding resources on HTML

	//////////////////////////////////////////////////////////////////////////////////////

	// Configuration /////////////////////////////////////////////////////////////////////	
	$debug = false;
	
	$now = date("Y-m-d H:i:s");
	//////////////////////////////////////////////////////////////////////////////////////
	
	//Get the URLs that we're checking
	$urls_input = explode("\n", str_replace("\r", "", strtolower(rawurldecode($_POST['urls']))));
	$urls = array();
		
	if ($debug) {

		echo "<pre>";
			print_r($urls_input);
		echo "</pre>";
	
	}

	foreach ($urls_input as $url) {

		if (filter_var($url, FILTER_VALIDATE_URL))
			$urls[] = $url;

	}

	if ($debug) {

		echo "<pre>";
			print_r($urls);
		echo "</pre>";
	
	}
	
	if (!$debug) {

		//Print out the XML
		//Set the XML stuff
		header('Content-Type: text/xml');
		header("Cache-Control: no-cache, must-revalidate");
		//A date in the past
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		/*echo '<?xml version="1.0" encoding="ISO-8859-1"?>';*/
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<results>';
	
	}
		
	foreach ($urls as $url) {
	
		set_time_limit(0);
		
		$host = parse_url($url, PHP_URL_HOST);

		//Create the Simple HTML Object
		$html_obj = getSimpleHTML($url);
		$html_host_obj = getSimpleHTML("http://" . $host);

		//Get the HTML strings
		$html_str = getHTML($url);
		$html_host_str = getHTML("http://" . $host);
		
		echo '<result>';
		
			echo '<url>';
				echo rawurlencode($url);
			echo '</url>';

			echo '<host>';
				echo rawurlencode($host);
			echo '</host>';

		

			//Check if the entry uses ConvertKit		
			echo '<ConvertKit>';
			if (usesConvertKitCheck($html_obj) || usesConvertKitCheck($html_host_obj))
				echo 1;
			else
				echo 0;
			echo '</ConvertKit>';



			//Check if the entry uses Hotjar	
			echo '<Hotjar>';
			if (usesHotjarCheck($html_obj) || usesHotjarCheck($html_host_obj))
				echo 1;
			else
				echo 0;
			echo '</Hotjar>';



			//Check if the entry uses Fomo		
			echo '<Fomo>';
			if (usesFomoCheck($html_obj) || usesFomoCheck($html_host_obj))
				echo 1;
			else
				echo 0;
			echo '</Fomo>';



			//Check if the entry uses PushCrew		
			echo '<PushCrew>';
			if (usesPushCrewCheck($html_obj) || usesPushCrewCheck($html_host_obj))
				echo 1;
			else
				echo 0;
			echo '</PushCrew>';



			//Check if the entry uses MailChimp
			echo '<MailChimp>';
			if (usesMailChimpCheck($html_str) || usesMailChimpCheck($html_host_str))
				echo 1;
			else
				echo 0;
			echo '</MailChimp>';
	


			//Check if the entry uses Yoast		
			echo '<Yoast>';
			if (usesYoastCheck($html_str) || usesYoastCheck($html_host_str))
				echo 1;
			else
				echo 0;
			echo '</Yoast>';



			//Check if the entry uses All in One SEO Pack
			echo '<AllInOneSEOPack>';
			if (usesAllInOneSEOCheck($html_str) || usesAllInOneSEOCheck($html_host_str))
				echo 1;
			else
				echo 0;
			echo '</AllInOneSEOPack>';



			//Check if the entry uses WP-Super-Cache		
			echo '<WPSuperCache>';
			if (usesWPSuperCacheCheck($html_str) || usesWPSuperCacheCheck($html_host_str))
				echo 1;
			else
				echo 0;
			echo '</WPSuperCache>';



		echo '</result>';
	
	}

	echo '</results>';

	//////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////
		
?>