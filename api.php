<?php

	function getContents($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	if (isset($_GET["q"])) {
		$q = $_GET["q"];
	} else {
		$q = $_POST["q"];
	}

	if (isset($_GET["api"])) {
		$api = $_GET["api"];
	} else {
		$api = $_POST["api"];
	}

	if ($api == "search") {
		$url = "search.php?q=" . urlencode($q);
	} else if ($api == "cover") {
		$url = "http://rhythmsa.ga/api/cover.php?q=" . urlencode($q);
	} else if ($api == "top_charts") {
		$url = "http://rhythmsa.ga/api/topcharts.php";
	} else {
		$url = "http://sagamusic.herokuapp.com/" . $api . ".php?q=" . urlencode($q);
	}

	header("Location: " . $url);

?>