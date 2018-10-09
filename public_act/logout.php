<?php

setcookie('admin_cookie_id', '', 0, '/');
setcookie('admin_cookie_auth', '', 0, '/'); 
$admin_id = filter_input(INPUT_POST, "admin_id", FILTER_SANITIZE_NUMBER_INT);
$stmt3 = $mysqli->prepare("UPDATE admin SET admin_auth='', admin_auth_md5='', admin_last_logout_time=now() WHERE admin_id=?");
$stmt3->bind_param("i", $admin_id);
$stmt3->execute();

echo json_encode(true);

?>