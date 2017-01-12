<?php

	$rss = "http://www.billboard.com/rss/charts/hot-100";
	$xml = simplexml_load_file($rss) or die("Error: Cannot create object");

	$array = array(array(""));

	for ($i = 0; $i < 100; $i++) {
		$song_name = $xml -> channel -> item[$i] -> chart_item_title;
		$artist_name = $xml -> channel -> item[$i] -> artist;
		array_push($array, array((string)$song_name, (string)$artist_name));
	}

	$k = rand(0, 100);

	echo '<div class="art">';
	echo '<img src="http://rhythmsa.ga/api/cover.php?q='.urldecode($array[$k][0]).'+'.urldecode($array[$k][1]).'">';
	echo '</div>';
	echo '<div class="uppercase"><strong>'.urldecode($array[$k][0]).'</strong></div>';
	echo '<div>'.urldecode($array[$k][1]).'</div>';
	echo '<div class="download">';
	echo '<span onclick="playSong(\'' . urlencode($array[$k][0]) . '+-+' . urlencode($array[$k][1]) . '\')" class="button play-button"><i class="ion-play"></i></span>';
	echo '<span onclick="downloadSong(\'' . urlencode($array[$k][0]) . '+-+' . urlencode($array[$k][1]) . '\')" class="button">Download</span>';
	echo '</div>';

?>