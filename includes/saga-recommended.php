<?php

	$rss = "http://www.billboard.com/rss/charts/hot-100";
	$xml = simplexml_load_file($rss) or die("Error: Cannot create object");

	$array = array(array());

	for ($i = 0; $i < 100; $i++) {
		$song_name = $xml -> channel -> item[$i] -> chart_item_title;
		$artist_name = $xml -> channel -> item[$i] -> artist;
		$artist_name = str_replace("Featuring", "ft.", $artist_name);
		$artist_name = str_replace(" &", ",", $artist_name);
		array_push($array, array((string)$song_name, (string)$artist_name));
	}

	$numbers = range(0, 99);
	shuffle($numbers);

	for ($j = 0; $j < 10; $j++) {
		$k = $numbers[$j];
		echo '<div class="top-song">' . "\r\n";
		echo "	<div><span>" . $array[$k][0] . "</span> by " . $array[$k][1] . "</div>" . "\r\n";
		echo '	<div class="buttons"><i onclick="playSong(\'' . urlencode($array[$k][0]) . '+-+' . urlencode($array[$k][1]) . '\')" class="ion-play"></i><i class="ion-android-download" onclick="downloadSong(\'' . urlencode($array[$k][0]) . '+-+' . urlencode($array[$k][1]) . '\')"></i></div>' . "\r\n";
		echo '</div>' . "\r\n" . "\r\n";
	}

?>