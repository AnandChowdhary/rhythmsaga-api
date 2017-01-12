<form action="#">
	<input type="search" placeholder="Search" name="q">
	<input type="submit">
</form>

<?php

	include "functions.php";

	$q = urlencode($_GET["q"]);

	// Search query -> YouTube -> First list name -> iTunes

	if (isset($_GET["q"])) {

		$youtubeURL = "http://gdata.youtube.com/feeds/api/videos?q=" . $q . "&max-results=2&v=2&alt=json";
		echo "<b>YouTube API:</b> " . $youtubeURL . "<br>";

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

		echo "<b>YouTube Title:</b> " . $youtubeTitle . "<br>";
		echo "<b>YouTube ID:</b> " . $ytID . "<br>";

		$itunesURL = "https://itunes.apple.com/search?term=" . urlencode($youtubeTitle) . "&entity=allTrack&limit=1";
		echo "<b>iTunes URL:</b> " . $itunesURL . "<br>";
		$result = json_decode(getContents($itunesURL));

		//var_dump($result);

		$track = $result->results[0] -> trackName;
		$artist = $result->results[0] -> artistName;
		$album = $result->results[0] -> collectionName;
		$date = $result->results[0] -> releaseDate;
		$genre = $result->results[0] -> primaryGenreName;
		$trackno = $result->results[0] -> trackNumber;
		$art = "http://rhythmsa.ga/api/cover.php?q=" . urlencode($track) . " " . $artist;

		echo "<b>Track Name: </b>" . $track . "<br>";
		echo "<b>Artist Name: </b>" . $artist . "<br>";
		echo "<b>Album Name: </b>" . $album . "<br>";
		echo "<b>Release Date: </b>" . $date . "<br>";
		echo "<b>Primary Genre: </b>" . $genre . "<br>";
		echo "<b>Track No.: </b>" . $trackno . "<br>";
		echo "<b>Download URL: </b>" . downloadLink($ytID) . "<br>";
		echo "<br><img src='" . $art . "'><br><br>";

		$everything = array(
			"track" => $track,
			"artist" => $artist,
			"album" => $album,
			"release" => $date,
			"genre" => $genre,
			"trackno" => $trackno,
			"mp3url" => downloadLink($ytID),
			"albumart" => $art,
			"youtubeid" => $ytID,
			"api" => "RhythmSaga",
			"apiversion" => 2,
			"query" => $_GET["q"]
		);

		echo json_encode($everything);

	}

?>