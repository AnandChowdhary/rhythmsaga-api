<?php

// Event logging function
	function write( $text, $var) {
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
		//write( "Fetch File Content", "true");
		return $data;
	}

	$tries = 0;

	// Check if request received
	if (isset($_GET["q"])) {
		$q_original = $_GET["q"];
		$q_encoded = urlencode($_GET["q"]);
		$url = "https://itunes.apple.com/search?term=" . urlencode($q_encoded) . "&entity=allTrack&limit=6";
		$content = json_decode(getContents($url));
		foreach ($content->results as $key) {
			print("&ldquo;".$key->trackName."&rdquo; by &ldquo;".$key->artistName."&rdquo; in album &ldquo;".$key->collectionName."&rdquo;<br>");
		}
	}

?>