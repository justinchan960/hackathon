<?php

$input_username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$input_password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

	$stmt = $mysqli->prepare("SELECT admin_id FROM admin WHERE admin_username =?");
	$stmt->bind_param("s", $input_username);
	$stmt->execute();
	$stmt->store_result();
	if ($stmt->num_rows === 1) 
	{

			$pwd = md5($input_password);		
			$stmt2 = $mysqli->prepare("SELECT admin_id FROM admin WHERE admin_username =? AND admin_password=?");
			$stmt2->bind_param("ss", $input_username, $pwd);
			$stmt2->execute();
			$stmt2->store_result();
			$stmt2->bind_result($user_id);
			$stmt2->fetch();
			if ($stmt2->num_rows === 1) {
				$md5_id = md5($user_id);
				$auth = rand_string(25);
				setcookie('admin_cookie_id', $md5_id, 0, '/');
				setcookie('admin_cookie_auth', $auth, 0, '/'); 
				$stmt3 = $mysqli->prepare("UPDATE admin SET admin_auth=?, admin_auth_md5=?, admin_last_login_datetime=now() WHERE admin_id=?");

				$stmt3->bind_param("ssi", $auth, $md5_id, $user_id);
				$stmt3->execute();
				$output[] = true;
			}
			else 
			{
				$output[] = false;
				$output[] = "Wrong username or password";
				
			}
	}
	else 
	{
		$output[] = false; 
		$output[] = "Wrong username or password";
	}
	 echo urldecode(json_encode($output));
	
?>