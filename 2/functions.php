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
	$tries = 0;
	function downloadLink($q) {
		if ($GLOBALS['tries'] < 3) {
			$url = "http://youtubeinmp3.com/fetch/?api=advanced&format=JSON&video=" . urlencode("http://www.youtube.com/watch?v=" . $q);
			$x = json_decode(getContents($url));
			$GLOBALS['tries']++;
			if ($x -> {'link'}) {
				return $x -> {'link'};
			} else {
				downloadLink($q);
			}
		}
	}
?>