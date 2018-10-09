<?php

$loc = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
if (isset($loc)) {
	if($loc == "main"){
		include_once 'app/dashboard.php';
	}else if (file_exists('app/' . $loc . '.php')) {

        include_once 'app/' . $loc . '.php';
    }
    else {
        include_once 'app/error.php';
    }
}
else {
    include_once 'app/dashboard.php';
}
?>