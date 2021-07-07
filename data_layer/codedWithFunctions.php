<?php

	//Roberto Ramos
	
	//This file contains helper functions that will help with detecting if a webpage uses
	//the desired resources

	//This function gets all the DB entries
	/////////////////////////////////////////////////////////////////////////////////////////////////////////

	//Get the last updat date for a URL
	function getLastUpdate($url, &$found_date) {
	
		//echo $url . "<br/><br/><br/><br/>";
	
		//Try to get the date when this URL was last modified
		$headers = get_headers($url);
		
		if (isset($headers['Last-Modified']) && trim($headers['Last-Modified']) != "") {
		
			//Now figure out if the date is actually newer than 32 years (just to see if it is real)
			
			//Convert them to timestamps.
			$date1Timestamp = strtotime($headers['Last-Modified']);
			$date2Timestamp = strtotime("now");
 
			//Calculate the difference.
			$difference = $date2Timestamp - $date1Timestamp;			
			$differenceYears = floor($difference/(365*24*60*60));
			
			if ($differenceYears <= 32) {

				$found_date = true;
				
				return date("Y-m-d H:i:s", strtotime($headers['Last-Modified']));
			
			} 
			
		}		

		$found_date = false;
		
		return date("Y-m-d H:i:s");

	}
	
	
	//Create the Simple HTML DOM object
	function getSimpleHTML($url) {

		$curl = curl_init();
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Keep-Alive: 300";
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$header[] = "Accept-Language: en-us,en;q=0.5";
		$header[] = "Pragma: "; 
		curl_setopt($curl, CURLOPT_URL, $url);
	//	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');
	//	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9');
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, true);

		$curl_html = curl_exec($curl);
	
		curl_close($curl);

//		echo $url . "<br/><br/><br/><br/>";
//		echo "<xmp>" . $curl_html . "</xmp><br/><br/><br/><br/>";

		//Load the HTML	
		$html = str_get_html($curl_html);

		if (isset($curl_html) && trim($curl_html) != "" && is_object($html))
			return $html;
			
		return false;
	
	}


	//Create the Simple HTML DOM object
	function getHTML($url) {
	
		$curl = curl_init();
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Keep-Alive: 300";
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$header[] = "Accept-Language: en-us,en;q=0.5";
		$header[] = "Pragma: "; 
		curl_setopt($curl, CURLOPT_URL, $url);
	//	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');
	//	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9');
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt ($curl, CURLOPT_FOLLOWLOCATION, true);

		$curl_html = curl_exec($curl);
	
		curl_close($curl);

//		echo $url . "<br/><br/><br/><br/>";
//		echo $curl_html . "<br/><br/><br/><br/>";

		if (isset($curl_html))
			return $curl_html;
			
		return "";
	
	}

	
	//Check if a given URL uses ConvertKit
	function usesConvertKitCheck($html) {
	
		//We're looking for this:
		/*

			<script src="https://assets.convertkit.com/assets/CKJS4.js?v=21"></script>

			Or

			<script async id="_ck_406739" src="https://forms.convertkit.com/406739?v=7"></script>
			
			Or
			
			<a href="https://app.convertkit.com/landing_pages/333072?v=7" target="_&quot;blank&quot;" rel="nofollow">
		
		*/

		if ($html !== false && is_object($html)) {
					
			//////////////////////////////////////////////////////////////////////////////////
		
			//Get all of the scripts
			$scripts = $html->find('script');
		
			//Now loop through the scripts
			foreach($scripts as $script) {
		
				//Find out if the page is using ConvertKit
				if(strpos($script->src, 'assets.convertkit.com') !== false || strpos($script->src, 'forms.convertkit.com') !== false) {
			
					return true;
				
				}
			
			}

			//////////////////////////////////////////////////////////////////////////////////
		
			//Now get all of the links
			$links = $html->find('a');
		
			//Now loop through the scripts
			foreach($links as $link) {
		
				//Find out if the page is using ConvertKit
				if(strpos($link->href, 'app.convertkit.com') !== false) {
			
					return true;
				
				}
			
			}
		
			//////////////////////////////////////////////////////////////////////////////////
		
		}
		
		return false;
	
	}


	//Check if a given URL uses Hotjar
	function usesHotjarCheck($html) {
	
		//We're looking for this:
		/*

			<script>
				(function(h,o,t,j,a,r){
					h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
					h._hjSettings={hjid:880484,hjsv:6};
					a=o.getElementsByTagName('head')[0];
					r=o.createElement('script');r.async=1;
					r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
					a.appendChild(r);
				})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
			</script>
			
			Or
			
			A script that loads Hotjar
		
		*/

		if ($html !== false && is_object($html)) {
					
			//////////////////////////////////////////////////////////////////////////////////
		
			//Get all of the scripts
			$scripts = $html->find('script');
		
			//Now loop through the scripts
			foreach($scripts as $script) {
			
				//Find out if the page is using Hotjar
				if(strpos($script->innertext, 'static.hotjar.com') !== false) {
			
					return true;
				
				}
			
			}

			//////////////////////////////////////////////////////////////////////////////////
							
		}
		
		return false;
	
	}


	//Check if a given URL uses Fomo
	function usesFomoCheck($html) {
	
		//We're looking for this:
		/*

			<script type="text/javascript" src="https://www.usefomo.com/api/v1/0EqtvteNjGJxcfJ4k3XIKA/load.js" async></script>

			Or

			<script>(function() {
			  function asyncLoad() {
				var urls = ["\/\/productreviews.shopifycdn.com\/assets\/v4\/spr.js?shop=shop-bodylogicmd-com.myshopify.com","https:\/\/chimpstatic.com\/mcjs-connected\/js\/users\/41f1680f790bf80a6792c29da\/7bf9a65895f5865ccf1312e34.js?shop=shop-bodylogicmd-com.myshopify.com","https:\/\/chimpstatic.com\/mcjs-connected\/js\/users\/41f1680f790bf80a6792c29da\/7bf9a65895f5865ccf1312e34.js?shop=shop-bodylogicmd-com.myshopify.com","https:\/\/www.usefomo.com\/api\/v1\/2PHvVg1lA4Iy81kvnFuUuA\/load.js?shop=shop-bodylogicmd-com.myshopify.com","https:\/\/cdn.shopifycloud.com\/messenger_commerce\/assets\/new_message_us?version=1519746181\u0026page_id=43921494813\u0026color=blue\u0026size=xlarge\u0026position_horizontal=right\u0026position_vertical=bottom\u0026messenger_app_id=1163199097047119\u0026shop=shop-bodylogicmd-com.myshopify.com","https:\/\/product-kits-cdn.spicegems.com\/assets\/js\/scriptTags.js?v=001dfhjfhfjhhfjdfewqpt\u0026shop=shop-bodylogicmd-com.myshopify.com","https:\/\/shopify.intercom.io\/widget.js?shop=shop-bodylogicmd-com.myshopify.com","https:\/\/www.orderlogicapp.com\/embedded_js\/production_base.js?1530627368\u0026shop=shop-bodylogicmd-com.myshopify.com"];
				for (var i = 0; i <urls.length; i++) {
				  var s = document.createElement('script');
				  s.type = 'text/javascript';
				  s.async = true;
				  s.src = urls[i];
				  var x = document.getElementsByTagName('script')[0];
				  x.parentNode.insertBefore(s, x);
				}
			  };
			  if(window.attachEvent) {
				window.attachEvent('onload', asyncLoad);
			  } else {
				window.addEventListener('load', asyncLoad, false);
			  }
			})();
			</script>
			
		*/

		if ($html !== false && is_object($html)) {
					
			//////////////////////////////////////////////////////////////////////////////////
		
			//Get all of the scripts
			$scripts = $html->find('script');
		
			//Now loop through the scripts
			foreach($scripts as $script) {
		
				//Find out if the page is using Fomo
				if(strpos($script->src, 'usefomo.com/api/') !== false || strpos($script->innertext, 'usefomo.com\/api') !== false || strpos($script->innertext, 'usefomo.com/api') !== false) {
			
					return true;
				
				}
			
			}

			//////////////////////////////////////////////////////////////////////////////////
		
		}
		
		return false;
	
	}



	//Check if a given URL uses PushCrew
	function usesPushCrewCheck($html) {
	
		//We're looking for this:
		/*

			<script type="text/javascript">
				(function(p,u,s,h){
					p._pcq=p._pcq||[];
					p._pcq.push(['_currentTime',Date.now()]);
					s=u.createElement('script');
					s.type='text/javascript';
					s.async=true;
					s.src='https://cdn.pushcrew.com/js/057ac91d5971b1b3dd2ea91430dc8ec1.js';
					h=u.getElementsByTagName('script')[0];
					h.parentNode.insertBefore(s,h);
				})(window,document);
			</script>

			Or

			<script type="text/javascript" async="" src="https://cdn.pushcrew.com/js/96cf2f47757044b73ea4dff12714f6da.js"></script>
			
		*/

		if ($html !== false && is_object($html)) {
					
			//////////////////////////////////////////////////////////////////////////////////
		
			//Get all of the scripts
			$scripts = $html->find('script');
		
			//Now loop through the scripts
			foreach($scripts as $script) {
		
				//Find out if the page is using Fomo
				if(strpos($script->src, 'cdn.pushcrew.com') !== false || strpos($script->innertext, 'cdn.pushcrew.com') !== false) {
			
					return true;
				
				}
			
			}

			//////////////////////////////////////////////////////////////////////////////////
		
		}
		
		return false;
	
	}



	//Check if a given URL uses MailChimp
	function usesMailChimpCheck($html) {
	
		//We're looking for this:
		/*

			mc-embedded-subscribe-form

			Or

			mce-EMAIL
			
		*/

		if ($html !== false && trim($html) != "") {
					
			//////////////////////////////////////////////////////////////////////////////////

			//Find out if the page is using MailChimp
			if(strpos($html, 'mc-embedded-subscribe-form') !== false || strpos($html, 'mce-EMAIL') !== false) {
		
				return true;
			
			}

			//////////////////////////////////////////////////////////////////////////////////
		
		}
		
		return false;
	
	}



	//Check if a given URL uses Yoast
	function usesYoastCheck($html) {
	
		//We're looking for this:
		/*

			<!-- This site is optimized with the Yoast SEO plugin v7.6.1 - https://yoast.com/wordpress/plugins/seo/ -->
			
			Or
			
			<!-- This site is optimized with the Yoast SEO Premium plugin v7.1.1 - https://yoast.com/wordpress/plugins/seo/ -->
			
			Or
			
			<!-- This site is optimized with the Yoast WordPress SEO plugin v1.7.4 - https://yoast.com/wordpress/plugins/seo/ -->

		*/

		if ($html !== false && trim($html) != "") {
					
			//////////////////////////////////////////////////////////////////////////////////

			//Find out if the page is using Yoast
			if(strpos($html, '<!-- This site is optimized with the Yoast') !== false) {
		
				return true;
			
			}

			//////////////////////////////////////////////////////////////////////////////////
		
		}
		
		return false;
	
	}



	//Check if a given URL uses All in One SEO Pack
	function usesAllInOneSEOCheck($html) {
	
		//We're looking for this:
		/*

			<!-- All in One SEO Pack 2.2.6.1 by Michael Torbert of Semper Fi Web Design[48,78] -->

		*/

		if ($html !== false && trim($html) != "") {
					
			//////////////////////////////////////////////////////////////////////////////////

			//Find out if the page is using All in One SEO Pack
			if(strpos($html, '<!-- All in One SEO Pack') !== false) {
		
				return true;
			
			}

			//////////////////////////////////////////////////////////////////////////////////
		
		}
		
		return false;
	
	}



	//Check if a given URL uses WP-Super-Cache
	function usesWPSuperCacheCheck($html) {
	
		//We're looking for this:
		/*

			<!-- Cached page generated by WP-Super-Cache on 2018-07-11 14:21:14 -->

		*/

		if ($html !== false && trim($html) != "") {
					
			//////////////////////////////////////////////////////////////////////////////////

			//Find out if the page is using WP-Super-Cache
			if(strpos($html, '<!-- Cached page generated by WP-Super-Cache') !== false) {
		
				return true;
			
			}

			//////////////////////////////////////////////////////////////////////////////////
		
		}
		
		return false;
	
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////

?>