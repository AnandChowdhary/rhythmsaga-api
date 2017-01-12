<?php

	// Event logging function
	function write($text, $var) {
		echo $text . ": <em>&ldquo;" . $var . "&rdquo;</em><br><br>\n\n";
	}

	// Replacement for file_get_contents();
	function getContents($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$data = curl_exec($ch);
		curl_close($ch);
		//write("Fetch File Content", "true");
		return $data;
	}

	$tries = 0;

	// Generate download link
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

	// Change YouTube video title to passable iTunes API
	function editTitle($youtubeTitle) {
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
		return $youtubeTitle;
	}

	// Check if request received
	if (isset($_GET["q"])) {

		//write("Request Status", "received");

		$q_original = $_GET["q"];
		//write("Original Query", $q_original);

		$q_encoded = urlencode($_GET["q"]);
		//write("Encoded Query", $q_original);

		require_once 'Google/autoload.php';
		require_once 'Google/Client.php';
		require_once 'Google/Service/YouTube.php';

		$key = 'AIzaSyBAfox_H9dhfytNJzfMMeP-byNacYvUOME';
		$client = new Google_Client();
		$client->setDeveloperKey($key);

		$youtube = new Google_Service_YouTube($client);

		$searchResponse = $youtube->search->listSearch('id,snippet', array(
			'q' => $_GET['q'],
			'maxResults' => 1,
		));

		foreach ($searchResponse['items'] as $searchResult) {
			if ($searchResult['id']['kind'] == 'youtube#video') {
				$video_id = $searchResult['id']['videoId'];
				$video_title = $searchResult['snippet']['title'];
			}
		}

		//write("Video ID", $video_id);
		//write("Video Title", $video_title);

		$video_title_e = editTitle($video_title);
		//write("API Passing Title", $video_title_e);

		$itunesURL = "https://itunes.apple.com/search?term=" . urlencode($video_title_e) . "&entity=allTrack&limit=1";
		$result = json_decode(getContents($itunesURL));

		$track = $result->results[0] -> trackName;
		$artist = $result->results[0] -> artistName;
		$album = $result->results[0] -> collectionName;
		$date = $result->results[0] -> releaseDate;
		$genre = $result->results[0] -> primaryGenreName;
		$trackno = $result->results[0] -> trackNumber;
		$art = "http://rhythmsa.ga/api/cover.php?q=" . urlencode($track) . " " . $artist;

		$everything = array(
			"track" => $track,
			"artist" => $artist,
			"album" => $album,
			"release" => $date,
			"genre" => $genre,
			"trackno" => $trackno,
			"albumart" => $art,
			"youtubeid" => $video_id,
			"api" => "RhythmSaga",
			"apiversion" => 2,
			"query" => $q_original
		);

		echo json_encode($everything);

	} else {

		write("Request Status", "not received");

	}

?>