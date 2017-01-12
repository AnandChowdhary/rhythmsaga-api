<?php

	$queryURL = "http://gdata.youtube.com/feeds/api/videos?q=" . urlencode($_GET["q"]) . "&max-results=3&v=2&alt=json";
	$ach = cURL_init();
	$timeout = 5;

	cURL_setOpt($ach, CURLOPT_URL, $queryURL);
	cURL_setOpt($ach, CURLOPT_RETURNTRANSFER, 1);
	curl_setOpt($ach, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	cURL_setOpt($ach, CURLOPT_CONNECTTIMEOUT, $timeout);

	$youHtml = cURL_exec($ach);
	$queryResult = json_decode($youHtml);
	$title = $queryResult -> feed -> entry[1] -> title -> {'$t'};
	$ytID = substr_replace(rtrim(substr($queryResult -> feed -> entry[1] -> content -> src, 25), "version=3&f=videos&app=youtube_gdata"), "", -1);
	$downloadLink = "http://youtubeinmp3.com/download/?video=http://www.youtube.com/watch?v=" . $ytID;

	$bch = cURL_init();
	cURL_setOpt($bch, CURLOPT_URL, $downloadLink);
	cURL_setOpt($bch, CURLOPT_RETURNTRANSFER, 1);
	curl_setOpt($bch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	cURL_setOpt($bch, CURLOPT_CONNECTTIMEOUT, $timeout);

	$html = cURL_exec($bch);
	cURL_close($bch);

	$dom = new DOMDocument();
	@$dom -> loadHTML($html);

	foreach($dom -> getElementsByTagName("a") as $link) {
		if(strpos($link -> getAttribute("href"), "download/grabber") !== false) {
			$next = $link -> getAttribute("href");
		}
	}

	if ($next == "") {

		$title = $queryResult -> feed -> entry[1] -> title -> {'$t'};
		$ytID = substr_replace(rtrim(substr($queryResult -> feed -> entry[1] -> content -> src, 25), "version=3&f=videos&app=youtube_gdata"), "", -1);
		$downloadLink = "http://youtubeinmp3.com/download/?video=http://www.youtube.com/watch?v=" . $ytID;

		$bch = cURL_init();
		cURL_setOpt($bch, CURLOPT_URL, $downloadLink);
		cURL_setOpt($bch, CURLOPT_RETURNTRANSFER, 1);
		curl_setOpt($bch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		cURL_setOpt($bch, CURLOPT_CONNECTTIMEOUT, $timeout);

		$html = cURL_exec($bch);
		cURL_close($bch);

		$dom = new DOMDocument();
		@$dom -> loadHTML($html);

		foreach($dom -> getElementsByTagName("a") as $link) {
			if(strpos($link -> getAttribute("href"), "download/grabber") !== false) {
				$next = $link -> getAttribute("href");
			}
		}

		if ($next == "") {

			$title = $queryResult -> feed -> entry[2] -> title -> {'$t'};
			$ytID = substr_replace(rtrim(substr($queryResult -> feed -> entry[2] -> content -> src, 25), "version=3&f=videos&app=youtube_gdata"), "", -1);
			$downloadLink = "http://youtubeinmp3.com/download/?video=http://www.youtube.com/watch?v=" . $ytID;

			$bch = cURL_init();
			cURL_setOpt($bch, CURLOPT_URL, $downloadLink);
			cURL_setOpt($bch, CURLOPT_RETURNTRANSFER, 1);
			curl_setOpt($bch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
			cURL_setOpt($bch, CURLOPT_CONNECTTIMEOUT, $timeout);

			$html = cURL_exec($bch);
			cURL_close($bch);

			$dom = new DOMDocument();
			@$dom -> loadHTML($html);

			foreach($dom -> getElementsByTagName("a") as $link) {
				if(strpos($link -> getAttribute("href"), "download/grabber") !== false) {
					$next = $link -> getAttribute("href");
				}
			}

		}

	}

	/*if ($next !== "") {
		$filename = $next;
		if(file_exists($filename)) {
			header('Content-Type: audio/mpeg');
			header('Content-Disposition: inline; filename="'.$filename.'"');
			header('Content-length: '.filesize($filename));
			header('Cache-Control: no-cache');
			header("Content-Transfer-Encoding: chunked"); 
			readfile($filename);
		} else {
			//header("HTTP/1.0 404 Not Found");
		}
	}*/

	if ($next !== "") {
		header("Location: " . $next);
	}

?>