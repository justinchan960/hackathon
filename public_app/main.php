<!DOCTYPE html>
<html lang="en">
    <head>  
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php //print WEBSITE_TITLE;  ?></title>
        <link rel="shortcut icon" href="<?php //print WEBSITE_ICON;  ?>" /> 
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="plugins/bootstrap-extension.css" rel="stylesheet">
		<script src="js/jquery-3.2.1.min.js"></script>
		<!-- animation CSS -->
		<link href="css/animate.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="css/style.css" rel="stylesheet">
		<!-- color CSS -->
		<link href="css/megna.css" id="theme" rel="stylesheet">
		<script src="js/sweetalert2.min.js"></script>
		<link href="css/sweetalert2.css" rel="stylesheet">	
    </head>
    <body>
		<div class="preloader">
			<div class="cssload-speeding-wheel"></div>
		</div>
       <section id="wrapper" class="login-register">
		<?php
		include_once("content.php");
		?> 
		<!-- /#page-wrapper -->
		</section>
	</body>
<!-- jQuery -->
<script src="plugins/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/tether.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/bootstrap-extension.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="plugins/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<!--Style Switcher -->
<script src="plugins/jQuery.style.switcher.js"></script>
</html>

