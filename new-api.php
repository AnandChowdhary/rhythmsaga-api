<?php

if (isset($_GET["r"]) {
	header("Location: https://sagamusic.herokuapp.com/new_api.php?q=" . $_GET["q"] . "&r=" . $_GET["r"]);
} else {
	header("Location: https://sagamusic.herokuapp.com/new_api.php?q=" . $_GET["q"]);
}

?>
