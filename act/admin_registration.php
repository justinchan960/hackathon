<?php

$action = filter_input(INPUT_POST, "action");
$admin_id = filter_input(INPUT_POST, "admin_id");

$admin_name = filter_input(INPUT_POST, "admin_name", FILTER_SANITIZE_STRING);
$admin_username = filter_input(INPUT_POST, "admin_username", FILTER_SANITIZE_STRING);
$admin_password = filter_input(INPUT_POST, "admin_password", FILTER_SANITIZE_STRING);
$admin_email = filter_input(INPUT_POST, "admin_email", FILTER_SANITIZE_STRING);
$admin_type = ""; 

if($action == 'update'){
	
	$pwd = md5($admin_password);
	$stmt_member_update = $mysqli->prepare("UPDATE admin SET admin_name=?, admin_username=?, admin_password=?, admin_email=?, admin_type=? where admin_id=?");
	$stmt_member_update->bind_param('ssssss',$admin_name,$admin_username,$pwd,$admin_email,$admin_type,$admin_id);		
	$stmt_member_update->execute();
	
    $output[0] = true;
	$output[1] = "Update Successful"; 
	$output[2] = $member_id;
	
	print json_encode($output);

} else if($action == 'select') {
	
	$stmt_select_member = $mysqli->prepare("select admin_id,admin_name, admin_username, admin_password, admin_email, admin_type FROM admin where admin_id = ?");
	$stmt_select_member->bind_param('s',$admin_id);
	$stmt_select_member->execute();
	$stmt_select_member->store_result();
	$stmt_select_member->bind_result($admin_id,$admin_name, $admin_username, $admin_password, $admin_email, $admin_type);
	$stmt_select_member->fetch();
	
	
	$output[0]=true;
	$output[1]=$admin_name;
	$output[2]=$admin_username;
	$output[3]=$admin_password;
	$output[4]=$admin_email;
	$output[5]=$admin_type;
	$output[6]=$admin_id;
	
	print json_encode($output);
	
}else if($action == 'insert'){
	$pwd = md5($admin_password);
	$stmt_member_insert = $mysqli->prepare("INSERT into admin (admin_name, admin_username, admin_password, admin_email, admin_type) values (?,?,?,?,?)");
	$stmt_member_insert->bind_param('sssss', $admin_name, $admin_username, $pwd, $admin_email, $admin_type);
	$stmt_member_insert->execute();
	
	$output[0] = true;
	$output[1] = 'Create successful';

echo urldecode(json_encode($output));

} else if($action == 'delete'){
	$stmt_member_delete = $mysqli->prepare("DELETE FROM admin WHERE admin_id=?");
    $stmt_member_delete->bind_param("i", $admin_id);

    if ($stmt_member_delete->execute()) {
        $output[0] = true;
        $output[1] = "Delete Successful";
    } else {
        $output[0] = false;
        $output[1] = $LANG_ERROR_ALERT;
    }
    print json_encode($output);	
}
?>