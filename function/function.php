<?php

//Update Cookies
function update_cookies() {
    $admin_cookie_id = filter_input(INPUT_COOKIE, "devtest_admin_bm360_id");
    $admin_cookie_auth = filter_input(INPUT_COOKIE, "devtest_admin_bm360_auth");
    if ($admin_cookie_id && $admin_cookie_auth) {
        setcookie('devtest_admin_cookie_id', $admin_cookie_id, time() + 1800, '/');
        setcookie('devtest_admin_cookie_auth', $admin_cookie_auth, time() + 1800, '/');
        return true;
    }
    else {
        return false;
    }
}

//Generate Random String
function rand_string($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}

// Audit Trail
// FORMAT
// ADD: ADD - DATA - TABLE E.G.: Add - name=tester1@username=12 - Condition - Member
// DELETE: DELETE - DATA - TABLE E.G.: Delete - name=tester1@username=12 - Condition - Member
// UPDATE: UPDATE - DATA - TABLE E.G.: Update - name=tester1@username=12 - Condition - Member
function audit_trail($type,$data,$table,$condition){
	$admin = $GLOBALS['admin'];
	$mysqli = $GLOBALS['mysqli'];
	$stmt=$mysqli->prepare("INSERT INTO audit_trail_admin 
	(admin_id,audit_trail_admin_type,audit_trail_admin_data,audit_trail_admin_condition,audit_trail_admin_table) 
	VALUES (?,?,?,?,?);");
	$stmt->bind_param("issss",$admin->getAdmin_id(),$type,$data,$condition,$table);
	$stmt->execute();
}

function select_name($id,$id_name,$name,$table,$mysqli){
	$stmt = $mysqli->prepare("SELECT ".$name. " FROM ".$table. " WHERE ".$id_name. "=?");
	$stmt ->bind_param('i',$id);
	$stmt ->execute();
	$stmt ->store_result();
	$stmt ->bind_result($value);
	$stmt ->fetch();
	return $value;
}

?>