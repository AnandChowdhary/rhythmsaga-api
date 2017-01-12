<?php

	$rss = "http://www.billboard.com/rss/charts/hot-100";
	$xml = simplexml_load_file($rss) or die("Error: Cannot create object");

	$things = array();

	for ($i = 0; $i < 100; $i++) {
	
		$songg = str_replace("", "", $xml -> channel -> item[$i] -> chart_item_title);
		$artistt = str_replace("Featuring", "ft.", $xml -> channel -> item[$i] -> artist);

		$things[$i][0] = $songg;
		$things[$i][1] = $artistt;

	}

	echo json_encode($things);

?>