<?php

	$rss = "http://www.billboard.com/rss/charts/hot-100";
	$xml = simplexml_load_file($rss) or die("Error: Cannot create object");

	echo '<div class="row">';

	for ($i = 0; $i < 6; $i++) {
		$song_name = $xml -> channel -> item[$i] -> chart_item_title;
		$artist_name = $xml -> channel -> item[$i] -> artist;
		if (($i + 1) % 4 == 0) {
			echo '</div><div class="row">';
		}
		echo '<div class="popular-song one-third column">';
		echo '<div class="album-art"><img onload="this.style.height=this.clientWidth+\'px\';" src="http://rhythmsa.ga/api/cover.php?q='.urldecode($song_name).'+'.urldecode($artist_name).'"></div>';
		$song_name = preg_replace("/\([^)]+\)/", "", $song_name);
		$artist_name = str_replace("Featuring", "ft.", $artist_name);
		$artist_name = str_replace(" &", ",", $artist_name);
		echo '<div class="song-name">'.$song_name.'</div>';
		echo '<div class="artist-name">'.$artist_name.'</div>';
		echo '<div class="buttons"><i onclick="playSong(\''.urldecode($song_name).'+-+'.urldecode($artist_name).'\')" class="ion-play"></i><i class="ion-android-download" onclick="downloadSong(\''.urldecode($song_name).'+-+'.urldecode($artist_name).'\')"></i></div>';
		echo '</div>';

		if (($i + 1) % 6 == 0) {
			echo '</div>';
		}
	}

	echo '</div>';

?>