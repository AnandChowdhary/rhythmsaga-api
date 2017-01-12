<?php
	include "functions.php";
	$q = urlencode($_GET["q"]);
	if (isset($_GET["q"])) {
		$youtubeURL = "http://gdata.youtube.com/feeds/api/videos?q=" . $q . "&max-results=2&v=2&alt=json";
		$queryResult = json_decode(getContents($youtubeURL));
		$youtubeTitle = $queryResult -> feed -> entry[1] -> title -> {'$t'};
		$ytID = substr_replace(rtrim(substr($queryResult -> feed -> entry[1] -> content -> src, 25), "version=3&f=videos&app=youtube_gdata"), "", -1);
		$youtubeTitle = strtolower($youtubeTitle);
		$youtubeTitle = array_shift(explode(' ft', $youtubeTitle));
		$removeWords = array("lyrics", "official", "video", "hd", "lyric", "cover", "explicit", "radio edit", "by", "live", "unplugged", "full album", "album");
		foreach ($removeWords as &$word) {
			$word = '/\b' . preg_quote($word, '/') . '\b/';
		}
		$youtubeTitle = preg_replace('/\[.*\]/', '', $youtubeTitle);
		$youtubeTitle = preg_replace("/\([^)]+\)/","",$youtubeTitle);
		$youtubeTitle = str_replace("-", "", $youtubeTitle);
		$youtubeTitle = str_replace("  ", " ", preg_replace($removeWords, '', $youtubeTitle));
		$itunesURL = "https://itunes.apple.com/search?term=" . urlencode($youtubeTitle) . "&entity=allTrack&limit=1";
		$result = json_decode(getContents($itunesURL));
		$track = $result->results[0] -> artistName;
		echo $track;
	}
?>