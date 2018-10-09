<?php

/*
 * Purpose: Database Connection Setting
 */

$mysqli = new mysqli(DATABASE_IP, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
$mysqli->set_charset("UTF8");
if ($mysqli->connect_errno) { 
    require_once('public_app/maintenance.php');
    error_record("[" . $mysqli->connect_errno . "] " . $mysqli->connect_error, __FILE__);
    die;
}
?>
