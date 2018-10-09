<?php
require_once("plugin/securimage/securimage.php");
$captchaId = $_GET['captchaId'];

$options = array('captchaId'  => $captchaId,
                     'no_session' => true);
    $captcha = new Securimage($options);

    // show the image, this sends proper HTTP headers
    $captcha->show();
	exit;
?>