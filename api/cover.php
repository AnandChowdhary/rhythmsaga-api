<?php

	if (isset($_GET["q"])) {

		if ($_GET["q"] !== "") {

			header("Location: http://ts3.mm.bing.net/th?q=" . $_GET["q"] . "+album+art");

		} else {
			echo "string";
		}

	} else {
		echo "string";
	}

?>