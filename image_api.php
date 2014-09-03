<?php

	$mbid = str_replace("_", "+", $_GET["mbid"]);

	$url = "http://ws.audioscrobbler.com/2.0/?method=track.getInfo&api_key=d1133eb83c549f1a489ca6e319326c9b&mbid=" . $mbid . "&format=json";

	$contents = file_get_contents($url);
	$contents = utf8_encode($contents);
	$results = json_decode($contents);

	if(isset($results->track)) {

		if(isset($results->track->album->image)) {
			$img = $results->track->album->image[2]->{"#text"};
			header("Content-Type: image/jpeg");
			readfile($img);
		} else {
			$location = "http://search.aol.com/aol/image?q=".$results->track->name." ".$results->track->artist->name." album art";
			$location = str_replace(" ", "+", $location);

			$ch = cURL_init();
			$timeout = 5;
			$i = 0;

			cURL_setOpt($ch, CURLOPT_URL, $location);
			cURL_setOpt($ch, CURLOPT_RETURNTRANSFER, 1);
			cURL_setOpt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

			$html = cURL_exec($ch);
			cURL_close($ch);

			$dom = new DOMDocument();
			@$dom->loadHTML($html);

			foreach ($dom->getElementsByTagName("img") as $links) {
				if($i < 1) {
					header("Content-Type: image/jpeg");
					readfile($links->getAttribute("src"));
					$i++;
				}
			}
		}

	} else {

		echo "Error. Track not found. :(";

	}

?>
