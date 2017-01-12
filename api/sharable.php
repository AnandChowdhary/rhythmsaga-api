<?php

	if (!isset($_GET["q"]) || $_GET["q"] == "") {
		header("Location: /");
	}

	$queryURL = "http://gdata.youtube.com/feeds/api/videos?q=" . urlencode($_GET["q"]) . "&max-results=3&v=2&alt=json";
	$ach = cURL_init();
	$timeout = 5;
	$vidtitle = "";

	cURL_setOpt($ach, CURLOPT_URL, $queryURL);
	cURL_setOpt($ach, CURLOPT_RETURNTRANSFER, 1);
	curl_setOpt($ach, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	cURL_setOpt($ach, CURLOPT_CONNECTTIMEOUT, $timeout);

	$youHtml = cURL_exec($ach);
	$queryResult = json_decode($youHtml);
	$title = $queryResult -> feed -> entry[0] -> title -> {'$t'};
	$ytID = substr_replace(rtrim(substr($queryResult -> feed -> entry[0] -> content -> src, 25), "version=3&f=videos&app=youtube_gdata"), "", -1);
	$downloadLink = "http://youtubeinmp3.com/download/?video=http://www.youtube.com/watch?v=" . $ytID;
	$vidtitle = $queryResult -> feed -> entry[0] -> title -> {'$t'};

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
		$vidtitle = $queryResult -> feed -> entry[1] -> title -> {'$t'};

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
			$vidtitle = $queryResult -> feed -> entry[2] -> title -> {'$t'};

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

	$vidtitle = preg_replace("/\([^)]+\)/", "", $vidtitle);
	$vidtitle = preg_replace('/\[.*\]/', '', $vidtitle);
	$vidtitle = str_replace("Featuring", "ft.", $vidtitle);
	$vidtitle = str_replace(" &", ",", $vidtitle);
	$bitlyRequest = "https://api-ssl.bitly.com/v3/shorten?longUrl=" . urlencode("http://getsa.ga/player.php?q=" . $vidtitle) . "&access_token=86bb2959c6dc3e91752c7870c181694b45025415";

	$bitlyCH = curl_init();
	curl_setopt($bitlyCH, CURLOPT_URL, $bitlyRequest);
	curl_setopt($bitlyCH, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($bitlyCH, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($bitlyCH, CURLOPT_HEADER, 0);

	$bitHTML = cURL_exec($bitlyCH);
	$bitlyData = json_decode($bitHTML);
	$bitURL = $bitlyData -> data -> url;

	echo $bitURL;

?>