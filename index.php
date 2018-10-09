<?php
// echo '<script type="text/javascript">alert("p")</script>';

require_once("config/default_setup.php");
require_once("config/db_conn.php");
require_once("function/function.php");
require_once('class/admin.php'); 

$lang_file = 'language/en/default.php';
include_once $lang_file;
//End Language

//Public Action Page Access
$pact = filter_input(INPUT_GET, 'pact');
$p = filter_input(INPUT_GET, 'p');
//$f:action page
//$loc:view page(need login)
$f = filter_input(INPUT_GET, 'f');
$loc = filter_input(INPUT_GET, 'loc');
$admin_cookie_id = filter_input(INPUT_COOKIE, "admin_cookie_id");
$admin_cookie_auth = filter_input(INPUT_COOKIE, "admin_cookie_auth");

if (isset($pact)) {
	/*
    if (file_exists($lang_folder . $pact . '.php')) {
        include_once $lang_folder . $pact . '.php';
    }
	 * 
	 */
    if (file_exists('public_act/' . $pact . '.php')) {
        include 'public_act/' . $pact . '.php';
    } else {
        echo "Action file not found";
    }
}
//Public Application Page Access
else if (isset($p)) { 
	/*
    if (file_exists($lang_folder . $p . '.php')) {
        include_once $lang_folder . $p . '.php';
    }
	 * 
	 */
    include 'public_app/main.php';
}//Dashboard
else if (isset($admin_cookie_id) && isset($admin_cookie_auth)) {  
    $stmt = $mysqli->prepare("SELECT admin_id,admin_name,admin_email,admin_username,admin_password,admin_type"
            . " FROM admin WHERE admin_auth=? AND admin_auth_md5=?"); 
    $stmt->bind_param("ss", $admin_cookie_auth, $admin_cookie_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_username,$admin_password,$admin_type);
    $stmt->fetch();
    if ($stmt->num_rows === 1) {
        //Set Cookies and expire in half hours inactive 
		update_cookies();  
        $admin = new admin($admin_id, $admin_name, $admin_email, $admin_username,$admin_password,$admin_type); 
        if (isset($loc)) {
            if (file_exists($lang_folder . $loc . '.php')) {
                include_once $lang_folder . $loc . '.php';
            }
            include 'app/main.php';
        } else if (isset($f)) {
			if (file_exists($lang_folder . $f . '.php')) {
                include_once $lang_folder . $f . '.php';
            }
            if (file_exists('act/' . $f . '.php')) {
                include 'act/' . $f . '.php';
            } else {
                include 'app/main.php';
            }
        } else {
            header('Location: ?loc=dashboard');
        }
    } else { 
        header('Location: ?p=login');
    }
}
//Default Pages(Without login)
else {
    if (isset($f) || isset($loc)) {
        ?> 
        <script>
            alert('Please sign in again.');
            window.location = '?p=login';</script>
        <?php

    } else {
        ?> 
			<script>window.location = '?p=login';</script>
		<?php

    }
}
?>