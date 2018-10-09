<?php

$action = filter_input(INPUT_POST, "action");
$package_id = filter_input(INPUT_POST, "package_id");
$package_amount = filter_input(INPUT_POST, "package_amount", FILTER_SANITIZE_STRING);

if($action == 'update'){
	
	$stmt_package_update = $mysqli->prepare("UPDATE package SET package_amount=? where package_id=?");
	$stmt_package_update->bind_param('ss',$package_amount,$package_id);		
	$stmt_package_update->execute();
	
    $output[0] = true;
	$output[1] = "Update Successful"; 
	$output[2] = $package_id;
	
	print json_encode($output);

} else if($action == 'select') {
	
	$stmt_select_package = $mysqli->prepare("select package_id,package_amount FROM package where package_id = ?");
	$stmt_select_package->bind_param('s',$package_id);
	$stmt_select_package->execute();
	$stmt_select_package->store_result();
	$stmt_select_package->bind_result($package_id,$package_amount);
	$stmt_select_package->fetch();
	
	
	$output[0]=true;
	$output[1]=$package_amount;
	$output[2]=$package_id;
	
	print json_encode($output);
	
}else if($action == 'insert'){
	$stmt_package_insert = $mysqli->prepare("INSERT into package (package_amount) values (?)");
	$stmt_package_insert->bind_param('s', $package_amount);
	$stmt_package_insert->execute();
	
	$output[0] = true;
	$output[1] = 'Create successful';

echo urldecode(json_encode($output));

} else if($action == 'delete'){
	$stmt_package_delete = $mysqli->prepare("DELETE FROM package WHERE package_id=?");
    $stmt_package_delete->bind_param("i", $package_id);

    if ($stmt_package_delete->execute()) {
        $output[0] = true;
        $output[1] = "Delete Successful";
    } else {
        $output[0] = false;
        $output[1] = $LANG_ERROR_ALERT;
    }
    print json_encode($output);	
}
?>