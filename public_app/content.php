<?php

if (isset($p)) {
    if (file_exists('public_app/' . $p . '.php')) {

        include_once 'public_app/' . $p . '.php';
    } else {

        include_once 'public_app/error.php';
    }
} else {
    include_once 'public_app/login.php';
}
?>