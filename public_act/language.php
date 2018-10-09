<?php

$language = filter_input(INPUT_POST, "language", FILTER_SANITIZE_STRING); 
setcookie('LANG', $language, 0);   
$_SESSION['LANG'] = $language;
?>