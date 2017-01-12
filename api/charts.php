<?php

	$rss = "http://www.billboard.com/rss/charts/hot-100";
	$xml = simplexml_load_file($rss) or die("Error: Cannot create object");
	
	for ($i = 0; $i < 100; $i++) {	
		echo "<a target='_blank' href='http://getsa.ga/direct-download.php?q=" . urlencode($xml -> channel -> item[$i] -> chart_item_title) . "+" . urlencode($xml -> channel -> item[$i] -> artist) . "' class='song'>";
			echo "<div class='song-name'>";
				echo $xml -> channel -> item[$i] -> chart_item_title;
			echo "</div>";
			echo "<div class='artist-name'>";
				echo $xml -> channel -> item[$i] -> artist;
			echo "</div>";
		echo "</a>";
	}

?>