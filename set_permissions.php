<?php

	//Roberto Ramos
	//This file sets the permissions to "0755" for all of the files & folders in this folder

	chmod_r("./");

	function chmod_r($path) {
		$dir = new DirectoryIterator($path);
		foreach ($dir as $item) {
		
			$curr_name = end(explode("/", $item->getPathname()));
			
			if ($curr_name != '.' && $curr_name != '..' && $curr_name != '.DS_Store') {

				if ($item->isDir() && !$item->isDot())
					chmod($item->getPathname(), 0755);
				else
					chmod($item->getPathname(), 0644);

				//echo $item->getPathname() . "<br/>";

			}

			if ($item->isDir() && !$item->isDot()) {
				chmod_r($item->getPathname());
			}
		}
	}

?>
