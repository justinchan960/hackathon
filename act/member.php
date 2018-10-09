<?php

$action = filter_input(INPUT_POST, "action");
$member_id = filter_input(INPUT_POST, "member_id");

$member_fullname = filter_input(INPUT_POST, "member_fullname", FILTER_SANITIZE_STRING);
$member_username = filter_input(INPUT_POST, "member_username", FILTER_SANITIZE_STRING);
$member_password = filter_input(INPUT_POST, "member_password", FILTER_SANITIZE_STRING);
$member_email = filter_input(INPUT_POST, "member_email", FILTER_SANITIZE_STRING);
$member_package = filter_input(INPUT_POST, "member_package", FILTER_SANITIZE_STRING);
$member_status = filter_input(INPUT_POST, "member_status", FILTER_SANITIZE_STRING);

if($action == 'update'){
	
	$pwd = md5($member_password);
	$stmt_member_update = $mysqli->prepare("UPDATE member SET member_username=?, member_fullname=?, member_email=?, member_package=?, member_status=? where member_id=?");
	$stmt_member_update->bind_param('ssssss',$member_username,$member_fullname,$member_email,$member_package,$member_status,$member_id);		
	$stmt_member_update->execute();
	
    $output[0] = true;
	$output[1] = "Update Successful";
	$output[2] = $member_id;
	
	print json_encode($output);

}else if($action == 'select') {
		
	$stmt_select_member = $mysqli->prepare("select member_username, member_fullname, member_password, member_email, member_package, member_status FROM member where member_id = ?");
	$stmt_select_member->bind_param('s',$member_id);
	$stmt_select_member->execute();
	$stmt_select_member->store_result();
	$stmt_select_member->bind_result($member_username, $member_fullname,$member_password, $member_email, $member_package, $member_status);
	$stmt_select_member->fetch();

?>
	<input type="hidden" id="hidden_member_id" value="<?php echo $member_id; ?>">
	<form id="member_form" class="infotxt form-horizontal"> 
		<div class="col-lg-12">
			<div class="form-group col-md-12" style="">        
				<label for="" class="col-md-5 control-label">Username :<span style='color:red;'>&nbsp;*</span></label>
				<div class="col-md-7">
					<input class="form-control required" id="member_username" name="member_username" placeholder="" value="<?php echo $member_username; ?>">
				</div>
			</div>
			<div class="form-group col-md-12" style="">        
				<label for="" class="col-md-5 control-label">Full Name :<span style='color:red;'>&nbsp;*</span></label>
				<div class="col-md-7">
					<input class="form-control required" id="member_fullname" name="member_fullname" placeholder="" value="<?php echo $member_fullname; ?>">
				</div>
			</div>
			<div class="form-group col-md-12" style="">        
				<label for="" class="col-md-5 control-label">Email :<span style='color:red;'>&nbsp;*</span></label>
				<div class="col-md-7">
					<input class="form-control required" id="member_email" name="member_email" placeholder="" value="<?php echo $member_email; ?>">
				</div>
			</div>
			<div class="form-group col-md-12" style="">        
				<label for="" class="col-md-5 control-label">Package :<span style='color:red;'>&nbsp;*</span></label>
				<div class="col-md-7">
					<select class="form-control required" name="member_package" id="member_package">
						<option value="">Choose Package</option>
						<?php 
						$stmt_select_package = $mysqli->prepare("SELECT package_id,package_amount FROM package");
						$stmt_select_package->execute();
						$stmt_select_package->store_result();
						$stmt_select_package->bind_result($package_id,$package_amount);
						while ($stmt_select_package->fetch()) {	
							if($package_id == $member_package){
						?>
						<option value="<?php echo $package_id; ?>" selected><?php echo $package_amount; ?></option>
						<?php }else{ ?>
						<option value="<?php echo $package_id; ?>"><?php echo $package_amount; ?></option>
						<?php
						}
							} ?>
					</select>
				</div>
			</div>
			<div class="form-group col-md-12" style="">        
				<label for="" class="col-md-5 control-label">Package :<span style='color:red;'>&nbsp;*</span></label>
				<div class="col-md-7">
					<select class="form-control required" name="member_status" id="member_status">
						<?php
							if($member_status == 1){
						?>
						<option value="1" selected>Active</option>
						<option value="0">Inactive</option>
						<?php }else{ ?>
						<option value="1">Active</option>
						<option value="0" selected>Inactive</option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
		</div>
	</form>
<?php	
}else if($action == 'insert'){
	$pwd = md5($member_password);
	$stmt_member_insert = $mysqli->prepare("INSERT into member (member_username, member_fullname, member_password, member_email, member_package, member_status) values (?,?,?,?,?,?)");
	$stmt_member_insert->bind_param('ssssss', $member_username, $member_fullname, $pwd, $member_email, $member_package, $member_status);
	$stmt_member_insert->execute();
	
	$output[0] = true;
	$output[1] = 'Create successful';

echo urldecode(json_encode($output));

} else if($action == 'delete'){
	$stmt_member_delete = $mysqli->prepare("DELETE FROM member WHERE member_id=?");
    $stmt_member_delete->bind_param("i", $member_id);

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