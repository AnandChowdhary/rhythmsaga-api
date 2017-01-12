<?php
	include "functions.php";
	$q = urlencode($_GET["q"]);
	if (isset($_GET["q"])) {
		$youtubeURL = "http://gdata.youtube.com/feeds/api/videos?q=" . $q . "&max-results=2&v=2&alt=json";
		$queryResult = json_decode(getContents($youtubeURL));
		$youtubeTitle = $queryResult -> feed -> entry[1] -> title -> {'$t'};
		$ytID = substr_replace(rtrim(substr($queryResult -> feed -> entry[1] -> content -> src, 25), "version=3&f=videos&app=youtube_gdata"), "", -1);
		echo $ytID;
	}
?>